<?php

use Illuminate\Database\Seeder;

class CategoryTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            'name' => 'Programação Web',
            'created_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('category')->insert([
            'name' => 'Internet',
            'created_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('category')->insert([
            'name' => 'Desenvolvedor WEB',
            'created_at' => date('Y-m-d H:i:s')
            ]
        );
    }
}
