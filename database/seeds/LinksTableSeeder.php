<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name'=>str_random(10),
            'title'=>'这是标题'.rand(1,999),
            'url'=>"http://www.".str_random(10).".com",
            'order'=>random_int(1,200),
        ];

        DB::table('links')->insert($data);
    }
}
