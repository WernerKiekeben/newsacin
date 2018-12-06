<?php

use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
use App\News;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\News::truncate();
        factory(App\News::class, 200)->create();

    }
}
