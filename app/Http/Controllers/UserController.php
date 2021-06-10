<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function home(Request $request)
    {
        if ($request->input('page')) {
            $page = $request->input('page');
        } else {
            $page = 1;
        }

        $next = $page + 1;
        $pref = $page - 1;

        $data = DB::table('books')
        ->join('book_views', 'book_views.id_book', '=', 'books.id')
        ->join('book_download', 'book_download.id_book', '=', 'books.id')
        ->limit(5)
        ->offset(($page - 1) * 5)
        ->get();


        $book_popular_view = DB::table('books')
            ->join('genres', 'books.id_genre', '=', 'genres.id')
            ->join('book_views', 'book_views.id_book', '=', 'books.id')
            ->orderBy('book_views.view', 'desc')
            ->limit(5)->get();
        
        $book_popular_download = DB::table('books')
            ->join('genres', 'books.id_genre', '=', 'genres.id')
            ->join('book_download', 'book_download.id_book', '=', 'books.id')
            ->orderBy('book_download.download', 'desc')
            ->limit(5)
            ->get();

        $total = ceil(DB::table('books')->count() / 5);
        $number = range(1, $total);

        return view('/books/home', [
            'data' => $data,
            'book_popular_view' => $book_popular_view,
            'book_popular_download' => $book_popular_download,
            'active' => $page,
            'total' => $number,
            'next' => $next,
            'pref' => $pref,
            'count' => $total
        ]);
    }

    public function bookdetail(Book $book)
    {
        $book_detail = DB::table('books')
            ->join('book_views', 'book_views.id_book', '=', 'books.id')
            ->join('book_download', 'book_download.id_book', '=', 'books.id')
            ->where('books.id', $book->id)
            ->first();

        $book_popular_view = DB::table('books')
            ->join('genres', 'books.id_genre', '=', 'genres.id')
            ->join('book_views', 'book_views.id_book', '=', 'books.id')
            ->orderBy('book_views.view', 'desc')
            ->limit(5)
            ->get();
        
        $book_popular_download = DB::table('books')
            ->join('genres', 'books.id_genre', '=', 'genres.id')
            ->join('book_download', 'book_download.id_book', '=', 'books.id')
            ->orderBy('book_download.download', 'desc')
            ->limit(5)
            ->get();

        DB::table('book_views')->where('id_book', $book->id)->increment('view');

        return view('books/detail', [
            'book_detail' => $book_detail,
            'book_popular_view' => $book_popular_view,
            'book_popular_download' => $book_popular_download,
        ]);
    }
}
