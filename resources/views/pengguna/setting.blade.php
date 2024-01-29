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

                                          <li class="breadcrumb-item"><a href="javascript: void(0);">Pengguna</a></li>
                                          <li class="breadcrumb-item active">Akun Saya</li>
                                      </ol>
                                  </div>
                                  <h4 class="page-title">Edit Data</h4>
                              </div>
                          </div>
                      </div>
                      <!-- end page title -->

                      <!-- Form row -->
                      <div class="row">
                          <div class="col-12">
                              <div class="card">
                                  <div class="card-body">

                                      <form action="{{ route('update.akun', $pengguna->id) }}" method="POST">
                                        @csrf
                                          <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nama" class="col-form-label">Nama</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"  value="{{ $pengguna->name }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                  <label for="inputEmail4" class="col-form-label">Email</label>
                                                  <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Email" value="{{ $pengguna->email }}" required>
                                                  <input type="hidden" class="form-control"  name="email_lm" value="{{ $pengguna->email }}" >
                                            </div>
                                          </div>
                                          <input type="hidden" name="_method" value="PATCH">
                                          <div class="form-row">
                                            <div class="form-group  col-md-12">
                                                <label for="inputPassword4" class="col-form-label">Kata Sandi</label>
                                                <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Kosongkan Jika Tidak Ingin Mengganti Kata Sandi" >
                                            </div>

                                          </div>

                                          <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>

                                      </form>

                                  </div> <!-- end card-body -->
                              </div> <!-- end card-->
                          </div> <!-- end col -->
                      </div>
                      <!-- end row -->


                  </div> <!-- container -->


@endsection
