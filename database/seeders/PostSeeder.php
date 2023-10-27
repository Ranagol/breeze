<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Here we must use a callback function.
         * Get all users from db. This will be a collection. Every collection has an each() method.
         * Meaning for every user from db, make 2 posts in the db.
         */
        User::all()->each(function(User $user) {
            // $user->posts()->saveMany(factory(Post::class, 5)->make());//this was the original
            $user->posts()->saveMany(
                Post::factory()->count(2)->create()
            );
        });
      
    }
}
