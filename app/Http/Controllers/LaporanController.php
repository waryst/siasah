<?php

namespace App\Http\Controllers;

use App\Models\Lampiran;
use App\Models\Laporan;
use App\Traits\PesanError;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    use PesanError;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instansi_id = auth()->user()->instansi_id;
        return view('content.Laporan');
    }
    public function data_laporan()
    {
        return view('content.DataLaporan');
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
        $request->validate([
            'nama' => 'required',
            'tmp_lhr' => 'required',
            'tgl_lhr' => 'required',
            'orang_tua' => 'required',
            'nis' => 'required',
            'no_ujian' => 'required',
            'no_seri_ijazah' => 'required',
            'tahun_pelajaran' => 'required',
            'no_kepolisian' => 'required',
            'tahun_kepolisian' => 'required',

            'surat_laporan_polisi'=>'required|mimes:pdf,jpg,png,jpeg',
            'raport'=>'required|mimes:pdf,jpg,png,jpeg',
            'ijazah'=>'required|mimes:pdf,jpg,png,jpeg',
            'buku_induk'=>'required|mimes:pdf,jpg,png,jpeg',
            'akte'=>'required|mimes:pdf,jpg,png,jpeg',
            'permohonan_kepsek'=>'required|mimes:pdf,jpg,png,jpeg',
            'pernyataan_mutlak'=>'required|mimes:pdf,jpg,png,jpeg',
            'pernyataan_saksi'=>'required|mimes:pdf,jpg,png,jpeg',


        ], $this->isipesankegiatan()); 
        $sekolah_id = auth()->user()->datasekolah_id;

        $data=Laporan::create([
            'datasekolah_id'=>$sekolah_id,
            'nama' => $request->nama,
            'tmp_lhr' => $request->tmp_lhr,
            'tgl_lhr' => date('Y-m-d', strtotime($request->tgl_lhr)),
            'orang_tua' => $request->orang_tua,
            'nis' => $request->nis,
            'no_ujian' => $request->no_ujian,
            'no_seri_ijazah' => $request->no_seri_ijazah,
            'tahun_pelajaran' => $request->tahun_pelajaran,
            'no_kepolisian' => $request->no_kepolisian,
            'tahun_kepolisian' => date('Y-m-d', strtotime($request->tahun_kepolisian)),
        ]);
        $surat_laporan_polisi = $request->file('surat_laporan_polisi');
        $surat_laporan_polisi_name = $data->nama."-".time(). "." . $request->file('surat_laporan_polisi')->getClientOriginalExtension();      
        $surat_laporan_polisi->storeAs('data/surat_laporan_polisi/', $surat_laporan_polisi_name);



        $raport = $request->file('raport');
        $raport_name = $data->nama."-".time(). "." . $request->file('raport')->getClientOriginalExtension();      
        $raport->storeAs('data/raport/', $raport_name);

        $ijazah = $request->file('ijazah');
        $ijazah_name = $data->nama."-".time(). "." . $request->file('ijazah')->getClientOriginalExtension();      
        $ijazah->storeAs('data/ijazah/', $ijazah_name);

        $buku_induk = $request->file('buku_induk');
        $buku_induk_name = $data->nama."-".time(). "." . $request->file('buku_induk')->getClientOriginalExtension();      
        $buku_induk->storeAs('data/buku_induk/', $buku_induk_name);

        $akte = $request->file('akte');
        $akte_name = $data->nama."-".time(). "." . $request->file('akte')->getClientOriginalExtension();      
        $akte->storeAs('data/akte/', $akte_name);

        $permohonan_kepsek = $request->file('permohonan_kepsek');
        $permohonan_kepsek_name = $data->nama."-".time(). "." . $request->file('permohonan_kepsek')->getClientOriginalExtension();      
        $permohonan_kepsek->storeAs('data/permohonan_kepsek/', $permohonan_kepsek_name);

        $pernyataan_mutlak = $request->file('pernyataan_mutlak');
        $pernyataan_mutlak_name = $data->nama."-".time(). "." . $request->file('pernyataan_mutlak')->getClientOriginalExtension();      
        $pernyataan_mutlak->storeAs('data/pernyataan_mutlak/', $pernyataan_mutlak_name);

        $pernyataan_saksi = $request->file('pernyataan_saksi');
        $pernyataan_saksi_name = $data->nama."-".time(). "." . $request->file('pernyataan_saksi')->getClientOriginalExtension();      
        $pernyataan_saksi->storeAs('data/pernyataan_saksi/', $pernyataan_saksi_name);

        Lampiran::create([
            'laporan_id'=>$data->id,
            'surat_laporan_polisi'=>$surat_laporan_polisi_name ,
            'raport'=>$raport_name,
            'ijazah'=>$ijazah_name,
            'buku_induk'=>$buku_induk_name,
            'akte'=>$akte_name,
            'permohonan_kepsek'=>$permohonan_kepsek_name,
            'pernyataan_mutlak'=>$pernyataan_mutlak_name,
            'pernyataan_saksi'=>$pernyataan_saksi_name,
        ]);
        alert()->success('Sukses','Data Kegiatan Berhasil Dibuat ');
        return response()->json(['url'=> url('laporan')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        return view('content.EditLaporan',['data'=>$laporan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        $rules=[
            'nama' => 'required',
            'tmp_lhr' => 'required',
            'tgl_lhr' => 'required',
            'orang_tua' => 'required',
            'nis' => 'required',
            'no_ujian' => 'required',
            'no_seri_ijazah' => 'required',
            'tahun_pelajaran' => 'required',
            'no_kepolisian' => 'required',
            'tahun_kepolisian' => 'required',
        ]; 

        if($request->hasFile('surat_laporan_polisi')){
            $rules['surat_laporan_polisi']='mimes:pdf,jpg,png,jpeg';
        }
        if($request->hasFile('raport')){
            $rules['raport']='mimes:pdf,jpg,png,jpeg';
        }
        if($request->hasFile('ijazah')){
            $rules['ijazah']='mimes:pdf,jpg,png,jpeg';
        }
        if($request->hasFile('buku_induk')){
            $rules['buku_induk']='mimes:pdf,jpg,png,jpeg';
        }
        if($request->hasFile('akte')){
            $rules['akte']='mimes:pdf,jpg,png,jpeg';
        }
        if($request->hasFile('permohonan_kepsek')){
            $rules['permohonan_kepsek']='mimes:pdf,jpg,png,jpeg';
        }
        if($request->hasFile('pernyataan_mutlak')){
            $rules['pernyataan_mutlak']='mimes:pdf,jpg,png,jpeg';
        }
        if($request->hasFile('pernyataan_saksi')){
            $rules['pernyataan_saksi']='mimes:pdf,jpg,png,jpeg';
        }
        $validasi=$request->validate($rules, $this->isipesankegiatan());

        $data_update=[
            'nama' => $request->nama,
            'tmp_lhr' => $request->tmp_lhr,
            'tgl_lhr' => date('Y-m-d', strtotime($request->tgl_lhr)),
            'orang_tua' => $request->orang_tua,
            'nis' => $request->nis,
            'no_ujian' => $request->no_ujian,
            'no_seri_ijazah' => $request->no_seri_ijazah,
            'tahun_pelajaran' => $request->tahun_pelajaran,
            'no_kepolisian' => $request->no_kepolisian,
            'tahun_kepolisian' => date('Y-m-d', strtotime($request->tahun_kepolisian)),
        ];
        if ($laporan->status!=0){
            $data_update['status']=3;

        }
        Laporan::where('id',$laporan->id)->update($data_update);
        $data_update_lampiran=[ ];
        if($request->hasFile('surat_laporan_polisi')){
            Storage::delete('data/surat_laporan_polisi/'. $laporan->lampiran->surat_laporan_polisi);
            $surat_laporan_polisi = $request->file('surat_laporan_polisi');
            $surat_laporan_polisi_name =$request->nama."-".time(). "." . $request->file('surat_laporan_polisi')->getClientOriginalExtension();      
            $surat_laporan_polisi->storeAs('data/surat_laporan_polisi/', $surat_laporan_polisi_name);
            $data_update_lampiran['surat_laporan_polisi']=$surat_laporan_polisi_name;
            }
        if($request->hasFile('raport')){
            Storage::delete('data/raport/'. $laporan->lampiran->raport);
            $raport = $request->file('raport');
            $raport_name = $request->nama."-".time(). "." . $request->file('raport')->getClientOriginalExtension();      
            $raport->storeAs('data/raport/', $raport_name);
            $data_update_lampiran['raport']=$raport_name;
        }
        if($request->hasFile('ijazah')){
            Storage::delete('data/ijazah/'. $laporan->lampiran->ijazah);
            $ijazah = $request->file('ijazah');
            $ijazah_name = $request->nama."-".time(). "." . $request->file('ijazah')->getClientOriginalExtension();      
            $ijazah->storeAs('data/ijazah/', $ijazah_name);
            $data_update_lampiran['ijazah']=$ijazah_name;
        }
        if($request->hasFile('buku_induk')){
            Storage::delete('data/buku_induk/'. $laporan->lampiran->buku_induk);
            $buku_induk = $request->file('buku_induk');
            $buku_induk_name = $request->nama."-".time(). "." . $request->file('buku_induk')->getClientOriginalExtension();      
            $buku_induk->storeAs('data/buku_induk/', $buku_induk_name);  
            $data_update_lampiran['buku_induk']=$buku_induk_name;
        }
        if($request->hasFile('akte')){
            Storage::delete('data/akte/'. $laporan->lampiran->akte);
            $akte = $request->file('akte');
            $akte_name = $request->nama."-".time(). "." . $request->file('akte')->getClientOriginalExtension();      
            $akte->storeAs('data/akte/', $akte_name);  
            $data_update_lampiran['akte']=$akte_name;
        }
        if($request->hasFile('permohonan_kepsek')){
            Storage::delete('data/permohonan_kepsek/'. $laporan->lampiran->permohonan_kepsek);
            $permohonan_kepsek = $request->file('permohonan_kepsek');
            $permohonan_kepsek_name = $request->nama."-".time(). "." . $request->file('permohonan_kepsek')->getClientOriginalExtension();      
            $permohonan_kepsek->storeAs('data/permohonan_kepsek/', $permohonan_kepsek_name);
            $data_update_lampiran['permohonan_kepsek']=$permohonan_kepsek_name;
        }
        if($request->hasFile('pernyataan_mutlak')){
            Storage::delete('data/pernyataan_mutlak/'. $laporan->lampiran->pernyataan_mutlak);
            $pernyataan_mutlak = $request->file('pernyataan_mutlak');
            $pernyataan_mutlak_name = $request->nama."-".time(). "." . $request->file('pernyataan_mutlak')->getClientOriginalExtension();      
            $pernyataan_mutlak->storeAs('data/pernyataan_mutlak/', $pernyataan_mutlak_name); 
            $data_update_lampiran['pernyataan_mutlak']=$pernyataan_mutlak_name;   
        }
        if($request->hasFile('pernyataan_saksi')){
            Storage::delete('data/pernyataan_saksi/'. $laporan->lampiran->pernyataan_saksi);
            $pernyataan_saksi = $request->file('pernyataan_saksi');
            $pernyataan_saksi_name = $request->nama."-".time(). "." . $request->file('pernyataan_saksi')->getClientOriginalExtension();      
            $pernyataan_saksi->storeAs('data/pernyataan_saksi/', $pernyataan_saksi_name);
            $data_update_lampiran['pernyataan_saksi']=$pernyataan_saksi_name;       
        }

        Lampiran::where('id',$laporan->lampiran->id)->update($data_update_lampiran);

        alert()->success('Sukses','Data Kegiatan Berhasil Diupate');
        return response()->json(['url'=> url('laporan')]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {

        Storage::delete('data/surat_laporan_polisi/'. $laporan->lampiran->surat_laporan_polisi);
        Storage::delete('data/raport/'. $laporan->lampiran->raport);
        Storage::delete('data/ijazah/'. $laporan->lampiran->ijazah);
        Storage::delete('data/buku_induk/'. $laporan->lampiran->buku_induk);
        Storage::delete('data/akte/'. $laporan->lampiran->akte);
        Storage::delete('data/permohonan_kepsek/'. $laporan->lampiran->permohonan_kepsek);
        Storage::delete('data/pernyataan_mutlak/'. $laporan->lampiran->pernyataan_mutlak);
        Storage::delete('data/pernyataan_saksi/'. $laporan->lampiran->pernyataan_saksi);

        Laporan::destroy($laporan->id);
        Lampiran::destroy($laporan->lampiran->id);
        return redirect('/laporan')->with('success','Data Laporan Berhasil Dihapus');
    }
}
