<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            ['id' => 1, 'book_id' => 2, 'age' => 16, 'sex' => 'm'],
            ['id' => 2, 'book_id' => 2, 'age' => 29, 'sex' => 'f'],
            ['id' => 3, 'book_id' => 4, 'age' => 14, 'sex' => 'f'],
            ['id' => 4, 'book_id' => 4, 'age' => 16, 'sex' => 'm'],
            ['id' => 5, 'book_id' => 1, 'age' => 56, 'sex' => 'm'],
            ['id' => 6, 'book_id' => 1, 'age' => 58, 'sex' => 'm'],
            ['id' => 7, 'book_id' => 3, 'age' => 15, 'sex' => 'f'],
            ['id' => 8, 'book_id' => 2, 'age' => 15, 'sex' => 'm'],
            ['id' => 9, 'book_id' => 2, 'age' => 13, 'sex' => 'm'],
            ['id' => 10, 'book_id' => 7, 'age' => 29, 'sex' => 'f'],
            ['id' => 11, 'book_id' => 7, 'age' => 12, 'sex' => 'm'],
            ['id' => 12, 'book_id' => 1, 'age' => 38, 'sex' => 'f'],
            ['id' => 13, 'book_id' => 6, 'age' => 19, 'sex' => 'm'],
            ['id' => 14, 'book_id' => 4, 'age' => 17, 'sex' => 'f'],
            ['id' => 15, 'book_id' => 3, 'age' => 54, 'sex' => 'm'],
            ['id' => 16, 'book_id' => 2, 'age' => 52, 'sex' => 'f'],
            ['id' => 17, 'book_id' => 1, 'age' => 58, 'sex' => 'f']
        ]);
    }
}
