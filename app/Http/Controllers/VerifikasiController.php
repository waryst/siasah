<?php

namespace App\Http\Controllers;

use App\Models\DataSekolah;
use App\Models\Laporan;
use App\Models\NoSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;

class VerifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->path()=='dataverifikasi'){
            $kirim['data_laporan'] = Laporan::whereIn('status',[1])->orderBy('id', 'DESC')->get();
        }
        else{
            $kirim['data_laporan'] = Laporan::whereIn('status',[0,3])->orderBy('id', 'DESC')->get();
        }
        return view('content.Verifikasi',$kirim);
    }
    public function show(Laporan $verifikasi)
    {
        $kirim['pencarian_data']=$verifikasi;
        $kirim['pencarian_kepsek']=$verifikasi->datasekolah->profilsekolah;
        $kirim['tgl_lhr']= Carbon::parse($verifikasi->tgl_lhr)->isoFormat('D MMMM Y');
        $carinosurat = NoSurat::where('laporan_id',$verifikasi->id)->first();

        $kirim['nomer_surat'] = $carinosurat->nomer_surat ?? "";
        $kirim['tgl_surat'] = date('d-m-Y', strtotime($carinosurat->tanggal_surat ?? "now")) ?? " ";

        return response()->json($kirim);
        return response()->json(['pencarian_data' => $verifikasi]);
    }
    public function update(Request $request, Laporan $verifikasi)
    {
        if($request->status==1){
            $data_update=[
                'note' => null,
                'status' => 1,
            ];
            $result = Builder::create()
                ->writer(new PngWriter())
                ->writerOptions([])
                ->data('
                SURAT KETERANGAN PENGGANTI IJAZAH
                     Kode Laporan : '.$verifikasi->id.'
                ')
                // ->data('
                // SURAT KETERANGAN PENGGANTI IJAZAH
                // Nama : '.ucwords(strtolower($verifikasi->nama)).'
                // Asal Sekolah : '.strtoupper($verifikasi->datasekolah->nama).'
                // NIS : '.$verifikasi->nis.'
                // Nomer Peserta Ujian : '.strtoupper($verifikasi->no_ujian).'
                // Nomer Seri Ijazah : '.$verifikasi->no_seri_ijazah.'
                // Tahun Pelajaran : '.$verifikasi->tahun_pelajaran.'

                // Telah Diketahui Oleh Dinas Pendidikan Kabupaten Ponorogo
                // Kepala Dinas Pendidikan : '.$verifikasi->datasekolah->profilsekolah->kepsek.'
                // NIP : '.$verifikasi->datasekolah->profilsekolah->nip.'
                // Kode Laporan : '.$verifikasi->id.'
                // ')
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                ->size(300)
                ->margin(10)
                ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
                ->logoPath(public_path().'/logo.png')
                ->logoResizeToWidth(80)
                ->logoPunchoutBackground(false)
                // ->labelText('This is the label')
                // ->labelFont(new NotoSans(20))
                // ->labelAlignment(new LabelAlignmentCenter())
                ->validateResult(false)
                ->build();
                header('Content-Type: '.$result->getMimeType());
                    $path_qr = Storage::path('data/qrcode/'.$verifikasi->id.'.png');  
                    $result->saveToFile($path_qr);
                    $dataUri = $result->getDataUri();
        }
        else{
            $data_update=[
                'note' => $request->catatan,
                'status' => 2,
            ];
        }
        Laporan::where('id',$verifikasi->id)->update($data_update);
        return redirect('/verifikasi')->with('success', 'Proses Verifikasi data sudah berhasil!');

    }
    
}
