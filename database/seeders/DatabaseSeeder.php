<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       /*  \App\Models\User::factory(1)->create();

         \App\Models\User::factory()->create([
             'name' => 'Hendrick Nkuba',
             'email' => 'test@example.com',
         ]); */

         \App\Models\Courses::factory(5)->create();
    }
}
