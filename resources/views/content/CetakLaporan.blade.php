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
                <h3 class="card-title">Cetak Surat Keterangan Pengganti Ijazah</h3>
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
            bsCustomFileInput.init();
        });
    </script>
@endpush
