<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Posts;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //User::factory(10)->create();

        User::factory()->create([
            'username' => 'User',
            'email' => 'test@example.com',
            'birthdate' => '2000-02-03',

        ]);


        User::factory()->create([
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'Admin@75',
            'birthdate' => '2000-02-03',
            'admin' => 1
        ]);




        // Posts::factory()->create([
        //     'title' => 'Commet is Social',
        //     'link' => 'string@hfgg.cb',
        //     'content' => 'You must know that Commet is a big project 500 Trillion marketcap',
        //     'tag' => ['#jePost']
        // ]);
        // Comment::factory()->create([
        //     'content' => 'Je t\'assure que je suis un commentateur',
        //     'parent_id' => 'nullable | exists:comments,id'
        // ]);
    }
}
