<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeed::class);
        $this->call(CourseTableSeed::class);
        $this->call(CategoryTableSeed::class);
        $this->call(CourseCategoryTableSeed::class);
        
    }
}
