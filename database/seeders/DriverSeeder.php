<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = [
            ['name' => 'Budi Santoso', 'phone' => '081234567890', 'license_number' => 'SIM123456'],
            ['name' => 'Agus Wijaya', 'phone' => '081298765432', 'license_number' => 'SIM654321'],
            ['name' => 'Andi Pratama', 'phone' => '081377788899', 'license_number' => 'SIM789012'],
            ['name' => 'Rizky Ramadhan', 'phone' => '081212345678', 'license_number' => 'SIM345678'],
            ['name' => 'Fajar Nugroho', 'phone' => '081323456789', 'license_number' => 'SIM456789'],
            ['name' => 'Dimas Saputra', 'phone' => '081334567890', 'license_number' => 'SIM567890'],
            ['name' => 'Bayu Setiawan', 'phone' => '081345678901', 'license_number' => 'SIM678901'],
            ['name' => 'Hendra Gunawan', 'phone' => '081356789012', 'license_number' => 'SIM890123'],
        ];

        foreach ($drivers as $driver) {
            Driver::create($driver);
        }
    }
}
