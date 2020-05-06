<?php

namespace App\Http\Controllers;

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

        $data = DB::table('books')->limit(5)->offset(($page - 1) * 5)->get();

        $total = ceil(DB::table('books')->count() / 5);
        $number = range(1, $total);
        return view('/books/home', ['data' => $data, 'active' => $page, 'total' => $number, 'next' => $next, 'pref' => $pref]);
    }
}
