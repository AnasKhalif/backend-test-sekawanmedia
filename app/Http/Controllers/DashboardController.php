<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalReservations = Reservation::count();

        $totalPending = Reservation::where(function ($query) {
            $query->whereNull('approval_level1_status')
                ->orWhere('approval_level1_status', '!=', 'approved');
        })->orWhere(function ($query) {
            $query->whereNull('approval_level2_status')
                ->orWhere('approval_level2_status', '!=', 'approved');
        })->count();

        $totalApproved = Reservation::where('approval_level1_status', 'approved')
            ->where('approval_level2_status', 'approved')
            ->count();

        $totalRejected = Reservation::where(function ($query) {
            $query->where('approval_level1_status', 'rejected')
                ->orWhere('approval_level2_status', 'rejected');
        })->count();

        $recentReservations = Reservation::with(['vehicle', 'driver'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalReservations',
            'totalPending',
            'totalApproved',
            'totalRejected',
            'recentReservations'
        ));
    }

    public function getChartData(Request $request)
    {
        $period = $request->query('period', 'week');
        $now = Carbon::now();
        $labels = [];
        $data = [];

        switch ($period) {
            case 'week':
                $labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                $startOfWeek = $now->copy()->startOfWeek(Carbon::MONDAY);

                $data = collect($labels)->map(function ($day, $index) use ($startOfWeek) {
                    $date = $startOfWeek->copy()->addDays($index);
                    return Reservation::whereDate('reservation_date', $date)->count();
                })->values()->toArray();
                break;


            case 'month':
                $daysInMonth = $now->daysInMonth;
                $labels = range(1, $daysInMonth);
                $startOfMonth = $now->copy()->startOfMonth();

                $data = collect($labels)->map(function ($day) use ($startOfMonth) {
                    $date = $startOfMonth->copy()->addDays($day - 1);
                    return Reservation::whereDate('reservation_date', $date)->count();
                })->values()->toArray();
                break;

            case 'quarter':
                $labels = ['Q1', 'Q2', 'Q3', 'Q4'];
                $currentYear = $now->year;

                $data = collect([1, 4, 7, 10])->map(function ($startMonth, $index) use ($currentYear) {
                    return Reservation::whereYear('reservation_date', $currentYear)
                        ->whereMonth('reservation_date', '>=', $startMonth)
                        ->whereMonth('reservation_date', '<=', $startMonth + 2)
                        ->count();
                })->values()->toArray();
                break;

            case 'year':
                $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                $currentYear = $now->year;

                $data = collect(range(1, 12))->map(function ($month) use ($currentYear) {
                    return Reservation::whereYear('reservation_date', $currentYear)
                        ->whereMonth('reservation_date', $month)
                        ->count();
                })->values()->toArray();
                break;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
