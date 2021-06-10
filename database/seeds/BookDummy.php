<?php

use Illuminate\Database\Seeder;

class BookDummy extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function getData($i) {
        $data = new stdClass();
        if ($i == 0) {
            $data->book_image = "https://doramaindo.id/wp-content/uploads/2021/05/DAYS-1.jpg";
            $data->book_link = "https://doramaindo.id/doom-at-your-service-2021-subtitle-indonesia.html";
            $data->book_name = "Doom at Your Service (2021)";
            $data->book_description = "Tak Dong Kyung telah bekerja keras sejak orang tuanya meninggal hidupnya tampak lebih stabil setelah bekerja sebagai editor novel web selama 6 tahun tapi kemudian dia mendapat didiagnosis dengan kanker otak Dia menyalahkan hidupnya yang tidak beruntung dan keinginan untuk mengutuk segala sesuatu untuk menghilang yang tidak sengaja memanggil Myeol Mang seorang utusan antara manusia dan dewa untuk muncul Dia mengatakan bahwa dia dapat mengabulkan keinginan nya Sebagai harapan terakhirnya dia membuat kontrak dengan Myeol Mang selama seratus hari untuk hidup bagaimana dia ingin mempertaruhkan segalanya";
        } else if  ($i == 1) {
            $data->book_image = "https://doramaindo.id/wp-content/uploads/2021/03/RzWeP_4c-1.jpg";
            $data->book_link = "https://doramaindo.id/kimi-to-sekai-ga-owaru-hi-ni-season-2-2021-subtitle-indonesia.html";
            $data->book_name = "Kimi to Sekai ga Owaru Hi ni";
            $data->book_description = "Sebagai komunitas baru “Rumah Harapan” telah muncul. Siapakah mereka dengan peradaban yang makmur? Selain itu, golem dengan “x” yang tampaknya dipasang secara artifisial muncul. Ancaman baru datang kepada mereka yang selamat dari “Akhir Dunia”.";
        } else if  ($i == 2) {
            $data->book_image = "https://upload.wikimedia.org/wikipedia/en/9/90/One_Piece%2C_Volume_61_Cover_%28Japanese%29.jpg";
            $data->book_link = "https://otakudesu.moe/anime/op-sub-indo";
            $data->book_name = "One Piece Subtitle Indonesia";
            $data->book_description = "Gol D Roger dikenal sebagai Raja Bajak Laut, Orang terkuat dan paling terkenal yang pernah mengarungi Grand Line. Penangkapan dan Eksekusi Roger oleh Pemerintahan Dunia telah membawa perubahan di seluruh dunia. Kata kata terakhir sebelum kematiannya mengungkapkan lokasi dari harta karun terbesar di dunia, One Piece. Inilah awal dari era bajak laut, semua orang bermimpi menemukan One Piece (yang mana menjanjikan harta dan tahta yang tak terhingga jumlahnya), dan tentunya merebut gelar dari orang yang pertama menemukannya, gelar Raja Bajak Laut. Monkey D Luffy."; 
        }
        return $data;
    }

    public function run()
    {    
        for ($i = 0; $i < 3; $i++) {
            $dummy = $this->getData($i);
            
            $book = DB::table('books')->insertGetId([
                'link_url_type' => true,
                'book_link' => $dummy->book_link,
                'book_image' => $dummy->book_image,
                'book_name' => $dummy->book_name,
                'book_description' => $dummy->book_description,
                'id_genre' => 1,
            ]);

            DB::table('book_download')->insert([
                'download'=> 0,
                'id_book'=> $book,
            ]);
            
            DB::table('book_views')->insert([
                'view'=> 0,
                'id_book'=> $book,
            ]);
        }
    }
}
