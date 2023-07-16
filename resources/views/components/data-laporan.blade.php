<div>

    <div class="card-body ">
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
                                                {{ strtoupper($laporan->nama) }}</span>


                                            @if ($laporan->status == 0)
                                                <span class="badge bg-warning">
                                                    Menunggu Verifikasi</span>
                                            @elseif ($laporan->status == 2)
                                                <a href="#" onclick="show_note('{{ $laporan->id }}')"
                                                    class="badge bg-danger btn-sm note my-1 p-1">
                                                    Catatan
                                                </a>
                                            @elseif ($laporan->status == 1)
                                                <span class="badge bg-primary">Terverifikasi</span>
                                            @elseif($laporan->status == 3)
                                                <span class="badge bg-info">
                                                    Menunggu Verifikasi Ulang</span>
                                            @endif

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
                                                            <td>Nomer Ujian Sekolah</td>
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
                                                    <a href={{ url('download/surat_laporan_polisi/' . $laporan->id) }}>Surat
                                                        Laporan
                                                        Kehilangan dari Kepolisian</a> |
                                                    <a href={{ url('download/raport/' . $laporan->id) }}>Raport
                                                        Asli</a><strong class="px-1">|</strong>
                                                    <a href={{ url('download/ijazah/' . $laporan->id) }}>Foto Copy
                                                        Ijazah</a><strong class="px-1">|</strong>
                                                    <a href={{ url('download/buku_induk/' . $laporan->id) }}>Buku Induk
                                                        Asli</a><strong class="px-1">|</strong>
                                                    <a href={{ url('download/akte/' . $laporan->id) }}>Akte Kelahiran
                                                        Asli</a><strong class="px-1">|</strong>
                                                    <a href={{ url('download/permohonan_kepsek/' . $laporan->id) }}>Surat
                                                        Permohonan Kepala Sekolah Asli</a><strong
                                                        class="px-1">|</strong>
                                                    <a href={{ url('download/pernyataan_mutlak/' . $laporan->id) }}>Surat
                                                        Pernyataan Tanggung Jawab Mutlak</a><strong
                                                        class="px-1">|</strong>
                                                    <a href={{ url('download/pernyataan_saksi/' . $laporan->id) }}>Surat
                                                        Pernyataan Dua Orang Saksi</a>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($laporan->status != 1)
                                            <div class="timeline-footer">

                                                <a href="{{ url('laporan/' . $laporan->id) . '/edit' }}"
                                                    class="btn bg-warning btn-sm my-1">
                                                    <i class="far fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ url('laporan/' . $laporan->id) }}" method="POST"
                                                    id='delete{{ $laporan->id }}' class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn bg-danger btn-sm tombol-hapus"
                                                        id='{{ $laporan->id }}'data-id='{{ $laporan->id }}'><i
                                                            class="far fa-trash-alt"></i> Hapus
                                                    </button>
                                                    <button class="btn bg-danger btn-sm loading-hapus"
                                                        id='loading-hapus{{ $laporan->id }}'data-id=''>
                                                        <div class="spinner"><i role="status"
                                                                class="spinner-border spinner-border-sm"></i>
                                                            Hapus
                                                        </div>
                                                    </button>
                                            </div>
                                        @else
                                            @if ($laporan->nosurat != null)
                                                <div class="timeline-footer">
                                                    <a href={{ url('download/surat/' . $laporan->id) }}
                                                        class="btn bg-info btn-sm my-1">
                                                        <i class="fas fa-print"></i> Cetak Surat
                                                    </a>
                                                     <a href="#" onclick="show_nomer('{{ $laporan->id }}')"
                                                        class="btn bg-warning btn-sm my-1">
                                                        <i class="far fa-edit"></i> Generate Surat
                                                    </a>
                                                </div>
                                            @else
                                                <div class="timeline-footer">
                                                    <a href="#" onclick="show_nomer('{{ $laporan->id }}')"
                                                        class="btn bg-info btn-sm my-1">
                                                        <i class="fas fa-print"></i> Cetak Surat
                                                    </a>
                                                </div>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    <div class="modal fade" id="inputnomer" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="position-relative p-3 bg-white">
                    <div class="ribbon-wrapper ribbon-xl">
                        <div class="ribbon bg-warning text-md">
                            Input Nomer Surat
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-md-6 ">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h3 class="card-title text-center">Data Pemohon</h3>
                                </div>
                                <div class="card-body p-3">

                                    <table>
                                        <tr>
                                            <td>Nama</td>
                                            <td class="text-center" style="width: 30px">:</td>
                                            <td>
                                                <div id="nama"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Tanggal Lahir</td>
                                            <td class="text-center">:</td>
                                            <td>
                                                <div id="ttl"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nomer Induk Siswa</td>
                                            <td class="text-center">:</td>
                                            <td>
                                                <div id="nis"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nomer Ujian Sekolah</td>
                                            <td class="text-center">:</td>
                                            <td>
                                                <div id="ujiansekolah"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tahun Pelajaran</td>
                                            <td class="text-center">:</td>
                                            <td>
                                                <div id="tahunpelajaran"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="card card-info card-outline ">
                                <div class="card-header">
                                    <h3 class="card-title text-center">Data Penanda Tangan</h3>
                                </div>
                                <div class="card-body p-3">
                                    <table>
                                        <tr>
                                            <td>Sekolah</td>
                                            <td class="text-center" style="width: 30px">:</td>
                                            <td>
                                                <div id="sekolah"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kepala Sekolah</td>
                                            <td class="text-center" style="width: 30px">:</td>
                                            <td>
                                                <div id="kepsek"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nip</td>
                                            <td class="text-center">:</td>
                                            <td>
                                                <div id="nip"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nomer Surat </td>
                                            <td class="text-center">:</td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td id="nosuratdepan">1</td>
                                                        <td style="width: 50px;"><input type="text" class="form-control px-0 mx-0 text-center " name="nomer_surat" id="nomer_surat" style="height: 20px;font-size: 14px;"></td>
                                                        <td id="nosuratbelakang" ></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Surat</td>
                                            <td class="text-center">:</td>
                                            <td>
                                                <div class="input-group date col-7" id="reservationdate2"
                                                    data-target-input="nearest">
                                                    <input type="text" autocomplete="off"
                                                        class="form-control datetimepicker-input" name="tgl_surat"
                                                        id="tgl_surat" data-target="#reservationdate2"
                                                        data-toggle="datetimepicker"
                                                        style="width: 50px;height: 20px;font-size: 14px;">
                                                    <div class="input-group-append" data-target="#reservationdate2"
                                                        data-toggle="datetimepicker">

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="button" id="submitnomer" value="submitnomer"
                            class="btn btn-sm bg-gradient-primary float-md-right button-nomer">Simpan</button>
                        <button class="btn btn-sm bg-gradient-primary float-md-right d-none" id="tombol">
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
    <div class="modal fade" id="notemodal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="position-relative p-3 bg-white" style="height: 180px">
                <div class="ribbon-wrapper ribbon-xl">
                    <div class="ribbon bg-warning text-lg">
                        Catatan
                    </div>
                </div>
                <div id="note"></div>
            </div>
        </div>
    </div>
        </div>

