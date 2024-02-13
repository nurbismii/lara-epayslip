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
              <li class="breadcrumb-item"><a href="/user">Pengguna</a></li>
              <li class="breadcrumb-item active">Edit pengguna</li>
            </ol>
          </div>
          <h4 class="page-title">Form edit pengguna</h4>
        </div>
      </div>
    </div>
    <!-- end page title -->
    <!-- end row-->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4>
              <span class="table-project-n">Form edit pengguna</span>
            </h4>
            <form action="{{ route('user.update', $data->id) }}" method="post">
              @csrf
              {{ method_field('patch') }}
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="nama-karyawan">Nama karyawan</label>
                  <input type="text" name="name" class="form-control" value="{{ $data->name }}">
                </div>
                <div class="form-group col-md-6">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" value="{{ $data->email }}">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-8">
                  <label for="status">Status</label>
                  <select name="status" class="form-control">
                    @if($data->status == 'Aktif')
                    <option selected value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak aktif</option>
                    @else
                    <option selected value="Tidak Aktif">Tidak aktif</option>
                    <option value="Aktif">Aktif</option>
                    @endif
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputZip">Level</label>
                  <input type="text" class="form-control" value="{{ $data->level }}">
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
          </div> <!-- end card body-->
        </div> <!-- end card -->
      </div><!-- end col-->
    </div>
  </div> <!-- container -->
</div>

@if(Auth::user()->level == "Administrator")
@endif
@endsection