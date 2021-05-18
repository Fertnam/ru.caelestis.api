<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CsArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory(10)->create();
    }
}
