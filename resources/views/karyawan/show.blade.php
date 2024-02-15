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
              <li class="breadcrumb-item"><a href="{{ url('karyawan') }}">Data Karyawan</a></li>
              <li class="breadcrumb-item active">Detail</li>
            </ol>
          </div>
          <h4 class="page-title">Detail karyawan</h4>
        </div>
      </div>
    </div>
    <!-- end page title -->

    <div class="row">
      <div class="col-lg-12 col-xl-12">
        <div class="card-box text-center">
          <img src="{{ asset('assets/images/users/user-1.jpg') }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

          <h4 class="mb-0">{{ $data->karyawan->nama }}</h4>
          <p class="text-muted">
            @if(!empty($data->posisi))
            {{ $data->posisi }}
            @endif<br>
            {{ $data->karyawan->nm_perusahaan }}
          </p>
          <div class="row">
            <div class="col-lg-6">
              <table class="text-left">
                <tr>
                  <td>
                    <h4>NAMA</h4>
                  </td>
                  <td>
                    <h4>:</h4>
                  </td>
                  <td>
                    <h4>{{ $data->karyawan->nama }}</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>NIK</h4>
                  </td>
                  <td>
                    <h4>:</h4>
                  </td>
                  <td>
                    <h4>{{ $data->karyawan->nik }}</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>NO KTP</h4>
                  </td>
                  <td>
                    <h4>:</h4>
                  </td>
                  <td>
                    <h4>{{ $data->karyawan->no_ktp }}</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>TANGGAL LAHIR</h4>
                  </td>
                  <td>
                    <h4>:</h4>
                  </td>
                  <td>
                    <h4>{{ date('d-m-Y', strtotime($data->karyawan->tgl_lahir)) }}</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>DEPARTEMEN</h4>
                  </td>
                  <td>
                    <h4>:</h4>
                  </td>
                  <td>
                    <h4>@if(!empty( $data->departemen)){{ $data->departemen }}@endif</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>DIVISI</h4>
                  </td>
                  <td>
                    <h4>:</h4>
                  </td>
                  <td>
                    <h4>@if(!empty( $data->divisi)){{ $data->divisi }}@endif</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>POSISI</h4>
                  </td>
                  <td>
                    <h4>:</h4>
                  </td>
                  <td>
                    <h4>@if(!empty( $data->posisi)){{ $data->posisi }}@endif</h4>
                  </td>
                </tr>

              </table>
            </div>
            <div class="col-lg-6">
              <table class="text-left">
                <tr>
                  <td>
                    <h4>NO NPWP</h4>
                  </td>
                  <td>
                    <h4>:</h4>
                  </td>
                  <td>
                    <h4>{{ $data->karyawan->npwp }}</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>NO BPJS KESEHATAN</h4>
                  </td>
                  <td>
                    <h4>:</h4>
                  </td>
                  <td>
                    <h4>{{ $data->karyawan->bpjs_ket }}</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>NO BPJS KETENAGAKERJAAN</h4>
                  </td>
                  <td>
                    <h4>:</h4>
                  </td>
                  <td>
                    <h4>{{ $data->karyawan->bpjs_tk }}</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>MULAI BEKERJA</h4>
                  </td>
                  <td>
                    <h4>:</h4>
                  </td>
                  <td>
                    <h4>{{ date('d-m-Y', strtotime($data->karyawan->tgl_join)) }}</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>VAKSIN </h4>
                  </td>
                  <td>
                    <h4>:</h4>
                  </td>
                  <td>
                    <h4>{{ $data->karyawan->vaksin_1 }}</h4>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection