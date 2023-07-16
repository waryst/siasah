<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\NoSurat;
use App\Traits\PesanError;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;

class CetakController extends Controller
{
    use PesanError;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('content.CetakLaporan');
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
    public function show(Request $request, Laporan $data)
    {
        $kirim['pencarian_data']=$data;
        $kirim['pencarian_kepsek']=$data->datasekolah->profilsekolah;
        $kirim['tgl_lhr']= Carbon::parse($data->tgl_lhr)->isoFormat('D MMMM Y');
        $carinosurat = NoSurat::where('laporan_id',$data->id)->first();

        $kirim['nomer_surat'] = $carinosurat->nomer_surat ?? "";
        $kirim['tgl_surat'] = date('d-m-Y', strtotime($carinosurat->tanggal_surat ?? "now")) ?? " ";

        return response()->json($kirim);
    }
   public function update(Request $request,Laporan $data)
    {
        $rules=[
            'nomer_surat' => 'required',
            'nomer_surat' => 'numeric',
            'tgl_surat' => 'required',

        ];
        Storage::delete('data/surat/'.$data->nosurat->file.'.pdf');
        $file=time()."-".$data->id;
        $validasi=$request->validate($rules, $this->isipesan_profilsekolah());
        $validasi['laporan_id']=$data->id;
        $validasi['tanggal_surat']= date('Y-m-d', strtotime($request->tgl_surat));
        $validasi['file']= $file;
        $nomer_surat=NoSurat::updateOrCreate(
            ['laporan_id' => $data->id],$validasi,
        );
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');
        $phpWord->setValues([
            'nama_sekolah'=>strtoupper($data->datasekolah->nama),
            'alamat_sekolah'=>ucwords(strtolower($data->datasekolah->profilsekolah->alamat)),
            'no_kepolisian'=>strtoupper($data->no_kepolisian),
            'nama'=>ucwords(strtolower($data->nama)),
            'tmp_lhr'=>ucwords(strtolower($data->tmp_lhr)),
            'tgl_lhr'=>Carbon::parse($data->tgl_lhr)->isoFormat('D MMMM Y'),
            'ortu'=>ucwords(strtolower($data->orang_tua)),
            'nis'=>$data->nis,
            'no_ujian'=>strtoupper($data->no_ujian),
            'seri_ijazah'=>$data->no_seri_ijazah,
            'tahun_pelajaran'=>$data->tahun_pelajaran,
            'tanggal_kepolisian'=>Carbon::parse($data->tahun_kepolisian)->isoFormat('D MMMM Y'),
            'kepsek'=>$data->datasekolah->profilsekolah->kepsek,
            'nip_kepsek'=>$data->datasekolah->profilsekolah->nip,
            'no_depan'=>$data->datasekolah->profilsekolah->no_depan,
            'no_belakang'=>$data->datasekolah->profilsekolah->no_belakang,
            'no_surat'=>$nomer_surat->nomer_surat,
            'tgl_surat'=>Carbon::parse($nomer_surat->tanggal_surat)->isoFormat('D MMMM Y'),
        ]);
        $path = Storage::path('data/surat/'.$file.'.docx'); 
        $path_qr = Storage::path('data/qrcode/'.$data->id.'.png');  
 
        $phpWord->setImageValue('qrcode', ["path" =>$path_qr, 'width'=>130,'height'=>130]);

        $phpWord->saveAs($path);

        // exec("libreoffice  --headless --convert-to pdf:writer_pdf_Export ".$path." --outdir ".Storage::path('data/surat/'));

        // Storage::delete('data/surat/'.$file.'.docx');

        return response()->json(['url'=> url('cetaklaporan'),'download'=> url('download/surat/' . $data->id)]);
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
 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
