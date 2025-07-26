<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;  // Pastikan model Admin sudah ada
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menyisipkan data admin dengan password yang di-hash
        Admin::create([
            'name' => 'Super Admin', // Nama admin
            'email' => 'mainadmin@gmail.com', // Email admin
            'email_verified_at' => now(), // Waktu verifikasi email
            'password' => Hash::make('ayamsayur'), // Password yang sudah di-hash
            'remember_token' => Str::random(10), // Token untuk "remember me"
            'created_at' => now(), // Waktu dibuat
            'updated_at' => now(), // Waktu diperbarui
        ]);
    }
}
