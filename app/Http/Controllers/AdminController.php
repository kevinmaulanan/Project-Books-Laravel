<?php

namespace App\Http\Controllers;

use App\AdminModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bookall(Request $request)
    {
        if ($request->input('page')) {
            $page = $request->input('page');
        } else {
            $page = 1;
        }

        $next = $page + 1;
        $pref = $page - 1;

        $data = DB::table('books')->limit(5)->offset(($page - 1) * 5)->get();

        $total = ceil(DB::table('books')->count() / 5);
        $number = range(1, $total);

        return view('admin.books.books', ['data' => $data, 'active' => $page, 'total' => $number, 'next' => $next, 'pref' => $pref]);
    }

    public function bookcreateview()
    {
        return view('admin/books/createbook');
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
    public function download(Request $request)
    {
        $book = public_path('storage/book/' . $request->input('books'));
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
        return Response::download($book, $request->input('books'), $headers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminModels  $adminModels
     * @return \Illuminate\Http\Response
     */
    public function show(AdminModels $adminModels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminModels  $adminModels
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminModels $adminModels)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminModels  $adminModels
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminModels $adminModels)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminModels  $adminModels
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminModels $adminModels)
    {
        //
    }
}
