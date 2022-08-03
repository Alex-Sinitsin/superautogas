<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CarBrand;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Models\Testimonial;
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
        User::factory()->create([
            'name' => 'Алексей Артемович',
            'email' => 'lehych99@gmail.com',
            'password' => 123,
            'role' => 'admin'
        ]);
        Post::factory(5)->create();
        Testimonial::factory(15)->create();
        CarBrand::factory(3)->create();
        Page::factory()->create([
            'title' => 'Политика конфиденциальности',
            'content' => ''
        ]);
        Page::factory()->create([
            'title' => 'О компании',
            'content' => ''
        ]);
    }
}
