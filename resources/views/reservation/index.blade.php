@extends('layouts.app')

@section('title', 'Vehicle Management System - Reservations')

@section('content')
    <main class="flex-1 overflow-y-auto bg-gray-100 p-4">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Reservations</h1>
            <a href="{{ route('admin.reservations.create') }}"
                class="inline-block bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded shadow">
                Add Reservation
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Reservation ID</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Vehicle</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Driver</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Purpose</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Supervisor Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Manager Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
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
                                <td class="px-4 py-3 text-sm">
                                    @if ($reservation->approval_level1_status === 'approved')
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Approved</span>
                                    @elseif ($reservation->approval_level1_status === 'rejected')
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Rejected</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-800">Pending</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($reservation->approval_level2_status === 'approved')
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Approved</span>
                                    @elseif ($reservation->approval_level2_status === 'rejected')
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Rejected</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-800">Pending</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end items-center gap-3">
                                        <a href="{{ route('admin.reservations.edit', $reservation->slug) }}" title="Edit"
                                            class="text-blue-600 hover:text-blue-900">
                                            <!-- Icon edit -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536M9 13h3l9-9a1.414 1.414 0 00-2-2l-9 9v3z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.reservations.destroy', $reservation->slug) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Delete" class="text-red-600 hover:text-red-900">
                                                <!-- Icon delete -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-3 text-center text-sm text-gray-500">
                                    Tidak ada data reservasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </main>
@endsection
