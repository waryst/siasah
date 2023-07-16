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

        <div class="card card-info ">
            <div class="card-header">
                <h3 class="card-title">Data Laporan</h3>
            </div>
            <x-data-laporan />
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
