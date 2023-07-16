@extends('layout.index')

@section('title', 'Kegiatan')
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
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    @if (request()->path() == 'dataverifikasi')
                        Data Laporan Terverifikasi
                    @else
                        Verifikasi Laporan
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <table id="datatable" name="datatable" class="table text-nowrap ">
                    <tbody>
                        @foreach ($data_laporan as $laporan)
                            <tr>
                                <td>
                                    <div class="timeline py-2" style="margin:-30px -20px 0 -20px">
                                        <div>
                                            <div class="timeline-item ">

                                                <div class="timeline-header text-wrap">

                                                    <span style="font-weight: bold">
                                                        <a href="#">{{ $laporan->datasekolah->nama . ' : ' }} </a>
                                                        {{ strtoupper($laporan->nama) }}</span>
                                                </div>

                                                <div class="timeline-body text-wrap">
                                                    <p class="mt-2">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <table>
                                                                <tr>
                                                                    <td>Tempat, Tanggal Lahir</td>
                                                                    <td class="text-center">:</td>
                                                                    <td>{{ ucwords(strtolower($laporan->tmp_lhr)) . ', ' . Illuminate\Support\Carbon::parse($laporan->tgl_lhr)->isoFormat('D MMMM Y') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama Orang Tua</td>
                                                                    <td class="text-center">:</td>
                                                                    <td>{{ ucwords(strtolower($laporan->orang_tua)) }} </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nomer Induk Siswa</td>
                                                                    <td class="text-center">:</td>
                                                                    <td>{{ $laporan->nis }} </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nomer Peserta Ujian Sekolah</td>
                                                                    <td class="text-center">:</td>
                                                                    <td>{{ $laporan->no_ujian }} </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <table>
                                                                <tr>
                                                                    <td>No Seri Ijazah</td>
                                                                    <td class="text-center">:</td>
                                                                    <td>{{ $laporan->no_seri_ijazah }} </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Tahun Pelajaran</td>
                                                                    <td class="text-center">:</td>
                                                                    <td>{{ $laporan->tahun_pelajaran }} </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>No Surat Kehilangan dari Kepolisian</td>
                                                                    <td class="text-center">:</td>
                                                                    <td>{{ strtoupper($laporan->no_kepolisian) }} </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Tanggal Surat Kehilangan
                                                                    </td>
                                                                    <td class="text-center">:</td>
                                                                    <td>{{ Illuminate\Support\Carbon::parse($laporan->tahun_kepolisian)->isoFormat('D MMMM Y') }}
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="px-2">
                                                            <a
                                                                href={{ url('download/surat_laporan_polisi/' . $laporan->id) }}>Surat
                                                                Laporan
                                                                Kehilangan dari Kepolisian</a> |
                                                            <a href={{ url('download/raport/' . $laporan->id) }}>Raport
                                                                Asli</a><strong class="px-1">|</strong>
                                                            <a href={{ url('download/ijazah/' . $laporan->id) }}>Foto Copy
                                                                Ijazah</a><strong class="px-1">|</strong>
                                                            <a href={{ url('download/buku_induk/' . $laporan->id) }}>Buku
                                                                Induk
                                                                Asli</a><strong class="px-1">|</strong>
                                                            <a href={{ url('download/akte/' . $laporan->id) }}>Akte
                                                                Kelahiran
                                                                Asli</a><strong class="px-1">|</strong>
                                                            <a
                                                                href={{ url('download/permohonan_kepsek/' . $laporan->id) }}>Surat
                                                                Permohonan Kepala Sekolah Asli</a><strong
                                                                class="px-1">|</strong>
                                                            <a
                                                                href={{ url('download/pernyataan_mutlak/' . $laporan->id) }}>Surat
                                                                Pernyataan Tanggung Jawab Mutlak</a><strong
                                                                class="px-1">|</strong>
                                                            <a href={{ url('download/pernyataan_saksi/' . $laporan->id) }}>Surat
                                                                Pernyataan Dua Orang Saksi</a>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-footer">
                                                    @if ($laporan->status == '0')
                                                        <a href="#"
                                                            class="btn btn-sm bg-warning btn-outline-dark my-1"
                                                            onclick="show_verifikasi('{{ $laporan->id }}')">
                                                            <i class="fas fa-check"></i>
                                                            Verifikasi
                                                        @elseif ($laporan->status == '3')
                                                            <a href="#"
                                                                class="btn btn-sm bg-warning btn-outline-dark my-1"
                                                                onclick="show_verifikasi('{{ $laporan->id }}')">
                                                                <i class="fas fa-check"></i>
                                                                Verifikasi Ulang
                                                    @endif


                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </section>
    <div class="modal fade" id="verifikasimodal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">
                                Verifikasi Data Laporan
                            </h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="page"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

        function show_verifikasi(id) {
            $.ajax({
                type: "GET",
                url: "{{ url('verifikasi') }}/" + id,
                contentType: false,
                processData: false,
                dataType: 'json',

                success: function(data) {
                    var catatan = "";
                    if (data.pencarian_data.note != null) {
                        catatan = data.pencarian_data.note;
                    }
                    $('#page').html(`
                                <form method="POST" action="{{ url('/verifikasi') }}/` + data.pencarian_data.id + `" role="form" id="editform"
                                enctype="multipart/form-data">
                                @method('put')
                                {{ csrf_field() }}
                                    <div class="card-body my-0 py-0">
                                        <div class="form-group mt-2">
                                            <label for="exampleInputPassword1">Profil</label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table>
                                                        <tr>
                                                            <td >Nama</td>
                                                            <td class="text-center">:</td>
                                                            <td>` + data.pencarian_data.nama.toUpperCase() + ` </td>
                                                        </tr>
                                                        <tr>
                                                            <td>NIS</td>
                                                            <td class="text-center">:</td>
                                                            <td>` + data.pencarian_data.nis + ` </td>
                                                        </tr>
                                                        <tr>
                                                            <td>No Ujian Sekolah</td>
                                                            <td class="text-center px-3">:</td>
                                                            <td>` + data.pencarian_data.no_ujian + ` </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="exampleInputPassword1">Status Data</label>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="row">
                                                        <div class="col-8 col-sm-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="status"
                                                                    id="flexRadioDefault1" value="1" checked>
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    Disetujui
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 col-sm-6">
                                                            <div class="form-check float-md-right">
                                                                <input class="form-check-input " type="radio" name="status"
                                                                    id="flexRadioDefault2" value="0">
                                                                <label class="form-check-label float-md-right"
                                                                    for="flexRadioDefault2">
                                                                    Ditolak
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Catatan</label>
                                            <textarea rows="2" class=" form-control" name="catatan" id="catatan">` +
                        catatan + ` </textarea>
                                        </div>
                                    </div>
                                    <div class="card-footer mt-0 pt-0">
                                        <button type="submit" class="btn btn-sm bg-gradient-success float-md-right button-verifikasi" name="verifikasi" value="verifikasi">
                                            Verifikasi Data
                                        </button>
                                        <button class="btn btn-sm bg-gradient-success float-md-right loading-simpan">
                                            <div class="spinner"><i role="status" class="spinner-border spinner-border-sm"></i>
                                                Verifikasi Data
                                            </div>
                                        </button>
                                    </div>
                                </form>
                            `);
                    $('#verifikasimodal').modal('show');
                },
                error: function(data) {


                }
            });


        }
        $(document).ready(function() {
            $('#submit').click(function() {
                $('.button-simpan').hide();
                $('.loading-simpan').show();
                $('.loading-simpan').attr('disabled', 'true');
                $('.spinner').show();
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
                    url: "{{ url('laporan') }}",
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',

                    success: function(data) {
                        window.location = data.url;
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

                        // $('#undanganError').addClass('d-none');

                        $('.button-simpan').show();
                        $('.loading-simpan').hide();
                        $('.loading-simpan').attr('disabled', 'true');
                        $('.spinner').hide();
                        var errors = data.responseJSON;
                        if ($.isEmptyObject(errors) == false) {
                            $.each(errors.errors, function(key, value) {
                                var ErrorID = '#' + key + 'Error';
                                var InputID = '#' + key;
                                // alert(ErrorID);
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
