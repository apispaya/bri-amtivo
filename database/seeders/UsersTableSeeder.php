<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Always re-enable FK checks even if something fails
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        try {
            // Clean slate
            DB::table('users')->truncate();

            // Insert with explicit ID (password already hashed)
            DB::table('users')->insert([
                [
                    'id' => 1,
                    'name' => 'Syaiful Hafiz',
                    'email' => 'syaifuladmin@bri-amtivo.my',
                    'email_verified_at' => null,
                    'password' => '$2y$12$OxFSXVeqM2gb7uhZj2lWxe0qmLL1mBr/iWcavqXusBzybthU/jF3i',
                    'remember_token' => null,
                    'created_at' => '2025-09-08 15:18:36',
                    'updated_at' => '2025-09-08 15:18:36',
                ],
            ]);

            // Ensure next ID is max(id)+1 (TRUNCATE usually resets to 1, but we set it explicitly)
            $next = ((int) DB::table('users')->max('id')) + 1;
            DB::statement('ALTER TABLE users AUTO_INCREMENT = ' . $next);
        } finally {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}
