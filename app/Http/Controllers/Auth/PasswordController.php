<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit()
    {
        // $data['instansi'] =  auth()->user()->instansi;
        return view('content.changePassword');
    }
    public function update(UpdatePasswordRequest $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->get('password'))
        ]);
        return redirect('/logout')->with('success', 'Proses Update Password sudah berhasil!');;
    }

}
