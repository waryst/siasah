<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah as ModelsProfilSekolah;
use App\Models\User;
use App\Traits\PesanError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilSekolah extends Controller
{
    use PesanError;
    /**
     * Display a listing of the resource.
     */
    public function update(Request $request,User $profil)
    {
        if($profil->datasekolah_id==Auth()->user()->datasekolah_id){
            $id=$profil->datasekolah->profilsekolah->id ?? "";
            $rules=[
                'alamat' => 'required',
                'kepsek'=>'required',
                'nip'=>'required',
                'no_depan'=>'required',
                'no_belakang'=>'required',
            ];
            $validasi=$request->validate($rules, $this->isipesan_profilsekolah());
            $validasi['datasekolah_id']=Auth()->user()->datasekolah_id;
            ModelsProfilSekolah::updateOrCreate(
                ['id' => $id],$validasi,
            );
            alert()->success('Sukses','Data Profil Sekolah Berhasil diubah');
            return redirect(url("/profil/".Auth()->user()->id));

        }
        else{
            return redirect(url("/profil/".Auth()->user()->id));
        }

    }
  public function show(User $profil)
    {
        if($profil->datasekolah_id==Auth()->user()->datasekolah_id){
            return view('content.ProfilSekolah',['profil'=>$profil]);
        }
        else{
            return redirect(url("/profil/".Auth()->user()->id));
        }
    }

    
}
