<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Genre extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genre = array(
            'Art', 'Biography', 'Business' . 'Chick Lit', 'Childrens', 'Classics', 'Comedy', 'Comics', 'Contemporary', 'Cookbooks', 'Crime', 'Ebooks', 'Fantasy', 'Fiction', 'Graphic Novels', 'Historical Fiction', 'History', 'Horror', 'Manga', 'Memoir', 'Music', 'Mystery', 'Nonfiction', 'Paranormal', 'Philosophy', 'Poetry', 'Psychology', 'Religion', 'Romance', 'Science', 'Self Help', 'Suspense', 'Spirituality', 'Sports', 'Thriller', 'Travel'
        );

        for ($i = 0; $i < count($genre); $i++) {
            DB::table('genres')->insert([
                'genre' => $genre[$i]
            ]);
        }
    }
}
