<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists
        if (Admin::where('username', 'admin')->exists()) {
            $this->command->info('Admin dengan username "admin" sudah ada. Melewati pembuatan admin baru.');
            return;
        }

        Admin::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@smkn4bogor.sch.id',
            'password' => Hash::make('Admin@2024'),
        ]);

        $this->command->info('Admin berhasil dibuat!');
        $this->command->info('Username: admin');
        $this->command->info('Password: Admin@2024');
    }
}
