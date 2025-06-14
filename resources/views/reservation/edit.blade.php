@extends('layouts.app')

@section('title', 'Edit Reservation')

@section('content')
    <main class="flex-1 overflow-y-auto bg-gray-100 p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Reservation</h1>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 rounded text-red-700">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.reservations.update', $reservation->slug) }}" method="POST" class="space-y-5">

            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle</label>
                <select name="vehicle_id"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="">-- Select Vehicle --</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}"
                            {{ $vehicle->id == $reservation->vehicle_id ? 'selected' : '' }}>
                            {{ $vehicle->name }} ({{ $vehicle->plate_number }})
                        </option>
                    @endforeach
                </select>
                @error('vehicle_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Driver</label>
                <select name="driver_id"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="">-- Select Driver --</option>
                    @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ $driver->id == $reservation->driver_id ? 'selected' : '' }}>
                            {{ $driver->name }}
                        </option>
                    @endforeach
                </select>
                @error('driver_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                <input type="date" name="date" value="{{ old('date', $reservation->reservation_date) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
                @error('date')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Purpose</label>
                <textarea name="purpose" rows="3"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-amber-500 focus:border-amber-500">{{ old('purpose', $reservation->purpose) }}</textarea>
                @error('purpose')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Approver 1</label>
                <select name="approver1_id"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="">-- Select Approver 1 --</option>
                    @foreach ($approverLevel1 as $approver)
                        <option value="{{ $approver->id }}"
                            {{ $approver->id == $reservation->approver_level1_id ? 'selected' : '' }}>
                            {{ $approver->name }}
                        </option>
                    @endforeach
                </select>
                @error('approver1_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Approver 2</label>
                <select name="approver2_id"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="">-- Select Approver 2 --</option>
                    @foreach ($approverLevel2 as $approver)
                        <option value="{{ $approver->id }}"
                            {{ $approver->id == $reservation->approver_level2_id ? 'selected' : '' }}>
                            {{ $approver->name }}
                        </option>
                    @endforeach
                </select>
                @error('approver2_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.reservations.index') }}"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Cancel</a>
                <button type="submit" class="bg-amber-500 text-white px-4 py-2 rounded hover:bg-amber-600">Update</button>
            </div>
        </form>
    </main>
@endsection
