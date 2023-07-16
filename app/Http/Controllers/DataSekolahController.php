<?php

namespace App\Http\Controllers;

use App\Models\DataSekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kirim['data_sekolah']= DataSekolah::orderBy('nama','ASC')->get();        
        return view('content.DataSekolah',$kirim);    }

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
        $validasi=$request->validate([
            'nama' => 'required|unique:data_sekolahs',
            'name'=>'required',
            'email' => 'required|unique:users',
        ], 
        [
            'nama.required' => "Nama Sekolah Harus di isi",
            'nama.unique' => "Nama Sekolah Sudah Terdaftar",
            'name.required' => "Nama Operator Harus di isi",
            'email.required' => "User / Email Operator Harus di isi",
            'email.unique' => "User / Email Operator Sudah Terdaftar",
        ]); 

        $password = Hash::make('siasah');
        $data=DataSekolah::create([
            'nama'=>$request->nama,
        ]);
        
        User::create([
            'datasekolah_id'=>$data->id,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> $password,
            'role'=>'operator',
        ]);
        alert()->success('Sukses','Data Sekolah Berhasil Dibuat');
        return response()->json(['url'=> url('sekolah')]);    
    }

    /**
     * Display the specified resource.
     */
    public function show(DataSekolah $sekolah)
    {
        $kirim['data_sekolah']=$sekolah;
        $kirim['data_operator']=$sekolah->user;
        return response()->json($kirim);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataSekolah $dataSekolah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataSekolah $dataSekolah)
    {
        //
    }

    public function updatedata(Request $request,DataSekolah $data)
    {
        $rules=[
            'editnama' => 'required',
            'editname'=>'required',
            'editemail' => 'required',
    ];
        if($request->editnama!=null and $request->editnama!=$data->nama ){
            $rules['editnama']='unique:data_sekolahs,nama';
        }
        if($request->editemail!=null and $request->editemail!=$data->user->email ){
            $rules['editemail']='unique:users,email';
        }
        $request->validate($rules,
        [
            'editnama.required' => "Nama Sekolah Harus di isi",
            'editnama.unique' => "Nama Sekolah Sudah Terdaftar",
            'editname.required' => "Nama Operator Harus di isi",
            'editemail.required' => "User / Email Operator Harus di isi",
            'editemail.unique' => "User / Email Operator Sudah Terdaftar",
        ]);
            $data_update=['nama'=>$request->editnama];
            if($request->hak=='on' ){
                $password = Hash::make('siasah');
                $update_user=[
                    'name'=>$request->editname,
                    'email'=>$request->editemail,
                    'password'=> $password,
                ];
            }
            else{
                $update_user=[
                    'name'=>$request->editname,
                    'email'=>$request->editemail,
                ];
            }

            DB::beginTransaction();
        try{
            DataSekolah::where('id',$data->id)->update($data_update);
            User::where('id',$data->user->id)->update($update_user);

            DB::commit();
        }
        catch(\Exception $exception){
            return response()->json(['cek'=>$data->user->email.'-'.$exception]);
            DB::rollBack();
        }
        alert()->success('Sukses','Data Sekolah Berhasil Dperbaharui');
        return response()->json(['url'=>url('sekolah')]);

        
        
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataSekolah $dataSekolah)
    {
        //
    }
}