</div>
        @push('java')
            <script type="text/javascript">
                function show_nomer(id) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('inputnomer') }}/" + id,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(data) {
                            var tmp_lhr = data.pencarian_data.tmp_lhr;
                            tmp_lhr = tmp_lhr.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                                return letter.toUpperCase();
                            });
                            $('#nama').html((data.pencarian_data.nama).toUpperCase());

                            $('#ttl').html(tmp_lhr + ` ,` + data.tgl_lhr );
                            $('#nis').html(data.pencarian_data.nis);
                            $('#submitnomer').attr('data-id', data.pencarian_data.id);
                            $('#ujiansekolah').html(data.pencarian_data.no_ujian);
                            $('#sekolah').html(data.pencarian_data.datasekolah.nama);
                            $('#kepsek').html(data.pencarian_kepsek.kepsek);
                            $('#nip').html(data.pencarian_kepsek.nip);
                            $('#nosuratdepan').html(data.pencarian_kepsek.no_depan);
                            $('#nomer_surat').val(data.nomer_surat);
                            $('#tgl_surat').val(data.tgl_surat);

                            $('#nosuratbelakang').html(data.pencarian_kepsek.no_belakang);
                            $('#tahunpelajaran').html(data.pencarian_data.tahun_pelajaran);
                            $("#inputnomer").modal('show');
                        },
                        error: function(data) {}
                    });

                }

                function show_note(id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('catatan') }}/" + id,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(data) {
                            $('#note').html(`                   
                        <div class="form-group">
                            <label for="title">Catatan Laporan Ditolak :</label>
                            <div class="ml-4" name="title" id="title">` + data.pencarian_data.note + `</div>
                            </div>

                        </div>                    
                    `);
                            $("#notemodal").modal('show');
                        },
                        error: function(data) {}
                    });

                }
                $(document).ready(function() {
                    $('#submitnomer').click(function() {
                        $('.button-nomer').hide();
                        $('#tombol').removeClass('d-none');
                        $('.loading-nomer').show();
                        $('.loading-nomer').attr('disabled', 'true');
                        $('.spinner').show();
                        id = $(this).data('id');
                        var nomer_surat = $('#nomer_surat').val();
                        var tgl_surat = $('#tgl_surat').val();
                        inputnomer
                        var fd = new FormData();
                        fd.append('nomer_surat', nomer_surat);
                        fd.append('tgl_surat', tgl_surat);


                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ url('updatenomer') }}/" + id,
                            data: fd,
                            contentType: false,
                            processData: false,
                            dataType: 'json',

                            success: function(data) {
                                window.open(data.download, '_blank')
                                window.location = data.url;
                            },
                            error: function(data) {
                                $('.button-nomer').show();
                                $('#tombol').addClass('d-none');
                                $('.loading-nomer').hide();
                                $('.loading-nomer').attr('disabled', 'false');
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
            </script>
        @endpush
