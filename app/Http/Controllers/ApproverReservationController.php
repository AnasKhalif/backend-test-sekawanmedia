<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\LogService;

class ApproverReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['vehicle', 'driver'])->latest()->get();
        return view('approver.index', compact('reservations'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $user = Auth::user();

        if ($user->hasRole('supervisor')) {
            $reservation->approval_level1_status = $request->status;
            $reservation->approver_level1_id = $user->id;
            $level = 'supervisor    ';
        } elseif ($user->hasRole('manager')) {
            $reservation->approval_level2_status = $request->status;
            $reservation->approver_level2_id = $user->id;
            $level = 'manager';
        } else {
            abort(403, 'Unauthorized');
        }


        $reservation->save();

        LogService::approval('Reservation ' . $request->status, [
            'user_id' => Auth::id(),
            'reservation_id' => $reservation->id,
            'approval_level' => $level,
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Approval status updated.');
    }
}
