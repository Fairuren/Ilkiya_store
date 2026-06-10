<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        $books = [
            ['name' => 'Laskar Pelangi', 'isbn' => '9786020323732', 'slug' => 'laskar-pelangi', 'category_id' => 1, 'writer_id' => 1, 'publisher_id' => 1, 'price' => 85000, 'discount' => 10, 'stock' => 50],
            ['name' => 'Bumi Manusia', 'isbn' => '9789792281637', 'slug' => 'bumi-manusia', 'category_id' => 2, 'writer_id' => 2, 'publisher_id' => 2, 'price' => 95000, 'discount' => 0, 'stock' => 30],
            ['name' => 'Negeri 5 Menara', 'isbn' => '9786020300023', 'slug' => 'negeri-5-menara', 'category_id' => 1, 'writer_id' => 1, 'publisher_id' => 3, 'price' => 79000, 'discount' => 15, 'stock' => 40],
            ['name' => 'Dilan 1990', 'isbn' => '9786021624135', 'slug' => 'dilan-1990', 'category_id' => 2, 'writer_id' => 2, 'publisher_id' => 1, 'price' => 58000, 'discount' => 5, 'stock' => 60],
            ['name' => 'Perahu Kertas', 'isbn' => '9789792281391', 'slug' => 'perahu-kertas', 'category_id' => 2, 'writer_id' => 1, 'publisher_id' => 2, 'price' => 72000, 'discount' => 20, 'stock' => 25],
            ['name' => 'Sang Pemimpi', 'isbn' => '9789792281262', 'slug' => 'sang-pemimpi', 'category_id' => 1, 'writer_id' => 1, 'publisher_id' => 3, 'price' => 68000, 'discount' => 0, 'stock' => 35],
            ['name' => 'Harry Potter dan Batu Bertuah', 'isbn' => '9786020300030', 'slug' => 'harry-potter-batu-bertuah', 'category_id' => 3, 'writer_id' => 2, 'publisher_id' => 4, 'price' => 125000, 'discount' => 25, 'stock' => 20],
            ['name' => 'The Alchemist', 'isbn' => '9780062315007', 'slug' => 'the-alchemist', 'category_id' => 3, 'writer_id' => 1, 'publisher_id' => 1, 'price' => 110000, 'discount' => 10, 'stock' => 45],
            ['name' => 'Atomic Habits', 'isbn' => '9780735211292', 'slug' => 'atomic-habits', 'category_id' => 4, 'writer_id' => 2, 'publisher_id' => 2, 'price' => 130000, 'discount' => 0, 'stock' => 55],
            ['name' => 'Rich Dad Poor Dad', 'isbn' => '9781612680194', 'slug' => 'rich-dad-poor-dad', 'category_id' => 4, 'writer_id' => 1, 'publisher_id' => 3, 'price' => 98000, 'discount' => 12, 'stock' => 40],
            ['name' => 'Sherlock Holmes', 'isbn' => '9780007351497', 'slug' => 'sherlock-holmes', 'category_id' => 5, 'writer_id' => 2, 'publisher_id' => 4, 'price' => 115000, 'discount' => 8, 'stock' => 30],
            ['name' => 'Filosofi Teras', 'isbn' => '9786020633282', 'slug' => 'filosofi-teras', 'category_id' => 4, 'writer_id' => 1, 'publisher_id' => 1, 'price' => 88000, 'discount' => 0, 'stock' => 70],
        ];

        foreach ($books as $book) {
            DB::table('books')->insert(array_merge($book, [
                'summary' => 'Ringkasan singkat dari buku ' . $book['name'] . '. Sebuah karya yang menarik dan penuh inspirasi.',
                'description' => 'Deskripsi lengkap buku ' . $book['name'] . '. Buku ini mengisahkan perjalanan hidup yang penuh makna dan pelajaran berharga bagi para pembaca.',
                'image' => $book['slug'] . '.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
