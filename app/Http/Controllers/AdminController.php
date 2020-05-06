<?php

namespace App\Http\Controllers;

use App\AdminModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bookall()
    {
        $data = DB::table('books')->get();
        return view('admin.books.books', ['data' => $data]);
    }

    public function bookcreateview()
    {
        return view('admin.books.createbook');
    }

    public function bookcreate(Request $request)
    {
        $request->validate([
            'book' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'filepdf' => 'required|mimes:pdf,docx'
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

        return redirect('admin/books/books')->with('message', 'Data Buku Sudah Ditambahkan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        //
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
