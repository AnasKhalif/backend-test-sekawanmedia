<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Exports\ReservationReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['vehicle', 'driver'])
            ->where('approval_level1_status', 'approved')
            ->where('approval_level2_status', 'approved')
            ->latest()
            ->get();

        return view('report.index', compact('reservations'));
    }

    public function export()
    {
        return Excel::download(new ReservationReportExport, 'reservations_report.xlsx');
    }
}
