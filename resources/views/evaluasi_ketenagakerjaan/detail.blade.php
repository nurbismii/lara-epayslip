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
                            <li class="breadcrumb-item active">Kinerja Karyawan dan Pencapaian Kerja</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Kinerja Karyawan dan Pencapaian Kerja</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <h5>HASIL KINERJA DAN PENCAPAIAN KERJA</h5>
                        </center>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <td>NAMA</td>
                                        <td>{{ $data->data_karyawan->nama }}</td>
                                        <td>Departemen</td>
                                        <td>@if($div != null) {{ $div->departemen }} @endif</td>
                                        <td rowspan="2">Email</td>
                                        <td rowspan="2">{{ $data->user->email ?? 'Belum terdaftar sebagai pengguna' }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIK</td>
                                        <td>{{ $data->data_karyawan->nik }}</td>
                                        <td>DIVISI</td>
                                        <td>@if($div != null) {{ $div->divisi }} @endif</td>

                                    </tr>
                                    <tr>
                                        <td>TANGGAL MASUK KERJA</td>
                                        <td>{{ $data->data_karyawan->tgl_join }}</td>
                                        <td colspan="2">POSISI</td>
                                        <td colspan="2">@if($div != null) {{ $div->posisi }} @endif</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end .table-responsive-->
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h5> III. EVALUASI KETENAGAKERJAAN (C)</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <td rowspan="2" align="center">ASPEK EVALUASI</td>
                                                <td rowspan="2" align="center">UNSUR EVALUASI</td>
                                                <td colspan="2" align="center">NILAI PER UNSUR EVALUASI</td>
                                                <td rowspan="2" align="center">NILAI PER-KATEGORI</td>
                                                <td rowspan="2" align="center">TOTAL NILAI</td>
                                            </tr>
                                            <tr>
                                                <td align="center">Jumlah Unsur Evaluasi (HARI)</td>
                                                <td align="center">Poin Nilai</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="9" align="center"><b>Evaluasi Kehadiran</b></td>
                                                <td>Total Kehadiran</td>
                                                <td>{{ $data->jml_kehadiran }}</td>
                                                <td>{{ $data->poin_nilai_kehadiran }}</td>
                                                <td>{{ $data->kategori_kehadiran }}</td>
                                                <td>{{ $data->nilai_kehadiran }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Alfa</td>
                                                <td>{{ $data->jml_alfa }}</td>
                                                <td>{{ $data->poin_nilai_alfa }}</td>
                                                <td>{{ $data->kategori_alfa }}</td>
                                                <td>{{ $data->nilai_alfa }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Sakit</td>
                                                <td>{{ $data->jml_sakit }}</td>
                                                <td>{{ $data->poin_nilai_sakit }}</td>
                                                <td>{{ $data->kategori_sakit }}</td>
                                                <td>{{ $data->nilai_sakit }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Izin Paidleave</td>
                                                <td>{{ $data->jml_paidleave }}</td>
                                                <td>{{ $data->poin_nilai_paidleave }}</td>
                                                <td>{{ $data->kategori_paidleave }}</td>
                                                <td>{{ $data->nilai_paidleave }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Izin Unpaidleave</td>
                                                <td>{{ $data->jml_unpaidleave }}</td>
                                                <td>{{ $data->poin_nilai_unpaidleave }}</td>
                                                <td>{{ $data->kategori_unpaidleave }}</td>
                                                <td>{{ $data->nilai_unpaidleave }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Keterlambatan</td>
                                                <td>{{ $data->jml_keterlambatan }}</td>
                                                <td>{{ $data->poin_nilai_keterlambatan }}</td>
                                                <td>{{ $data->kategori_keterlambatan }}</td>
                                                <td>{{ $data->nilai_keterlambatan }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Pulang Cepat</td>
                                                <td>{{ $data->jml_pulang_cepat }}</td>
                                                <td>{{ $data->poin_nilai_pulang_cepat }}</td>
                                                <td>{{ $data->kategori_pulang_cepat }}</td>
                                                <td>{{ $data->nilai_pulang_cepat }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Cuti</td>
                                                <td>{{ $data->jml_cuti }}</td>
                                                <td>{{ $data->poin_nilai_cuti }}</td>
                                                <td>{{ $data->kategori_cuti }}</td>
                                                <td>{{ $data->nilai_cuti }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total OFF</td>
                                                <td>{{ $data->jml_off }}</td>
                                                <td>{{ $data->poin_nilai_off }}</td>
                                                <td>{{ $data->kategori_off }}</td>
                                                <td>{{ $data->nilai_off }}</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="6" align="center"><b>Evaluasi Pelanggaran</b></td>
                                                <td>Total SP 1</td>
                                                <td>{{ $data->jml_sp1 }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $data->nilai_sp1 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total SP 2</td>
                                                <td>{{ $data->jml_sp2 }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $data->nilai_sp2 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total SP 3</td>
                                                <td>{{ $data->jml_sp3 }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $data->nilai_sp3 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Surat Pernyataan</td>
                                                <td>{{ $data->jml_surat_pernyataan}}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{$data->nilai_surat_pernyataan}}</td>
                                            </tr>
                                            <tr>
                                                <td>Denda</td>
                                                <td>{{ $data->jml_denda }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $data->nilai_denda }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pelanggaran Lainnya</td>
                                                <td colspan="2">@if(!empty($data->pelanggaran_dikembalikan_kehrd)) - Pelanggaran Dikembalikan ke HRD </br> @endif @if(!empty($data->pelanggaran_tidak_memiliki_npwp)) - Pelanggaran Tidak Memiliki NPWP @endif </td>
                                                <td></td>
                                                <td>{{ $data->pelanggaran_lainnya }}</td>

                                            </tr>
                                            <tr>
                                                <td colspan="5"><b>TOTAL PEROLEHAN EVALUASI KETENAGAKERJAAN (C)</b></td>
                                                <td>{{ $data->total_nilai }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end .table-responsive-->
                            </div>
                            <br>
                            <div class="col-8">
                                <h5> TABEL ACUAN </h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>

                                                <td rowspan="2" align="center">UNSUR EVALUASI</td>
                                                <td colspan="4" align="center">POIN PER KATEGORI</td>

                                            </tr>
                                            <tr>
                                                <td align="center">Kurang (5)</td>
                                                <td align="center">Cukup (15)</td>
                                                <td align="center">Baik (30)</td>
                                                <td align="center">Kurang (50)</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Total Kehadiran</td>
                                                <td>1-259</td>
                                                <td>>= 260</td>
                                                <td>>= 304</td>
                                                <td>>= 335</td>
                                            </tr>
                                            <tr>
                                                <td>Total Alfa</td>
                                                <td>>= 6</td>
                                                <td>
                                                    <= 5</td>
                                                <td>
                                                    <= 2</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Total Sakit</td>
                                                <td>>= 10</td>
                                                <td>
                                                    <= 9</td>
                                                <td>
                                                    <= 5</td>
                                                <td>
                                                    <= 3</td>
                                            </tr>
                                            <tr>
                                                <td>Total Izin Paidleave</td>
                                                <td>>= 10</td>
                                                <td>
                                                    <= 9</td>
                                                <td>
                                                    <= 5</td>
                                                <td>
                                                    <= 3</td>
                                            </tr>
                                            <tr>
                                                <td>Total Izin Unpaidleave</td>
                                                <td>>= 6</td>
                                                <td>
                                                    <= 5</td>
                                                <td>
                                                    <= 3</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Total Keterlambatan</td>
                                                <td>>= 8</td>
                                                <td>
                                                    <= 7</td>
                                                <td>
                                                    <= 3</td>
                                                <td>
                                                    <= 0</td>
                                            </tr>
                                            <tr>
                                                <td>Total Pulang Cepat</td>
                                                <td>>= 8</td>
                                                <td>
                                                    <= 7</td>
                                                <td>
                                                    <= 3</td>
                                                <td>
                                                    <= 0</td>
                                            </tr>
                                            <tr>
                                                <td>Total Cuti</td>
                                                <td colspan="2">Sesuai Hak(40)</td>
                                                <td colspan="2">Melebihi Hak(20)</td>

                                            </tr>
                                            <tr>
                                                <td>Total OFF</td>
                                                <td colspan="2">Sesuai Hak(40)</td>
                                                <td colspan="2">Melebihi Hak(20)</td>

                                            </tr>
                                            <tr>
                                                <td>Total SP1</td>
                                                <td>
                                                    <= 2</td>
                                                <td> 1</td>
                                                <td colspan="2"></td>

                                            </tr>
                                            <tr>
                                                <td>Total SP2</td>
                                                <td>>= 1</td>

                                                <td colspan="3"></td>

                                            </tr>

                                            <tr>
                                                <td>Total SP3</td>
                                                <td>>= 1</td>

                                                <td colspan="3"></td>

                                            </tr>
                                            <tr>
                                                <td>Surat Pernyataan</td>
                                                <td colspan="2"></td>

                                                <td colspan="2"></td>

                                            </tr>
                                            <tr>
                                                <td>Denda</td>
                                                <td colspan="2"></td>

                                                <td colspan="2"></td>

                                            </tr>


                                        </tbody>
                                    </table>
                                </div> <!-- end .table-responsive-->
                            </div>
                        </div>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div>
@if(Auth::user()->level == "Administrator")
@include('salary.form')
@endif
@endsection