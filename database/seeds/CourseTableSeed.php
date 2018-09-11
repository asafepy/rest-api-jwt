<?php

use Illuminate\Database\Seeder;

class CourseTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course')->insert([
            'name' => 'Python com Django',
            'created_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('course')->insert([
            'name' => 'Python com Bokeh',
            'created_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('course')->insert([
            'name' => 'Python para zumbis',
            'created_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('course')->insert([
            'name' => 'PHP com Laravel',
            'created_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('course')->insert([
            'name' => 'PHP para iniciantes',
            'created_at' => date('Y-m-d H:i:s')
            ]
        );
    }
}
