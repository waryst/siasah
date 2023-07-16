<?php

namespace App\Traits;


trait PesanError
{
    public function isipesankegiatan()
    {

        $pesan=[
            'nama.required' => 'Nama  Harus Di Isi',
            'tmp_lhr.required' => 'Tempat  Lahir Harus Di Isi',
            'tgl_lhr.required'=>'Tanggal Lahir Harus Di Isi',
            'orang_tua.required'=>'Nama Orang Tua Harus Di Isi',
            'nis.required'=>'NIS Harus Di Isi',
            'no_ujian.required'=>'No Peserta Ujian Sekolah Harus Di Isi',
            'no_seri_ijazah.required'=>'No Seri Ijazah Harus Di Isi',
            'tahun_pelajaran.required'=>'Tahun Pelajaran Harus Di Isi',
            'no_kepolisian.required'=>'No Surat Kehilangan Harus Di Isi',
            'tahun_kepolisian.required'=>'Tanggal surat Harus Di Isi',





            'surat_laporan_polisi.required'=>'Surat Laporan Kehilangan dari Kepolisian Harus Di Upload',
            'surat_laporan_polisi.mimes'=>'Surat Laporan Kehilangan dari Kepolisian harus Gambar Atau Pdf',
            'surat_laporan_polisi.image'=>'Surat Laporan Kehilangan dari Kepolisian harus Gambar Atau Pdf',
            'raport.required'=>'Scan Raport Harus Di Upload',
            'raport.mimes'=>'Scan Raport harus Gambar Atau Pdf',
            'raport.image'=>'Scan Raport harus Gambar Atau Pdf',
            'ijazah.required'=>'Scan Foto Copy Ijazah Harus Di Upload',
            'ijazah.mimes'=>'Scan Foto Copy Ijazah harus Gambar Atau Pdf',
            'ijazah.image'=>'Scan Foto Copy Ijazah harus Gambar Atau Pdf',
            'buku_induk.required'=>'Scan Buku Induk Harus Di Upload',
            'buku_induk.mimes'=>'Scan Buku Induk harus Gambar Atau Pdf',
            'buku_induk.image'=>'Scan Buku Induk harus Gambar Atau Pdf',
            'akte.required'=>'Scan Akte Kelahiran Harus Di Upload',
            'akte.mimes'=>'Scan Akte Kelahiran harus Gambar Atau Pdf',
            'akte.image'=>'Scan Akte Kelahiran harus Gambar Atau Pdf',
            'permohonan_kepsek.required'=>'Surat Permohonan Kepala Sekolah Harus Di Upload',
            'permohonan_kepsek.mimes'=>'Surat Permohonan Kepala Sekolah harus Gambar Atau Pdf',
            'permohonan_kepsek.image'=>'Surat Permohonan Kepala Sekolah harus Gambar Atau Pdf',
            'pernyataan_mutlak.required'=>'Surat Pernyataan Tanggung Jawab Mutlak Harus Di Upload',
            'pernyataan_mutlak.mimes'=>'Surat Pernyataan Tanggung Jawab Mutlak harus Gambar Atau Pdf',
            'pernyataan_mutlak.image'=>'Surat Pernyataan Tanggung Jawab Mutlak harus Gambar Atau Pdf',
            'pernyataan_saksi.required'=>'Surat Pernyataan Dua Orang Saksi Harus Di Upload',
            'pernyataan_saksi.mimes'=>'Surat Pernyataan Dua Orang Saksi harus Gambar Atau Pdf',
            'pernyataan_saksi.image'=>'Surat Pernyataan Dua Orang Saksi harus Gambar Atau Pdf',


        ];
        return $pesan;
    }
    public function isipesan_profilsekolah()
    {
        $pesan=[

            'alamat.required' => 'Harus Di Isi',
            'kepsek.required' => 'Harus Di Isi',
            'nip.required'=>'Harus Di Isi',
            'nosuratdepan.required' => 'Harus Di Isi',
            'nosuratbelakang.required' => 'Harus Di Isi',
            'nomer_surat.required' => 'Harus Di Isi',
            'nomer_surat.numeric' => 'Harus Angka',
            'tgl_surat.required' => 'Harus Di Isi',
        ];
        return $pesan;
    }
}
