<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download($kategori,Laporan $data){
        if ($kategori=="surat"){
            $file=$data->nosurat->file.".pdf";
            $filename=strtoupper($data->nama);
            return response()->download(storage_path('app/data/surat/'.$file),$filename.".pdf");
        }
        else{

            if ($kategori=="surat_laporan_polisi"){
                $file=$data->lampiran->$kategori;
                $namafile="1. Surat Laporan Kehilangan";
            }
            if ($kategori=="raport"){
                $file=$data->lampiran->$kategori;
                $namafile="2. Raport";
            }
            if ($kategori=="ijazah"){
                $file=$data->lampiran->$kategori;
                $namafile="3. Ijazah";
            }
            if ($kategori=="buku_induk"){
                $file=$data->lampiran->$kategori;
                $namafile="4. Buku Induk";
            }
            if ($kategori=="akte"){
                $file=$data->lampiran->$kategori;
                $namafile="5. Akte";
            }
            if ($kategori=="permohonan_kepsek"){
                $file=$data->lampiran->$kategori;
                $namafile="6. Surat Permohonan Kepala Sekolah";
            }
            if ($kategori=="pernyataan_mutlak"){
                $file=$data->lampiran->$kategori;
                $namafile="7. Surat Pernyataan Tanggung Jawab Mutlak";
            }
            if ($kategori=="pernyataan_saksi"){
                $file=$data->lampiran->$kategori;
                $namafile="8. Surat Pernyataan Dua Orang Saksi";
            }
            $ext = pathinfo(storage_path().'app/data/'.$kategori.'/'.$file, PATHINFO_EXTENSION);
            $filename=strtoupper($data->nama)." ".$namafile;
            return response()->download(storage_path('app/data/'.$kategori.'/'.$file),$filename.".".$ext);
        }
    }
}
