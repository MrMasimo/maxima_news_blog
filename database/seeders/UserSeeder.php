<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name', 'user')->first();
        for ($i = 0; $i < 10; $i++) {
            User::factory()
                ->hasAttached(collect([$role]))
                ->create([
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        }
    }
}
