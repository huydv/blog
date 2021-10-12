<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Category::truncate();
        Post::truncate();

        $user1 = User::factory()->create([
            'name' => 'John Doe'
        ]);
        $user2 = User::factory()->create([
            'name' => 'Bill'
        ]);
        $category1 = Category::factory()->create([
            'name' => 'Hobby',
            'slug' => 'hobby'
        ]);
        $category2 = Category::factory()->create([
            'name' => 'Family',
            'slug' => 'family'
        ]);


        Post::factory(5)->create([
            'user_id' => $user1->id,
            'category_id' => $category1->id
        ]);

        Post::factory(5)->create([
            'user_id' => $user2->id,
            'category_id' => $category2->id
        ]);


        // $user = User::factory()->create();
        // $personal = Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal'
        // ]);
        // Category::create([
        //     'name' => 'Hobby',
        //     'slug' => 'hobby'
        // ]);
        // $family = Category::create([
        //     'name' => 'Family',
        //     'slug' => 'family'
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $family->id,
        //     'title' => 'My family post',
        //     'slug' => 'my-family-post',
        //     'excerpt' => 'Lorem family',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores repudiandae velit eos neque impedit laborum fugit!
        //                 Ipsa nostrum voluptatem necessitatibus, ullam doloribus aliquid saepe quam deleniti dolorem, excepturi quae aliquam!
        //                 Non dolorum, praesentium exercitationem a libero reprehenderit optio perspiciatis aperiam, quam fuga alias! Eum',
        //     'published_at' => now()
        // ]);
    }
}
