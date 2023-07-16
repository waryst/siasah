@extends('layout.index')

@section('title', 'Edit Laporan')
@push('css')
    <style>
        /* untuk menghilangkan spinner  */
        .spinner,
        .loading-simpan,
        .loading-hapus {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet"
        href="{{ asset('asset') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
@endpush
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Laporan</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="card px-2 col-md-7">
                            <form action="/laporan/{{ $data->id }}" method="POST" enctype="multipart/form-data">

                                <div class="form-group col-8">
                                    <label for="nama">Nama Pemohon</label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        value="{{ strtoupper($data->nama) }}">
                                    <span class="text-danger" id="namaError"></span>
                                </div>
                                <div class="row">
                                    <div class="pl-3 col-4">
                                        <div class="form-group ">
                                            <label for="tmp_lhr">Tempat Lahir</label>
                                            <input type="text" autocomplete="off" class="form-control" id="tmp_lhr"
                                                name="tmp_lhr" value="{{ ucwords(strtolower($data->tmp_lhr)) }}">
                                            <span class="text-danger" id="tmp_lhrError"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group ">
                                            <label>Tanggal Lahir</label>
                                            <div class="input-group date col-12" id="reservationdate"
                                                data-target-input="nearest">
                                                <input type="text" autocomplete="off"
                                                    class="form-control datetimepicker-input col-12" name="tgl_lhr"
                                                    id="tgl_lhr" data-target="#reservationdate"
                                                    value="{{ $data->tgl_lhr }}">
                                                <div class="input-group-append" data-target="#reservationdate"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="text-danger" id="tgl_lhrError"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="orang_tua">Nama Orang Tua</label>
                                    <input type="text" class="form-control" name="orang_tua" id="orang_tua"
                                        value="{{ ucwords(strtolower($data->orang_tua)) }}">
                                    <span class="text-danger" id="orang_tuaError"></span>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="nis">Nomor Induk Siswa (NIS)</label>
                                        <input type="number" class="form-control" name="nis" id="nis"
                                            value="{{ $data->nis }}">
                                        <span class="text-danger" id="nisError"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="no_ujian">Nomer Peserta Ujian Sekolah</label>
                                        <input type="text" class="form-control" name="no_ujian" id="no_ujian"
                                            value="{{ $data->no_ujian }}">
                                        <span class="text-danger" id="no_ujianError"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="no_seri_ijazah">No Seri Ijazah</label>
                                        <input type="text" class="form-control" name="no_seri_ijazah" id="no_seri_ijazah"
                                            value="{{ $data->no_seri_ijazah }} ">
                                        <span class="text-danger" id="no_seri_ijazahError"></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="tahun_pelajaran">Tahun Pelajaran</label>
                                        <input type="text" class="form-control" name="tahun_pelajaran"
                                            id="tahun_pelajaran" value="{{ $data->tahun_pelajaran }}">
                                        <span class="text-danger" id="tahun_pelajaranError"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="no_kepolisian">No Surat Kehilangan dari Kepolisian</label>
                                        <input type="text" class="form-control" name="no_kepolisian"
                                            id="no_kepolisian" value="{{ strtoupper($data->no_kepolisian) }}">
                                        <span class="text-danger" id="no_kepolisianError"></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group ">
                                            <label>Tanggal Surat Kehilangan</label>
                                            <div class="input-group date col-12" id="reservationdate2"
                                                data-target-input="nearest">
                                                <input type="text" autocomplete="off"
                                                    class="form-control datetimepicker-input col-12"
                                                    name="tahun_kepolisian" id="tahun_kepolisian"
                                                    value="{{ $data->tahun_kepolisian }}"
                                                    data-target="#reservationdate2">
                                                <div class="input-group-append" data-target="#reservationdate2"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="text-danger" id="tahun_kepolisianError"></span>
                                        </div>

                                    </div>
                                </div>
                        </div>
                        <div class="card px-2 col-md-5 ">
                            <label>Lampiran Berkas </label>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file" name="surat_laporan_polisi"
                                        id="surat_laporan_polisi">
                                    <label class="custom-file-label" for="surat_laporan_polisi"> 1. Surat Laporan
                                        Kehilangan dari
                                        Kepolisian </label>
                                    <span class="text-danger" id="surat_laporan_polisiError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file" name="raport" id="raport">
                                    <label class="custom-file-label" for="raport"> 2. Scan Raport Asli </label>
                                    <span class="text-danger" id="raportError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file" name="ijazah" id="ijazah">
                                    <label class="custom-file-label" for="ijazah"> 3. Scan Foto Copy Ijazah </label>
                                    <span class="text-danger" id="ijazahError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file" name="buku_induk" id="buku_induk">
                                    <label class="custom-file-label" for="buku_induk"> 4. Scan Buku Induk Asli </label>
                                    <span class="text-danger" id="buku_indukError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file" name="akte" id="akte">
                                    <label class="custom-file-label" for="akte"> 5. Scan Akte Kelahiran Asli </label>
                                    <span class="text-danger" id="akteError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file" name="permohonan_kepsek"
                                        id="permohonan_kepsek">
                                    <label class="custom-file-label" for="permohonan_kepsek"> 6. Surat Permohonan Kepala
                                        Sekolah
                                        Asli </label>
                                    <span class="text-danger" id="permohonan_kepsekError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file" name="pernyataan_mutlak"
                                        id="pernyataan_mutlak">
                                    <label class="custom-file-label" for="pernyataan_mutlak"> 7. Surat Pernyataan Tanggung
                                        Jawab
                                        Mutlak </label>
                                    <span class="text-danger" id="pernyataan_mutlakError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file" name="pernyataan_saksi"
                                        id="pernyataan_saksi">
                                    <label class="custom-file-label" for="pernyataan_saksi"> 8. Surat Pernyataan Dua Orang
                                        Saksi
                                    </label>
                                    <span class="text-danger" id="pernyataan_saksiError"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="button" id="submit" value="Submit" data-id={{ $data->id }}
                            class="btn btn-sm bg-gradient-primary float-md-right button-simpan">Simpan</button>
                        <button class="btn btn-sm bg-gradient-primary float-md-right loading-simpan">
                            <div class="spinner">
                                <i role="status" class="spinner-border spinner-border-sm">
                                </i>
                                Simpan
                            </div>
                        </button>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>

@endsection
@push('java')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('asset') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $("#datatable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "ordering": false,
                "columnDefs": [{
                    "targets": [0], //first column / numbering column
                    "orderable": false, //set not orderable
                }, ],
            });
        });
        $(document).ready(function() {
            $('#submit').click(function(e) {
                e.preventDefault();
                $('.button-simpan').hide();
                $('.loading-simpan').show();
                $('.loading-simpan').attr('disabled', 'true');
                $('.spinner').show();

                var id = $(this).data('id');
                var nama = $('#nama').val();
                var tmp_lhr = $('#tmp_lhr').val();
                var tgl_lhr = $('#tgl_lhr').val();
                var orang_tua = $('#orang_tua').val();
                var nis = $('#nis').val();
                var no_ujian = $('#no_ujian').val();
                var no_seri_ijazah = $('#no_seri_ijazah').val();
                var tahun_pelajaran = $('#tahun_pelajaran').val();
                var no_kepolisian = $('#no_kepolisian').val();
                var tahun_kepolisian = $('#tahun_kepolisian').val();
                var surat_laporan_polisi = $('#surat_laporan_polisi')[0].files;
                var raport = $('#raport')[0].files;
                var ijazah = $('#ijazah')[0].files;
                var buku_induk = $('#buku_induk')[0].files;
                var akte = $('#akte')[0].files;
                var permohonan_kepsek = $('#permohonan_kepsek')[0].files;
                var pernyataan_mutlak = $('#pernyataan_mutlak')[0].files;
                var pernyataan_saksi = $('#pernyataan_saksi')[0].files;

                var fd = new FormData();
                fd.append('nama', nama);
                fd.append('tmp_lhr', tmp_lhr);
                fd.append('tgl_lhr', tgl_lhr);
                fd.append('orang_tua', orang_tua);
                fd.append('nis', nis);
                fd.append('no_ujian', no_ujian);
                fd.append('no_seri_ijazah', no_seri_ijazah);
                fd.append('tahun_pelajaran', tahun_pelajaran);
                fd.append('no_kepolisian', no_kepolisian);
                fd.append('tahun_kepolisian', tahun_kepolisian);

                if (typeof surat_laporan_polisi[0] == "undefined") {
                    fd.append('surat_laporan_polisi', $('#surat_laporan_polisi').val());
                } else {
                    fd.append('surat_laporan_polisi', surat_laporan_polisi[0]);
                }
                if (typeof raport[0] == "undefined") {
                    fd.append('raport', $('#raport').val());
                } else {
                    fd.append('raport', raport[0]);
                }
                if (typeof ijazah[0] == "undefined") {
                    fd.append('ijazah', $('#ijazah').val());
                } else {
                    fd.append('ijazah', ijazah[0]);
                }
                if (typeof buku_induk[0] == "undefined") {
                    fd.append('buku_induk', $('#buku_induk').val());
                } else {
                    fd.append('buku_induk', buku_induk[0]);
                }
                if (typeof akte[0] == "undefined") {
                    fd.append('akte', $('#akte').val());
                } else {
                    fd.append('akte', akte[0]);
                }
                if (typeof permohonan_kepsek[0] == "undefined") {
                    fd.append('permohonan_kepsek', $('#permohonan_kepsek').val());
                } else {
                    fd.append('permohonan_kepsek', permohonan_kepsek[0]);
                }
                if (typeof pernyataan_mutlak[0] == "undefined") {
                    fd.append('pernyataan_mutlak', $('#pernyataan_mutlak').val());
                } else {
                    fd.append('pernyataan_mutlak', pernyataan_mutlak[0]);
                }
                if (typeof pernyataan_saksi[0] == "undefined") {
                    fd.append('pernyataan_saksi', $('#pernyataan_saksi').val());
                } else {
                    fd.append('pernyataan_saksi', pernyataan_saksi[0]);
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('update') }}/" + id,
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',

                    success: function(data) {
                        window.location = data.url;
                        // alert(url);
                    },
                    error: function(data) {
                        $('#nama').removeClass('is-invalid');
                        $('#tmp_lhr').removeClass('is-invalid');
                        $('#tgl_lhr').removeClass('is-invalid');
                        $('#orang_tua').removeClass('is-invalid');
                        $('#nis').removeClass('is-invalid');
                        $('#no_ujian').removeClass('is-invalid');
                        $('#no_seri_ijazah').removeClass('is-invalid');
                        $('#tahun_pelajaran').removeClass('is-invalid');
                        $('#no_kepolisian').removeClass('is-invalid');
                        $('#tahun_kepolisian').removeClass('is-invalid');


                        $('#namaError').addClass('d-none');
                        $('#tmp_lhrError').addClass('d-none');
                        $('#tgl_lhrError').addClass('d-none');
                        $('#orang_tuaError').addClass('d-none');
                        $('#nisError').addClass('d-none');
                        $('#no_ujianError').addClass('d-none');
                        $('#no_seri_ijazahError').addClass('d-none');
                        $('#tahun_pelajaranError').addClass('d-none');
                        $('#no_kepolisianError').addClass('d-none');
                        $('#tahun_kepolisianError').addClass('d-none');


                        $('#surat_laporan_polisiError').addClass('d-none');
                        $('#raportError').addClass('d-none');
                        $('#ijazahError').addClass('d-none');
                        $('#buku_indukError').addClass('d-none');
                        $('#akteError').addClass('d-none');
                        $('#permohonan_kepsekError').addClass('d-none');
                        $('#pernyataan_mutlakError').addClass('d-none');
                        $('#pernyataan_saksiError').addClass('d-none');

                        $('.button-simpan').show();
                        $('.loading-simpan').hide();
                        $('.loading-simpan').attr('disabled', 'true');
                        $('.spinner').hide();
                        var errors = data.responseJSON;
                        if ($.isEmptyObject(errors) == false) {
                            $.each(errors.errors, function(key, value) {
                                var ErrorID = '#' + key + 'Error';
                                var InputID = '#' + key;
                                $(InputID).addClass("is-invalid");
                                $(ErrorID).removeClass("d-none");
                                $(ErrorID).text(value);
                            })
                        }
                    }
                });
            });

            $('.tombol-hapus').on('click', function(e) {
                e.preventDefault();
                const id = $(this).attr('id');
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data Kegiatan akan di hapus!!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus Data!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete' + id).submit();
                        $('#' + $(this).data('id')).attr('hidden', 'true');
                        $('#loading-hapus' + $(this).data('id')).show();
                        $('#loading-hapus' + $(this).data('id')).attr('disabled', 'true');
                        $('.spinner').show();
                    }
                })
            });
        });
        $(function() {
            $("#reservationdate").datetimepicker({
                format: "DD-MM-YYYY",
            });
            $("#reservationdate2").datetimepicker({
                format: "DD-MM-YYYY",
            });
        });
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
@endpush
