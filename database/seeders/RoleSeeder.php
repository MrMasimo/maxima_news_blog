<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'user' => 'Обычный пользователь',
            'admin' => 'Администратор',
        ];
        foreach ($roles as $role => $description) {
            Role::updateOrCreate([
                'name' => $role,
                'description' => $description
            ]);
        }
    }

}
