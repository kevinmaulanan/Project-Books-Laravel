<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Book;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{

    public function bookall(Request $request)
    {
        if ($request->input('page')) {
            $page = $request->input('page');
        } else {
            $page = 1;
        }

        $next = $page + 1;
        $pref = $page - 1;

        $data = DB::table('books')
        ->join('genres', 'books.id_genre', '=', 'genres.id')
        ->select('books.*', 'genres.genre')
        ->limit(5)
        ->offset(($page - 1) * 5)
        ->get();
        
        $views = DB::table('book_views')->get();
        $download = DB::table('book_download')->get();

        $total = ceil(DB::table('books')->count() / 5);
        $number = range(1, $total);

        return view('admin.books.books', [
            'data' => $data,
            'view' => $views,
            'download' => $download,
            'active' => $page,
            'total' => $number,
            'next' => $next,
            'pref' => $pref,
            'count' => $total
        ]);
    }

    public function bookcreateview()
    {
        $genres = DB::table('genres')->get();
        return view('admin/books/createbook', ['genres' => $genres]);
    }

    public function bookcreate(Request $request)
    {
        
        $request->validate([
            'book' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'filepdf' => 'required|mimes:pdf,docx,rar'
        ]);
        $bookpdf = $request->file('filepdf');
        $image = $request->file('image');

        $fileNamePdf = 'KEVMAN-Collection' . $request->book . '-' . time() . '.' . $bookpdf->getClientOriginalExtension();
        $fileNameImage = 'KEVMAN-Collection' . $request->book . '-' . time() . '.' . $image->getClientOriginalExtension();

        DB::table('books')->insert([
            'book_name' => $request->book,
            'book_image' => $fileNameImage,
            'book_link' => $fileNamePdf,
            'book_description' => $request->description,
            'id_genre' => $request->genre,
            'is_deleted' => 0,
        ]);

        $maxId = DB::table('books')->max('id');

        DB::table('book_views')->insert([
            'view' => 0,
            'id_book' => $maxId
        ]);

        DB::table('book_download')->insert([
            'download' => 0,
            'id_book' => $maxId
        ]);

        $bookpdf->storeAs('public/book', $fileNamePdf);
        $image->storeAs('public/image', $fileNameImage);

        return redirect('admin/books')->with('message', 'Data Buku Sudah Ditambahkan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request, $id)
    {
        $book = DB::table('books')->where("id", $id)->first();
        if ($book) {
            DB::table('book_download')->where('id_book', $book->id)->increment('download');
            if (!$book->link_url_type) {
                $link = public_path('storage/book/' . $book->book_link);
                $headers = [
                    'Content-Type' => 'application/pdf',
                ];
                return Response::download($link, $book->book_link, $headers);
            } else {
                return redirect($book->book_link);
            }
        }
        return redirect('book/detail/'. $id);
    }


    public function genrebook(Request $request)
    {
        if ($request->input('page')) {
            $page = $request->input('page');
        } else {
            $page = 1;
        }

        $next = $page + 1;
        $pref = $page - 1;

        $data = DB::table('books')->limit(5)->offset(($page - 1) * 5)->get();

        $views = DB::table('book_views')->get();
        $download = DB::table('book_download')->get();

        $total = ceil(DB::table('books')->count() / 5);
        $number = range(1, $total);

        return view('admin.books.books', [
            'data' => $data,
            'view' => $views,
            'download' => $download,
            'active' => $page,
            'total' => $number,
            'next' => $next,
            'pref' => $pref,
            'count' => $total
        ]);
    }

    public function genreview()
    {
        // $data = DB::table('books')->join('book_for_genre', 'books.id', '=', 'book_for_genre.id_book')->join('genres', 'book_for_genre.id_genre', '=', 'genres.id')->select('books.id', 'books.book_name', 'genres.genre')->get();

        $data = Book::get();
        return view('Admin/genres/genre', ['data' => $data]);
    }



    public function genrecreate(Request $request)
    {
        $request->validate([
            'book' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'filepdf' => 'required|mimes:pdf,docx,rar'
        ]);
        $bookpdf = $request->file('filepdf');
        $image = $request->file('image');

        $fileNamePdf = 'KEVMAN-Collection' . $request->book . '-' . time() . '.' . $bookpdf->getClientOriginalExtension();
        $fileNameImage = 'KEVMAN-Collection' . $request->book . '-' . time() . '.' . $image->getClientOriginalExtension();

        DB::table('books')->insert([
            'book_name' => $request->book,
            'book_image' => $fileNameImage,
            'book_link' => $fileNamePdf,
            'book_description' => $request->description,
            'is_deleted' => 0,
        ]);

        $maxId = DB::table('books')->max('id');

        DB::table('book_views')->insert([
            'view' => 0,
            'id_book' => $maxId
        ]);

        DB::table('book_download')->insert([
            'download' => 0,
            'id_book' => $maxId
        ]);

        $bookpdf->storeAs('public/book', $fileNamePdf);
        $image->storeAs('public/image', $fileNameImage);

        return redirect('admin/books')->with('message', 'Data Buku Sudah Ditambahkan');
    }
}
