<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::select('id')->get();
        $articles = Article::get();

        // создание комментариев
        for ($i = 0; $i < 100; $i++) {
            $article = $articles->random();
            $time = $article->created_at->addSeconds(rand(0, 86400));
            Comment::factory()
                ->for($users->random())
                ->create([
                    'article_id' => $article->id,
                    'created_at' => $time,
                    'updated_at' => $time,
                ]);
        }

        // доп. комментарии
        $comments = Comment::get();
        $count_add_comments = rand(0, 100);
        for ($i = 0; $i < $count_add_comments; $i++) {
            $parent_comment = $comments->random();
            $time = $parent_comment->created_at->addSeconds(rand(0, 86400));
            Comment::factory()
                ->for($users->random())
                ->create([
                    'article_id' => $parent_comment->article_id,
                    'parent_id' => $parent_comment->id,
                    'created_at' => $time,
                    'updated_at' => $time,
                ]);
        }
    }
}
