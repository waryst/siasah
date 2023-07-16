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
@endpush
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="card card-info card-outline">
                <div class="card-header p-2">
                    Data Profil Sekolah
                </div>
                <div class="card-body">
                    <div class="card px-2 col-md-8 p-4">

                        <form action="/profil/{{ Auth()->user()->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group ">
                                <label for="nama">Nama Sekolah: </label>
                                <div id="nama">
                                    {{ old('nama', $profil->datasekolah->nama ?? '') }}
                                </div>
                            </div>
                            <div class="form-group col-8">
                                <label for="alamat">Alamat Sekolah</label>
                                <input type="text" autocomplete="off"
                                    class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                    value=" {{ old('alamat', $profil->datasekolah->profilsekolah->alamat ?? '') }}">
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="pl-3 col-5">
                                    <div class="form-group ">
                                        <label for="kepsek">Kepala Sekolah</label>
                                        <input type="text" autocomplete="off"
                                            class="form-control @error('kepsek') is-invalid @enderror" id="kepsek"
                                            name="kepsek"
                                            value="{{ old('kepsek', $profil->datasekolah->profilsekolah->kepsek ?? '') }}">
                                        @error('kepsek')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group ">
                                        <label for="nip">NIP</label>
                                        <input type="text" autocomplete="off"
                                            class="form-control @error('nip') is-invalid @enderror" id="nip"
                                            name="nip"
                                            value="{{ old('nip', $profil->datasekolah->profilsekolah->nip ?? '') }}">
                                        @error('nip')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="no_depan">Nomor Surat Depan</label>
                                    <input type="text"
                                        class="form-control @error('no_depan')
                                        is-invalid
                                    @enderror"
                                        name="no_depan" id="no_depan"
                                        value="{{ old('no_depan', $profil->datasekolah->profilsekolah->no_depan ?? '') }}">
                                    @error('no_depan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2 text-center d-flex align-items-end">
                                    <label for=""></label>
                                    <div class="mt-9">No urut surat </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="no_belakang">Nomor Surat Belakang</label>
                                    <input type="text"
                                        class="form-control @error('no_belakang')
                                        is-invalid
                                    @enderror"
                                        name="no_belakang" id="no_belakang"
                                        value="{{ old('no_belakang', $profil->datasekolah->profilsekolah->no_belakang ?? '') }}">
                                    @error('no_belakang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" id="submit" value="Submit"
                                class="btn btn-sm bg-gradient-primary float-md-right button-simpan">Update</button>
                            <button class="btn btn-sm bg-gradient-dark float-md-right loading-simpan">
                                <div class="spinner">
                                    <i role="status" class="spinner-border spinner-border-sm">
                                    </i>
                                    Update
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('java')
    <script>
        $(document).ready(function() {
            $('#submit').click(function() {
                $('.button-simpan').hide();
                $('.loading-simpan').show();
                $('.loading-simpan').attr('disabled', 'true');
                $('.spinner').show();
            });
        });
    </script>
@endpush
