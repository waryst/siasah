@extends('layout.index')

@section('title', 'Sekolah')
@push('css')
    <style>
        /* untuk menghilangkan spinner  */
        .spinner,
        .loading-simpan {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="card card-info card-outline">
                <div class="card-header p-2">
                    Daftar Sekolah Tk / SD / SMP
                </div>
                <div class="card-body">
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary my-3" data-toggle="modal"
                            data-target="#modal_add_new"><i class="fas fa-plus"></i> Tambah Data</button>
                    </div>
                    <table id="datatable" name="datatable" class="table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Sekolah</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_sekolah as $data_sekolah)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ strtoupper($data_sekolah->nama) }}</td>
                                    <td class="text-center">
                                        <a href="#" onclick="edit('{{ $data_sekolah->id }}')"><span
                                                class="btn btn-sm btn-info"><i class="fas fa-info-circle"></i>
                                                Edit</span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal_add_new" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Input Data Sekolah</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama Sekolah</label>
                                <input type="text" class="form-control" name="nama" id="nama">
                                <span class="text-danger" id="namaError"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Operator</label>
                                <input type="text" class="form-control" name="name" id="name">
                                <span class="text-danger" id="nameError"></span>
                            </div>
                            <div class="form-group">
                                <label for="email">User / Email Operator</label>
                                <input type="text" class="form-control" name="email" id="email">
                                <span class="text-danger" id="emailError"></span>
                                <div>Password Default : siasah</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" id="submit" value="Submit"
                                class="btn btn-sm bg-gradient-primary button-simpan">Simpan</button>
                            <button class="btn btn-sm bg-gradient-primary loading-simpan">
                                <div class="spinner">
                                    <i role="status" class="spinner-border spinner-border-sm">
                                    </i>
                                    Simpan
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_edit" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Update Data Sekolah</h3>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="editnama">Nama Sekolah</label>
                                <input type="text" class="form-control" required name="editnama" id="editnama">
                                <span class="text-danger" id="editnamaError"></span>
                            </div>
                            <div class="form-group">
                                <label for="editname">Nama Operator</label>
                                <input type="text" class="form-control" required name="editname" id="editname">
                                <span class="text-danger" id="editnameError"></span>
                            </div>
                            <div class="form-group">
                                <label for="editemail">User / editEmail Operator</label>
                                <input type="text" class="form-control" name="editemail" id="editemail">
                                <span class="text-danger" id="editemailError"></span>
                            </div>
                            <div class="form-group">
                                <label for="hak">Reset Password</label>
                                <div id="hak_admin"></div>
                            </div>
                            <div class=" float-right">
                                <div id="update"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('java')
    <script src="{{ asset('asset') }}/dist/js/demo.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

    <script>
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
                var name = $('#name').val();
                var email = $('#email').val();
                var fd = new FormData();
                fd.append('nama', nama);
                fd.append('name', name);
                fd.append('email', email);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('sekolah') }}",
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',

                    success: function(data) {
                        window.location = data.url;
                    },
                    error: function(data) {
                        $('#nama').removeClass('is-invalid');
                        $('#name').removeClass('is-invalid');
                        $('#email').removeClass('is-invalid');
                        $('#namaError').addClass('d-none');
                        $('#nameError').addClass('d-none');
                        $('#emailError').addClass('d-none');
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
            $("#modal_edit").on("click", '.update', function() {
                var editnama = $('#editnama').val();
                var editname = $('#editname').val();
                var editemail = $('#editemail').val();
                var hak = $('#hak:checked').val();
                var id = $(this).data('id');
                var fd = new FormData();
                fd.append('editnama', editnama);
                fd.append('editname', editname);
                fd.append('editemail', editemail);
                fd.append('hak', hak);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('updatesekolah') }}/" + id,
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',

                    success: function(data) {
                        window.location = data.url;
                    },
                    error: function(data) {
                        $('#editnama').removeClass('is-invalid');
                        $('#editname').removeClass('is-invalid');
                        $('#editemail').removeClass('is-invalid');
                        $('#editnamaError').addClass('d-none');
                        $('#editnameError').addClass('d-none');
                        $('#editemailError').addClass('d-none');
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
            })
        });

        function edit(id) {
            $.ajax({
                type: "GET",
                url: "{{ url('sekolah') }}/" + id,
                contentType: false,
                processData: false,
                dataType: 'json',

                success: function(data) {
                    $('#editnama').val(data.data_sekolah.nama);
                    $('#editname').val(data.data_operator.name);
                    $('#editemail').val(data.data_operator.email);

                    $('#hak_admin').html(`
                    <input type="checkbox" id='hak' name="hak"  data-bootstrap-switch  data-on-color="success">          
                    `);
                    $('#update').html(`
                    <button  data-id="` + id + `" class="btn btn-success update">Update</button>          
                    `);
                    $("input[data-bootstrap-switch]").each(function() {
                        $(this).bootstrapSwitch('state', $(this).prop('checked'));
                    });
                    $('#modal_edit').modal('show');
                },
                error: function(data) {


                }
            });


        }
    </script>
@endpush
