<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthsController extends Controller
{


    public function login()
    {
        return view('Auth/login');
    }

    public function loginPost(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $data = DB::table('users')->where('email', $request->email)->first();
        if ($data) {
            if (Hash::check($request->password, $data->password)) {
                if ($data->is_verifed == 0) {
                    return redirect('auth/login')->with('message', 'Email belum verifycation. Silahkan cek Email terlebih dahulu !');
                } else {
                    Session::put('id', $data->id);
                    Session::put('email', $data->email);
                    Session::put('login', TRUE);

                    return redirect('/');
                }
            } else {
                return redirect('auth/login')->with('message', 'Password  Salah !');
            }
        } else {
            return redirect('auth/login')->with('message', 'Email Salah!');
        }
    }



    public function register()
    {
        return view('Auth/register');
    }


    public function registerpost(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        $data = DB::table("users")->where('email', $request->email)->first();
        if (!$data) {
            DB::table('users')->insert([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'token' => bin2hex(random_bytes(32)),
                'is_verifed' => 1,
            ]);
    
            // $data =  DB::table('users')->where('email', $request->email)->value('token');
    
            // Mail::send('Auth/sendemail', ['token' => $data, 'email' => $request->email], function ($message) use ($request) {
            //     $message->to([$request->email])->subject('Verification');
            //     $message->from('ptkevman@gmail.com', 'Kevman');
            // });
    
            return redirect('auth/login')->with('message', 'Email berhasil di register, silahkan Login!');
        } else {
            return redirect('auth/register')->with('message', 'Email sudah terpakai');
        } 
    }


    public function verify(Request $request)
    {
        $email = $request->input('email');
        $token = $request->input('token');

        $user = DB::table('users')->where('token', $token)->where('email', $email)->first();

        if ($user) {
            DB::table('users')->where('email', $email)->update([
                'is_verifed' => 1,
                'token' => bin2hex(random_bytes(32)),
            ]);
            return redirect('auth/login')->with('message', 'Data berhasil di verifikasi, silahkan login');
        } else {
            return redirect('auth/login')->with('message', 'Kesalahan URL Server');
        }
    }
}
