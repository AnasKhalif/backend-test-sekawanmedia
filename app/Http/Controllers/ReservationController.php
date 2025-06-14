<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Services\LogService;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['vehicle', 'driver'])->latest()->get();
        return view('reservation.index', compact('reservations'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $approverLevel1 = User::whereHas('roles', function ($q) {
            $q->where('name', 'supervisor');
        })->get();

        $approverLevel2 = User::whereHas('roles', function ($q) {
            $q->where('name', 'manager');
        })->get();
        return view('reservation.create', compact('vehicles', 'drivers', 'approverLevel1', 'approverLevel2'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id'     => 'required|exists:vehicles,id',
            'driver_id'      => 'required|exists:drivers,id',
            'date'           => 'required|date',
            'purpose'        => 'required|string|max:255',
            'approver1_id'   => 'nullable|exists:users,id',
            'approver2_id'   => 'nullable|exists:users,id',
        ]);

        $slug = Str::slug($request->purpose . '-' . now()->timestamp);

        $reservation = Reservation::create([
            'vehicle_id'            => $validated['vehicle_id'],
            'driver_id'             => $validated['driver_id'],
            'reservation_date'      => $validated['date'],
            'purpose'               => $validated['purpose'],
            'approver_level1_id'    => $validated['approver1_id'] ?? null,
            'approver_level2_id'    => $validated['approver2_id'] ?? null,
            'slug'                  => $slug,
        ]);

        LogService::reservation('Reservation created', [
            'user_id'       => Auth::id(),
            'reservation_id' => $reservation->id,
            'vehicle_id'    => $validated['vehicle_id'],
        ]);

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation created!');
    }

    public function edit($slug)
    {
        $reservation = Reservation::where('slug', $slug)->firstOrFail();
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $approverLevel1 = User::whereHas('roles', function ($q) {
            $q->where('name', 'supervisor');
        })->get();

        $approverLevel2 = User::whereHas('roles', function ($q) {
            $q->where('name', 'manager');
        })->get();

        return view('reservation.edit', compact('reservation', 'vehicles', 'drivers', 'approverLevel1', 'approverLevel2'));
    }

    public function update(Request $request, $slug)
    {
        $reservation = Reservation::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'vehicle_id'     => 'required|exists:vehicles,id',
            'driver_id'      => 'required|exists:drivers,id',
            'date'           => 'required|date',
            'purpose'        => 'required|string|max:255',
            'approver1_id'   => 'nullable|exists:users,id',
            'approver2_id'   => 'nullable|exists:users,id',
        ]);

        $newSlug = $reservation->purpose !== $validated['purpose']
            ? Str::slug($validated['purpose'] . '-' . now()->timestamp)
            : $reservation->slug;

        $reservation->update([
            'vehicle_id'            => $validated['vehicle_id'],
            'driver_id'             => $validated['driver_id'],
            'reservation_date'      => $validated['date'],
            'purpose'               => $validated['purpose'],
            'approver_level1_id'    => $validated['approver1_id'] ?? null,
            'approver_level2_id'    => $validated['approver2_id'] ?? null,
            'slug'                  => $newSlug,
        ]);

        LogService::reservation('Reservation updated', [
            'user_id' => Auth::id(),
            'reservation_id' => $reservation->id,
            'vehicle_id' => $validated['vehicle_id']
        ]);

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation updated!');
    }

    public function updateApprovalStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $user = Auth::user();

        if ($user->hasRole('supervisor')) {
            $reservation->approval_level1_status = $request->status;
            $reservation->approver_level1_id = $user->id;
        } elseif ($user->hasRole('manager')) {
            $reservation->approval_level2_status = $request->status;
            $reservation->approver_level2_id = $user->id;
        } else {
            abort(403, 'Unauthorized');
        }

        $reservation->save();

        return redirect()->back()->with('success', 'Approval status updated.');
    }


    public function destroy($slug)
    {
        $reservation = Reservation::where('slug', $slug)->firstOrFail();
        LogService::reservation('Reservation deleted', [
            'user_id' => Auth::id(),
            'reservation_id' => $reservation->id,
        ]);
        $reservation->delete();
        return redirect()->route('admin.reservations.index')->with('success', 'Reservation deleted!');
    }
}
