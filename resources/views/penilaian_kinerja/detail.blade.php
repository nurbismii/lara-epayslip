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
                                        <td rowspan="2">{{ $data->data_karyawan->email ?? 'Belum terdaftar sebagai pengguna' }}</td>
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
                        <h5> I. EVALUASI PENCAPAIAN KINERJA (A)</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <td colspan="2">ASPEK PENILAIAN</td>
                                        <td rowspan="2">PENCAPAIAN KINERJA</td>
                                        <td rowspan="2">KOLOM CENTANG</td>
                                        <td rowspan="2">KOLOM NILAI(DIISI OLEH HRD)</td>
                                    </tr>
                                    <tr>
                                        <td>JENIS KINERJA</td>
                                        <td>RINCIAN KINERJA</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="15">I. SIKAP KERJA</td>
                                        <td rowspan="5">1. RASA TANGGUNG JAWAB</td>
                                        <td>Mampu meminimalkan kesalahan juga memiliki rasa tanggung jawab yang tinggi.</td>
                                        <td> @if($data->rasa_tanggung_jawab == 43.5) &#10004; @endif </td>
                                        <td rowspan="5"> {{ $data->rasa_tanggung_jawab }} </td>
                                    </tr>
                                    <tr>
                                        <td>Menunggu arahan dalam melakukan pekerjaan dan selalu mengutamakan pekerjaan.</td>
                                        <td>@if($data->rasa_tanggung_jawab == 28.5) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Melakukan pekerjaan setelah menyelesaikan kepentingan pribadi serta bertanggung jawab akan pekerjaan.</td>
                                        <td>@if($data->rasa_tanggung_jawab == 33) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td>Selalu menyelesaikan pekerjaan yang diberikan walaupun masih terdapat kesalahan atau menunggu perintah dalam bekerja.</td>
                                        <td> @if($data->rasa_tanggung_jawab == 36) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td>Menyelesaikan pekerjaan tanpa menunggu arahan dan teliti dalam bekerja. </td>
                                        <td> @if($data->rasa_tanggung_jawab == 49) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5">2. Kedisiplinan</td>
                                        <td>Memahami seluruh peraturan perusahaan meski tidak acuh terhadap peraturan tersebut. </td>
                                        <td>@if($data->kedisiplinan == 15) &#10004; @endif</td>
                                        <td rowspan="5"> {{ $data->kedisiplinan }} </td>
                                    </tr>
                                    <tr>
                                        <td>Cukup mampu mengikuti peraturan perusahaan. </td>
                                        <td>@if($data->kedisiplinan == 19.5) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td>Enggan melakukan segala bentuk pelaggaran terhadap peraturan perusahaan.</td>
                                        <td>@if($data->kedisiplinan == 22.5) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Mematuhi peraturan perusahaan yang berlaku. </td>
                                        <td>@if($data->kedisiplinan == 21) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Kadang melakukan pelanggaran.</td>
                                        <td>@if($data->kedisiplinan == 18) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5">3. Etika Kerja dan Dedikasi Kerja</td>
                                        <td>Mengerjakan pekerjaan yang diperintahkan walau hasil kerja kurang baik dan kurang rasa ketertarikan yang terhadap pekerjaan baru.</td>
                                        <td>@if($data->etika_kerja == 27) &#10004; @endif </td>
                                        <td rowspan="5"> {{ $data->etika_kerja }} </td>
                                    </tr>
                                    <tr>
                                        <td>Mampu berkomunikasi dengan baik guna untuk menyelesaikan pekerjaan agar cepat selesai. </td>
                                        <td>@if($data->etika_kerja == 49) &#10004; @endif </td>

                                    </tr>
                                    <tr>
                                        <td>Mengetahui jobdesk yang berlaku serta bertanggung jawab dengan pekerjaan yang diberikan.</td>
                                        <td>@if($data->etika_kerja == 33) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td>Mengerjakan pekerjaan dengan terburu-buru namun mempu memahami intsruksi yang diberikan. </td>
                                        <td>@if($data->etika_kerja == 19) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Memiliki target dalam bekerja serta menyelesaikan pekerjaan dengan maksimal. </td>
                                        <td>@if($data->etika_kerja == 60) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="15">II. Kemampuan Dalam Bekerja</td>
                                        <td rowspan="5">1. Pengetahuan Profesi</td>
                                        </td>
                                        <td>Dapat diandalkan dalam mengerjakan pekerjaan namun tidak tertarik dengan pekerjaan baru. </td>
                                        <td>@if($data->pengetahuan_profesi == 19) &#10004; @endif </td>
                                        <td rowspan="5"> {{ $data->pengetahuan_profesi }} </td>
                                    </tr>
                                    <tr>
                                        <td>Cukup paham akan alur kerja dan kadang masih membutuhkan bantuan rekan kerja untuk menyelesaikan pekerjaan.</td>
                                        <td>@if($data->pengetahuan_profesi == 25) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Memahami alur dan proses pekerjaan dan mampu meminimalkan permasalahan.</td>
                                        <td>@if($data->pengetahuan_profesi == 35) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Kurang pemahaman akan alur kerja dan membutuhkan bantuan rekan kerja untuk menyelesaikan pekerjaan. </td>
                                        <td>@if($data->pengetahuan_profesi == 24) &#10004; @endif
                                    </tr>
                                    <tr>
                                        <td>Mempunyai ide dalam mengerjakan pekerjaan serta paham akan alur dan proses pekerjaan. </td>
                                        <td>@if($data->pengetahuan_profesi == 42) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5">2. Kemampuan Pengambilan Keputusan
                                        </td>
                                        <td>Mengambil keputusan berdasarkan emosi yang terkadang kurang objektif.
                                        </td>
                                        <td>@if($data->pengambilan_keputusan == 14) &#10004; @endif </td>
                                        <td rowspan="5"> {{ $data->pengambilan_keputusan }} </td>
                                    </tr>
                                    <tr>
                                        <td>Berkoordinasi dengan pihak terkait dalam proses pengambilan keputusan. </td>
                                        <td>@if($data->pengambilan_keputusan == 21) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td>Mengambil keputusan dengan spontan ketika terjadi masalah tanpa menganalisa risiko terlebih dahulu.
                                        </td>
                                        <td>@if($data->pengambilan_keputusan == 13) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td>Memahami serta menganalisa situasi dan kondisi ketika terjadi masalah.
                                        </td>
                                        <td>@if($data->pengambilan_keputusan == 15) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td>Hanya menunggu keputusan dari atasan ketika terjadi masalah.
                                        </td>
                                        <td>@if($data->pengambilan_keputusan == 6) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5">3. Kemampuan Pemahaman Dalam Bekerja
                                        </td>
                                        <td>Kurang memahami arahan sehingga membutuhkan bantuan dalam menyelesaikan pekerjaan. </td>
                                        <td>@if($data->pemahaman_dalam_bekerja == 30) &#10004; @endif</td>
                                        <td rowspan="5"> {{ $data->pemahaman_dalam_bekerja }} </td>
                                    </tr>
                                    <tr>
                                        <td>Tidak mau mengerjakan pekerjaan diluar dari job desc dan jam kerja.
                                        </td>
                                        <td>@if($data->pemahaman_dalam_bekerja == 36) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Mengerti arahan serta prosedur juga memberikan ilmu kepada rekan kerja.
                                        </td>
                                        <td>@if($data->pemahaman_dalam_bekerja == 45) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Hanya mengerjakan pekerjaan rutin yang dilakukan setiap hari.
                                        </td>
                                        <td>@if($data->pemahaman_dalam_bekerja == 39) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Dapat mengerti arahan serta prosedur yang berlaku dalam menyelesaikan pekerjaan.
                                        </td>
                                        <td>@if($data->pemahaman_dalam_bekerja == 42) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="20">III. Kemampuan Menyelesaikan Pekerjaan</td>
                                        <td rowspan="5">1. Pengendalian diri dalam bekerja </td>
                                        <td>Tidak meninggalkan pekerjaan sebelum pekerjaan selesai. </td>
                                        <td>@if($data->pengendalian_diri == 28) &#10004; @endif </td>
                                        <td rowspan="5"> {{ $data->pengendalian_diri }} </td>
                                    </tr>
                                    <tr>
                                        <td>Dapat menyelesaikan pekerjaan meski kurang maksimal.</td>
                                        <td>@if($data->pengendalian_diri == 26) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Menyelesaikan pekerjaan walau dengan sesuka hati.</td>
                                        <td>@if($data->pengendalian_diri == 24) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td>Menunda-nunda pekerjaan yang sudah diperintahkan.</td>
                                        <td>@if($data->pengendalian_diri == 20) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Menyelesaikan pekerjaan sesuai dengan prioritasnya. </td>
                                        <td>@if($data->pengendalian_diri == 30) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5">2. Kualitas Kerja
                                        </td>
                                        <td>Kualitas kerja bagus juga menjadi panutan dalam tim dan lingkungan.
                                        </td>
                                        <td>@if($data->kualitas_kerja == 49) &#10004; @endif</td>
                                        <td rowspan="5"> {{ $data->kualitas_kerja }} </td>
                                    </tr>
                                    <tr>
                                        <td>Kualitas kerja tidak stabil namun dapat bekerja sama dengan tim.</td>
                                        <td>@if($data->kualitas_kerja == 28) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Kualitas kerja kurang bagus dan tidak dapat berkoordinasi dalam bekerja. </td>
                                        <td>@if($data->kualitas_kerja == 33) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Kualitas kerja bagus serta tidak terdapat revisi atau pengulangan kerja</td>
                                        <td>@if($data->kualitas_kerja == 43.5) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td>Kualitas kerja kurang bagus terkandang terdapat revisi atau pengulangan kerja.</td>
                                        <td>@if($data->kualitas_kerja == 37.5) &#10004; @endif</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5">3. Efisiensi Kerja
                                        </td>
                                        <td>Tidak mampu dalam mencapai target kerja serta tidak memiliki rencana kerja.
                                        </td>
                                        <td>@if($data->efesiensi_kerja == 40) &#10004; @endif </td>
                                        <td rowspan="5"> {{ $data->efesiensi_kerja }} </td>
                                    </tr>
                                    <tr>
                                        <td>Mengerjakan pekerjaan sesuai terget kerja serta memiliki rencana kerja. </td>
                                        <td>@if($data->efesiensi_kerja == 60) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td>Menyelesaikan pekerjaan sesuai target waktu serta target kerja terpenuhi.
                                        </td>
                                        <td>@if($data->efesiensi_kerja == 58) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td>Ketepatan waktu penyelesaian pekerjaan kurang namun mampu mencapai target kerja.
                                        </td>
                                        <td>@if($data->efesiensi_kerja == 50) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td>Terkadang melakukan penundaan pekerjaan juga kurang dalam pencapaian target kerja.
                                        </td>
                                        <td>@if($data->efesiensi_kerja == 48) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5">4. Kesadaran Keselamatan Dalam Berkerja
                                        </td>
                                        <td>Menggunakan APD saat bekerja juga mampu memberikan pemahaman kepada rekan kerja terkait pentingnya keselamatan.
                                        </td>
                                        <td>@if($data->keselamatan_dalam_kerja == 35) &#10004; @endif </td>
                                        <td rowspan="5"> {{ $data->keselamatan_dalam_kerja }} </td>
                                    </tr>
                                    <tr>
                                        <td>Tidak mengabaikan keselamatan kerja dan selalu patuh terkait penggunaan APD lengkap saat bekerja.
                                        </td>
                                        <td>@if($data->keselamatan_dalam_kerja == 22.5) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td>Tidak acuh pada keselematan kerja namun mengenakan APD pada saat bekerja.
                                        </td>
                                        <td>@if($data->keselamatan_dalam_kerja == 17) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td>Memiliki kesadaran akan keselamatan kerja dan mengetahui aturan dalam penggunaan APD lengkap saat bekerja.
                                        </td>
                                        <td>@if($data->keselamatan_dalam_kerja == 20.5) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td>Memiliki kesadaran akan keselamatan kerja namun enggan menggunakan APD lengkap saat bekerja. </td>
                                        <td>@if($data->keselamatan_dalam_kerja == 19) &#10004; @endif </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"> <b> TOTAL PEROLEHAN EVALUASI PENCAPAIAN KINERJA (A)</b></td>
                                        <td><b>{{ $data->total_nilai_kinerja }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end .table-responsive-->
                        <br>
                        <h5>II. EVALUASI PENCAPAIAN KERJA</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <td>PENCAPAIAN KERJA</td>
                                        <td>KOLOM CENTANG</td>
                                        <td>KOLOM NILAI(DIISI OLEH HRD)</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>A+</td>
                                        <td>
                                            @if($hasil_evaluasi_a_plus)
                                            &#10004;
                                            @endif
                                        </td>
                                        <td>{{ $hasil_evaluasi_a_plus }}</td>
                                    </tr>
                                    <tr>
                                        <td>A</td>
                                        <td>@if($hasil_evaluasi_a)&#10004; @endif</td>
                                        <td>{{ $hasil_evaluasi_a }}</td>
                                    </tr>
                                    <tr>
                                        <td>A-</td>
                                        <td>@if($hasil_evaluasi_a_min)&#10004; @endif</td>
                                        <td>{{ $hasil_evaluasi_a_min }}</td>
                                    </tr>
                                    <tr>
                                        <td>B+</td>
                                        <td>@if($hasil_evaluasi_b_plus)&#10004; @endif</td>
                                        <td>{{ $hasil_evaluasi_b }}</td>
                                    </tr>
                                    <tr>
                                        <td>B</td>
                                        <td>@if($hasil_evaluasi_b)&#10004; @endif</td>
                                        <td>{{ $hasil_evaluasi_b }}</td>
                                    </tr>
                                    <tr>
                                        <td>B-</td>
                                        <td>@if($hasil_evaluasi_b_min)&#10004; @endif</td>
                                        <td>{{ $hasil_evaluasi_b_min }}</td>
                                    </tr>
                                    <tr>
                                        <td>C+</td>
                                        <td>@if($hasil_evaluasi_c_plus)&#10004; @endif</td>
                                        <td>{{ $hasil_evaluasi_c_plus }}</td>
                                    </tr>
                                    <tr>
                                        <td>C</td>
                                        <td>@if($hasil_evaluasi_c)&#10004; @endif</td>
                                        <td>{{ $hasil_evaluasi_c }}</td>
                                    </tr>
                                    <tr>
                                        <td>C-</td>
                                        <td>@if($hasil_evaluasi_c_min)&#10004; @endif</td>
                                        <td>{{ $hasil_evaluasi_c_min }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><b>TOTAL PEROLEHAN EVALUASI PENCAPAIAN KERJA (B)</b></td>
                                        <td><b>{{ $data->total_nilai_pencapaian }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
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