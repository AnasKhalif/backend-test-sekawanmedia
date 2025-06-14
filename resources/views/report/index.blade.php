@extends('layouts.app')

@section('title', 'Vehicle Management System - Reports')

@section('content')
    <main class="flex-1 overflow-y-auto bg-gray-100 p-4">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Approved Reservations Report</h1>
            <a href="{{ route('reports.export') }}"
                class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                Export to Excel
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reservation ID</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vehicle</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Driver</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Purpose</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($reservations as $reservation)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-800">
                                    RES-{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-800">
                                    {{ $reservation->vehicle->name }} ({{ $reservation->vehicle->plate_number }})
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-800">{{ $reservation->driver->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800">
                                    {{ \Carbon\Carbon::parse($reservation->date)->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800">{{ $reservation->purpose }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center text-sm text-gray-500">
                                    Tidak ada reservasi yang disetujui.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
