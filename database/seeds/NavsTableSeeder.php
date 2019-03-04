<?php

use Illuminate\Database\Seeder;

class NavsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => str_random(10),
            'alias'=>str_random(5),
            'url'=>"http://www.".str_random(10).".com",
            'order'=>random_int(1,200),
        ];
        \Illuminate\Support\Facades\DB::table('navs')->insert($data);
    }
}
