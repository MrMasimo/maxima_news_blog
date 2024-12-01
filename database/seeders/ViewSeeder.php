<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use App\Models\View;
use Illuminate\Database\Seeder;

class ViewSeeder extends Seeder
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
        $articles = Article::get();

        for ($i = 0; $i < 10000; $i++) {
            $article = $articles->random();
            $time = $article->created_at->addSeconds(rand(0, 86400));
            $ip_address = rand(0, 255) . '.'.  rand(0, 255) . '.'. rand(0, 255) . '.'. rand(0, 255) ;
            View::factory()
                ->for($article)
                ->create([
                    'user_id' => fake()->boolean() ? $users->random()->id : null,
                    'ip_address' => $ip_address,
                    'created_at' => $time,
                    'updated_at' => $time,
                ]);
        }
    }
}
