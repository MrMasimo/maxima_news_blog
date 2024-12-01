<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = 'Владлен Всевластев';
        $email = 'vlad@mail.ru';
        $password = 'qwerty!';

        $role = Role::where('name', 'admin')->first();

        $admin = User::updateOrCreate([
            'email' => $email,
        ], [
            'name' => $name,
            'password' => bcrypt($password),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $admin->roles()->attach($role);
    }
}
