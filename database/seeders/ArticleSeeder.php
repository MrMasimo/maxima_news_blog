<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::select('id')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            })
            ->get();

        for ($i = 0; $i < 3000; $i++) {
            $time = now()->addSeconds(rand(0, 86400));
            Article::factory()
                ->for($users->random())
                ->create([
                    'created_at' => $time,
                    'updated_at' => $time,
                ]);
        }
    }
}
