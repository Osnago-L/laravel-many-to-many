<?php

use App\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) { 
            $newPost = new Post();
            $newPost->posts_title = $faker->words(4,true);
            $newPost->slug = Str::slug($newPost->posts_title,'-');
            $newPost->content = $faker->words(10,true);
            $newPost->save();
        }
    }
}
