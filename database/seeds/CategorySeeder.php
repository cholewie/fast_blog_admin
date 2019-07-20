<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('categories')->insert([
            [
                'cate_name'=>'程序边缘',
                'cate_p_id'=>0,
                'cate_level'=>10,
                'cate_status'=>0,
            ],
            [
                'cate_name'=>'PHP',
                'cate_p_id'=>1,
                'cate_level'=>10,
                'cate_status'=>0,
            ]
        ]);
    }
}
