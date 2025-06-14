@extends('layouts.app')

@section('title')
    Vehicle Management System - Dashboard
@endsection

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
                        <p class="text-xl font-semibold text-gray-800">128</p>
                    </div>
                </div>
                <div class="mt-2 text-xs text-green-600 flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>4.75% kenaikan</span>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-full p-3">
                        <i class="fas fa-clock text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Total Pending</p>
                        <p class="text-xl font-semibold text-gray-800">42</p>
                    </div>
                </div>
                <div class="mt-2 text-xs text-yellow-600 flex items-center">
                    <i class="fas fa-arrow-right mr-1"></i>
                    <span>10% kenaikan</span>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-full p-3">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Total Disetujui</p>
                        <p class="text-xl font-semibold text-gray-800">89</p>
                    </div>
                </div>
                <div class="mt-2 text-xs text-green-600 flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>7.5% kenaikan</span>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-red-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-red-100 rounded-full p-3">
                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Total Ditolak</p>
                        <p class="text-xl font-semibold text-gray-800">12</p>
                    </div>
                </div>
                <div class="mt-2 text-xs text-red-600 flex items-center">
                    <i class="fas fa-arrow-down mr-1"></i>
                    <span>5% penurunan</span>
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
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            JP
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-800">Joni Pratama</p>
                                            <p class="text-xs text-gray-500">Lokasi Tambang B</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <p class="text-sm text-gray-800">Truk Tambang A</p>
                                    <p class="text-xs text-gray-500">B 1234 KLM</p>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <p class="text-sm text-gray-800">24 Jun 2025</p>
                                    <p class="text-xs text-gray-500">08:00 - 16:00</p>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-800">
                                        Menunggu Persetujuan
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            SM
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-800">Mulyono</p>
                                            <p class="text-xs text-gray-500">Kantor Pusat</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <p class="text-sm text-gray-800">Truk Tambang B</p>
                                    <p class="text-xs text-gray-500">B 5678 ABC</p>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <p class="text-sm text-gray-800">23 Jun 2025</p>
                                    <p class="text-xs text-gray-500">09:30 - 17:30</p>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            DC
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-800">Dimas Cahyadi</p>
                                            <p class="text-xs text-gray-500">Kantor Cabang</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <p class="text-sm text-gray-800">Truk Tambang C</p>
                                    <p class="text-xs text-gray-500">B 9012 DEF</p>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <p class="text-sm text-gray-800">22 Jun 2025</p>
                                    <p class="text-xs text-gray-500">07:00 - 19:00</p>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            AK
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-800">Tono</p>
                                            <p class="text-xs text-gray-500">Lokasi Tambang A</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <p class="text-sm text-gray-800">Truk Tambang D</p>
                                    <p class="text-xs text-gray-500">B 3456 GHI</p>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <p class="text-sm text-gray-800">21 Jun 2025</p>
                                    <p class="text-xs text-gray-500">08:30 - 14:30</p>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
@endsection
