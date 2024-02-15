@extends('layouts.app')

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="page-title-box">
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="javascript: void(0);">Pay Slip</a></li>
							<li class="breadcrumb-item"><a href="{{ url('karyawan') }}">Karyawan</a></li>
							<li class="breadcrumb-item active">Edit Karyawan</li>
						</ol>
					</div>
					<h4 class="page-title">Edit Karyawan</h4>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<form action="{{ route('karyawan.update', $data->id) }}" method="post">
							@csrf
							{{ method_field('patch') }}
							<div class="form-group row">
								<label for="nik" class="col-sm-2 col-form-label col-form-label-sm">NIK</label>
								<div class="col-sm-10">
									<input type="number" name="nik" maxlength="9" value="{{ $data->nik }}" class="form-control form-control-sm" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="no-ktp" class="col-sm-2 col-form-label col-form-label-sm">No KTP</label>
								<div class="col-sm-10">
									<input type="number" name="no_ktp" maxlength="16" value="{{ $data->no_ktp }}" class="form-control form-control-sm" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="nama" class="col-sm-2 col-form-label col-form-label-sm">Nama</label>
								<div class="col-sm-10">
									<input type="text" name="nama" value="{{ $data->nama }}" class="form-control form-control-sm" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="perusahaan" class="col-sm-2 col-form-label col-form-label-sm">Perusahaan</label>
								<div class="col-sm-10">
									<select name="nm_perusahaan" class="form-control form-control-sm" id="">
										<option value="{{ $data->nm_perusahaan }}">{{ $data->nm_perusahaan == 'VDNI' ? 'PT Virtue Dragon Nickel Industry' : 'PT Virtue Dragon Nickel Industrial Park' }}</option>
										<option value="VDNI">PT Virtue Dragon Nickel Industry</option>
										<option value="VDNIP">PT Virtue Dragon Nickel Industrial Park</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="tanggal-lahir" class="col-sm-2 col-form-label col-form-label-sm">Tanggal lahir</label>
								<div class="col-sm-10">
									<input type="date" name="tgl_lahir" value="{{ $data->tgl_lahir }}" class="form-control form-control-sm" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="npwp" class="col-sm-2 col-form-label col-form-label-sm">NPWP</label>
								<div class="col-sm-10">
									<input type="number" name="npwp" value="{{ $data->npwp }}" class="form-control form-control-sm">
								</div>
							</div>
							<div class="form-group row">
								<label for="bpjs-kesehatan" class="col-sm-2 col-form-label col-form-label-sm">BPJS Kesehatan</label>
								<div class="col-sm-10">
									<input type="number" name="bpjs_ket" value="{{ $data->bpjs_ket }}" class="form-control form-control-sm">
								</div>
							</div>
							<div class="form-group row">
								<label for="bpjs-ketenagakerjaan" class="col-sm-2 col-form-label col-form-label-sm">BPJS Ketenagakerjaan</label>
								<div class="col-sm-10">
									<input type="number" name="bpjs_tk" value="{{ $data->bpjs_tk }}" class="form-control form-control-sm">
								</div>
							</div>
							<div class="form-group row">
								<label for="vaksin" class="col-sm-2 col-form-label col-form-label-sm">Vaksin</label>
								<div class="col-sm-10">
									<select name="vaksin_1" class="form-control form-control-sm" id="">
										<option value="{{ $data->vaksin_1 }}" selected>{{ $data->vaksin_1 }}</option>
										<option value="SUDAH">Sudah</option>
										<option value="BELUM">Belum</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="tanggal-join" class="col-sm-2 col-form-label col-form-label-sm">Tanggal join</label>
								<div class="col-sm-10">
									<input type="date" name="tgl_join" value="{{ $data->tgl_join }}" class="form-control form-control-sm" required>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-primary float-right">Perbarui</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection