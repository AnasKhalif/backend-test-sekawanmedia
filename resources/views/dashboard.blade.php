@extends('layouts.app')

@section('title', 'Vehicle Management System - Dashboard')

@section('content')
    <main class="flex-1 overflow-y-auto bg-gray-100 p-4">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
            <p class="text-gray-600 text-sm">Selamat datang kembali, berikut adalah informasi terbaru mengenai armada Anda
                hari ini.</p>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

            <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-amber-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-amber-100 rounded-full p-3">
                        <i class="fas fa-calendar-alt text-amber-600 text-xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Semua Reservasi</p>
                        <p class="text-xl font-semibold text-gray-800">{{ $totalReservations }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-full p-3">
                        <i class="fas fa-clock text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Total Pending</p>
                        <p class="text-xl font-semibold text-gray-800">{{ $totalPending }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-full p-3">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Total Disetujui</p>
                        <p class="text-xl font-semibold text-gray-800">{{ $totalApproved }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-red-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-red-100 rounded-full p-3">
                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Total Ditolak</p>
                        <p class="text-xl font-semibold text-gray-800">{{ $totalRejected }}</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Vehicle Usage by Type</h2>
                    <select id="timePeriod"
                        class="border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500">
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                        <option value="quarter">This Quarter</option>
                        <option value="year">This Year</option>
                    </select>
                </div>
                <div class="h-64">
                    <canvas id="vehicleUsageChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Reservasi Terbaru</h2>
                    <a href="#" class="text-amber-700 hover:text-amber-900 text-sm font-medium">Lihat Semua</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pengemudi
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kendaraan
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($recentReservations as $reservation)
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                {{ strtoupper(substr($reservation->driver->name ?? 'X', 0, 2)) }}
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-800">
                                                    {{ $reservation->driver->name ?? '-' }}</p>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <p class="text-sm text-gray-800">{{ $reservation->vehicle->name ?? '-' }}</p>
                                        <p class="text-xs text-gray-500">{{ $reservation->vehicle->plate_number ?? '-' }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <p class="text-sm text-gray-800">
                                            {{ \Carbon\Carbon::parse($reservation->reservation_date)->translatedFormat('d M Y') }}
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $reservation->created_at->format('H:i') }}</p>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @php
                                            $status = 'Menunggu Persetujuan';
                                            $class = 'bg-amber-100 text-amber-800';

                                            if (
                                                $reservation->approval_level1_status === 'approved' &&
                                                $reservation->approval_level2_status === 'approved'
                                            ) {
                                                $status = 'Disetujui';
                                                $class = 'bg-green-100 text-green-800';
                                            } elseif (
                                                $reservation->approval_level1_status === 'rejected' ||
                                                $reservation->approval_level2_status === 'rejected'
                                            ) {
                                                $status = 'Ditolak';
                                                $class = 'bg-red-100 text-red-800';
                                            }
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $class }}">
                                            {{ $status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </main>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('menuButton');
            const mobileSidebar = document.getElementById('mobileSidebar');
            const closeSidebar = document.getElementById('closeSidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const timePeriodSelect = document.getElementById('timePeriod');
            const vehicleUsageCtx = document.getElementById('vehicleUsageChart').getContext('2d');

            menuButton?.addEventListener('click', function() {
                mobileSidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
            });

            closeSidebar?.addEventListener('click', function() {
                mobileSidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            });

            sidebarOverlay?.addEventListener('click', function() {
                mobileSidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            });

            let vehicleUsageChart = new Chart(vehicleUsageCtx, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Vehicle Orders',
                        data: [],
                        backgroundColor: '#b45309',
                        barPercentage: 0.6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                            },
                            ticks: {
                                precision: 0
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            function fetchChartData(period) {
                fetch(`/dashboard/chart-data?period=${period}`)
                    .then(response => response.json())
                    .then(data => {
                        vehicleUsageChart.data.labels = data.labels;
                        vehicleUsageChart.data.datasets[0].data = data.data;
                        vehicleUsageChart.update();
                    })
                    .catch(error => {
                        console.error('Error fetching chart data:', error);
                    });
            }

            fetchChartData('week');

            timePeriodSelect.addEventListener('change', function() {
                const period = this.value;
                fetchChartData(period);
            });
        });
    </script>
@endsection
