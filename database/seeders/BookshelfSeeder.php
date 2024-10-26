<?php

namespace Database\Seeders;

use App\Models\Bookshelf;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookshelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("bookshelves")->insert([
            ['code' => 'BKS001', 'name' => 'novel'],
            ['code' => 'BKS001', 'name' => 'Educational'],
        ]);

        Bookshelf::create(['code' => 'BKS003', 'name' => 'History']);
    }
}
