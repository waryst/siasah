<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check() and auth()->user()->role == 'administrator') {
            return to_route('verifikasi.index');
        }
        else if (Auth::check() and auth()->user()->role == 'operator') {
            return to_route('laporan.index');
        } else {
            return view('login.index');
        }    
    }
    public function postlogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if (Auth::attempt(['email' => $username, 'password' => $password])) {

            if (auth()->user()->role == 'administrator'){
                return to_route('verifikasi.index');
            }
            elseif (auth()->user()->role == 'operator'){
                return to_route('laporan.index');
            }


        } else {
            return redirect()->route('login');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
