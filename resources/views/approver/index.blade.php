@extends('layouts.app')

@section('title', 'Vehicle Management System - Approver Reservations')

@section('content')
    <main class="flex-1 overflow-y-auto bg-gray-100 p-4">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Approval Panel</h1>
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
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date</th>
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
                                    {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d M Y') }}
                                </td>
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
                                <td class="px-4 py-3 text-sm">
                                    @php
                                        $user = Auth::user();
                                        $isSupervisor = $user->hasRole('supervisor');
                                        $isManager = $user->hasRole('manager');
                                        $alreadyApproved =
                                            ($isSupervisor && $reservation->approval_level1_status !== 'pending') ||
                                            ($isManager && $reservation->approval_level2_status !== 'pending');
                                    @endphp

                                    @if (!$alreadyApproved)
                                        <form method="POST"
                                            action="{{ route('approver.reservations.updateStatus', $reservation->id) }}"
                                            class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="text-sm border-gray-300 rounded px-2 py-1">
                                                <option value="approved">Approve</option>
                                                <option value="rejected">Reject</option>
                                            </select>
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                                Submit
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-sm text-gray-500 italic">Sudah diproses</span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-3 text-center text-sm text-gray-500">
                                    Tidak ada data reservasi untuk ditampilkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
