@extends('layouts.app')
@section('content')
<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pay Slip</a></li>
                            <li class="breadcrumb-item active">Gaji Karyawan</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Gaji Karyawan</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('salary.search') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-example-wrap mg-t-30">
                                <div class="cmp-tb-hd cmp-int-hd">
                                    <h5>Cari Data Gaji</h5>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                <label class="hrzn-fm">Pilih Periode</label>
                                            </div>
                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                <div class="nk-int-st">
                                                    <input type="month" name="month" value="{{ $periode }}" class="form-control input-sm" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-example-int mg-t-15">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                            <button class="btn btn-success notika-btn-success">Cari</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4> Data <span class="table-project-n"> Komponen Gaji Periode ( {{ $periode }} )</span>
                            @if(Auth::user()->level == "Administrator")
                            <form action="{{ route('salary.delete_all') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="periode" value="{{ $periode }}">
                                <button class="btn btn-danger waves-effect waves-light float-right" onclick="return confirm('Anda Yakin Menghapus Data Komponen Gaji Periode ({{ $periode }}) ?')" style="margin-top: -6px;"><i class="mdi mdi-close-circle mr-2"></i><b> Hapus Semua Data </b></button>
                            </form>
                            @endif
                        </h4></br>
                        <table id="#list-gaji" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Nik</th>
                                    <th>Periode</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunj Uang Makan</th>
                                    <th>Tunj Pegawai</th>
                                    <th>Tunj Masa Kerja</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#list-gaji').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            responsive: true,
            ajax: {
                url: "/kegiatan-mingguan",
                data: function(d) {
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'jenis_kegiatan',
                    name: 'jenis_kegiatan'
                },
                {
                    data: 'kategori_kegiatan',
                    name: 'kategori_kegiatan'
                },
                {
                    data: 'persen',
                    name: 'persen',
                    render: function(data, type, row) {
                        badge = '';
                        if (data == null) {
                            badge = '<span class="badge bg-primary">' + '0%' + '</span>';
                        } else if (data != null) {
                            badge = '<span class="badge bg-primary">' + data + '%' + '</span>';
                        }

                        return badge;
                    }
                },
                {
                    data: 'deadline',
                    name: 'deadline'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false
                },
            ],
            order: [
                [1, 'desc']
            ]
        });
    });
</script>

@if(Auth::user()->level == "Administrator")
@include('salary.form')
@endif
@endsection