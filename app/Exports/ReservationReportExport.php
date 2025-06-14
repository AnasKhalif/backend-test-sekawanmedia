<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReservationReportExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Reservation::with(['vehicle', 'driver'])
            ->where('approval_level1_status', 'approved')
            ->where('approval_level2_status', 'approved')
            ->get()
            ->map(function ($reservation) {
                return [
                    'ID' => 'RES-' . str_pad($reservation->id, 5, '0', STR_PAD_LEFT),
                    'Vehicle' => $reservation->vehicle->name . ' (' . $reservation->vehicle->plate_number . ')',
                    'Driver' => $reservation->driver->name,
                    'Date' => $reservation->reservation_date,
                    'Purpose' => $reservation->purpose,
                ];
            });
    }

    public function headings(): array
    {
        return ['Reservation ID', 'Vehicle', 'Driver', 'Date', 'Purpose'];
    }
}
