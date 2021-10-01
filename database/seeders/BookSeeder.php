<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            ['id' => 1, 'name' => 'Zielona Mila', 'book_date' => '2012-01-03'],
            ['id' => 2, 'name' => 'Harry Potter', 'book_date' => '2011-08-18'],
            ['id' => 3, 'name' => 'Zielona Żabka', 'book_date' => '2011-07-05'],
            ['id' => 4, 'name' => 'Tajemnica', 'book_date' => '2011-09-30'],
            ['id' => 5, 'name' => 'Policja', 'book_date' => '2011-12-06'],
            ['id' => 6, 'name' => 'Na szafocie', 'book_date' => '2011-12-28'],
            ['id' => 7, 'name' => 'Co nam zostało', 'book_date' => '2011-11-16'],
        ]);
    }
}
