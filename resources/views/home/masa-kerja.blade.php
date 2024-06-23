@extends('layouts.app')

@push('css')
<style>
	@keyframes chartjs-render-animation {
		from {
			opacity: .99
		}

		to {
			opacity: 1
		}
	}

	.chartjs-render-monitor {
		animation: chartjs-render-animation 1ms
	}

	.chartjs-size-monitor,
	.chartjs-size-monitor-expand,
	.chartjs-size-monitor-shrink {
		position: absolute;
		direction: ltr;
		left: 0;
		top: 0;
		right: 0;
		bottom: 0;
		overflow: hidden;
		pointer-events: none;
		visibility: hidden;
		z-index: -1
	}

	.chartjs-size-monitor-expand>div {
		position: absolute;
		width: 1000000px;
		height: 1000000px;
		left: 0;
		top: 0
	}

	.chartjs-size-monitor-shrink>div {
		position: absolute;
		width: 200%;
		height: 200%;
		left: 0;
		top: 0
	}
</style>
@endpush

@section('content')
<div class="content">

	<!-- Start Content-->
	<div class="container-fluid">

		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box">
					<div class="page-title-right">
						<form class="form-inline">
							<div class="form-group">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control border" id="dash-daterange">
									<div class="input-group-append">
										<span class="input-group-text bg-blue border-blue text-white">
											<i class="mdi mdi-calendar-range"></i>
										</span>
									</div>
								</div>
							</div>
							<a href="javascript: void(0);" class="btn btn-blue btn-sm ml-2">
								<i class="mdi mdi-autorenew"></i>
							</a>
							<a href="javascript: void(0);" class="btn btn-blue btn-sm ml-1">
								<i class="mdi mdi-filter-variant"></i>
							</a>
						</form>
					</div>
					<h4 class="page-title">Masa Kerja</h4>
				</div>
			</div>
		</div>
		<!-- end page title -->
		@if(Auth::user()->level == "Administrator")
		<div class="row">
			<div class="col-md-6 col-lg-6">
				<div class="widget-rounded-circle card-box">
					<form class="row g-3 mb-2">
						<div class="col-lg-6">
							<input type="month" name="periode" id="periode" class="form-control form-control-sm">
						</div>
						<div class="col-lg-6">
							<select name="years" id="years" class="form-control form-control-sm">
								<option value="" selected>Pilih masa kerja : </option>
								<option value="1">1 Tahun</option>
								<option value="2">2 Tahun</option>
								<option value="3">3 Tahun</option>
								<option value="4">4 Tahun</option>
								<option value="5">5 Tahun</option>
								<option value="6">6 Tahun</option>
								<option value="7">7 Tahun</option>
								<option value="8">8 Tahun</option>
								<option value="9">9 Tahun</option>
							</select>
						</div>
					</form>
					<table>
						<table id="table-list-masa-kerja" class="table dt-responsive nowrap w-100">
							<thead>
								<tr>
									<th width="50px">Periode</th>
									<th width="50px">Masa Kerja</th>
									<th width="80px">Karyawan</th>
									<th width="100px">Total</th>
								</tr>
							</thead>
							<tbody> </tbody>
						</table>
					</table>
				</div> <!-- end widget-rounded-circle-->
			</div> <!-- end col-->

			<div class="col-md-6 col-lg-6">
				<div class="widget-rounded-circle card-box">
					<div class="row">
						<div class="chartjs-size-monitor">
							<div class="chartjs-size-monitor-expand">
								<div class=""></div>
							</div>
							<div class="chartjs-size-monitor-shrink">
								<div class=""></div>
							</div>
						</div>
						<canvas id="canvas_mk" style="width:100%;max-width:800px" class="chartjs-render-monitor"></canvas>
					</div>
				</div> <!-- end widget-rounded-circle-->
			</div> <!-- end col-->

			<div class="col-md-6 col-lg-8">
				<div class="widget-rounded-circle card-box">
					<form action="{{ route('masaKerja') }}" method="get" class="row g-3 mb-2">
						<div class="col-lg-2">
							<label for="">Periode</label>
						</div>
						<div class="col-lg-6">
							<input type="month" name="periode" id="periode" class="form-control form-control-sm">
						</div>
						<div class="col-lg-4">
							<div class="d-grid gap-2 d-md-flex justify-content-md-end">
								<button class="btn btn-primary btn-sm me-md-2" type="submit">Cari periode</button>
								<a href="{{ route('masaKerja') }}" class="btn btn-primary btn-sm" type="button">Default</a>
							</div>
						</div>
					</form>
					<div class="text-center fw-bold text-uppercase mb-1">
						Masa Kerja Penerima Upah
					</div>
					<div class="row">
						<div class="chartjs-size-monitor">
							<div class="chartjs-size-monitor-expand">
								<div class=""></div>
							</div>
							<div class="chartjs-size-monitor-shrink">
								<div class=""></div>
							</div>
						</div>
						<canvas id="canvas_perbandingan_mk" style="width:100%;max-width:800px" class="chartjs-render-monitor"></canvas>
					</div>
				</div> <!-- end widget-rounded-circle-->
			</div> <!-- end col-->
		</div>
		<!-- end row -->
		@endif
		@if(Auth::user()->level == "Pengguna")
		<div class="row">
			@foreach ($pengumuman as $p)
			<div class="col-lg-6 col-xl-3">
				<!-- Simple card -->
				<div class="card">
					<a href="{{ asset('images/500/'. $p->image .'') }}" target="_blank"><img class="card-img-top img-fluid" src="{{ asset('images/500/'. $p->image .'') }}" alt="Card image cap"></a>
					<p class="card-text" align="center"><i>{{ $p->caption }}</i></p>
					<div class="card-body">
						<h5 class="card-title">{{ $p->judul }}</h5>
						<p class="card-text">{{ $p->description }}</a>
					</div>
				</div>
			</div><!-- end col -->
			@endforeach
			@endif
		</div>
		<!-- end row -->
	</div> <!-- container -->
</div> <!-- content -->

@push('js')

<script>
	var label_masa = JSON.parse('{!! json_encode($label_masa) !!}');
	var jumlah_masa_kerja = JSON.parse('{!! json_encode($jumlah_masa_kerja) !!}');
	var jumlah_mk_penerima_upah = JSON.parse('{!! json_encode($jumlah_mk_penerima_upah) !!}');
	var jumlah_mk_penerima_upah_tahun_lalu = JSON.parse('{!! json_encode($jumlah_mk_penerima_upah_tahun_lalu) !!}');
	var jumlah_mk_penerima_upah_tahun_lalu_min1 = JSON.parse('{!! json_encode($jumlah_mk_penerima_upah_tahun_lalu_min1) !!}');
	var periode_saat_ini = JSON.parse('{!! json_encode($periode_saat_ini) !!}');
	var periode_tahun_lalu = JSON.parse('{!! json_encode($periode_tahun_lalu) !!}');
	var periode_tahun_lalu_min1 = JSON.parse('{!! json_encode($periode_tahun_lalu_min1) !!}');
</script>

<script>
	$(function() {

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		var table = $('#table-list-masa-kerja').DataTable({
			processing: true,
			serverSide: true,
			searching: true,
			responsive: true,
			pageLength: 3,
			lengthMenu: [
				[3, 5, 7, -1],
				[3, 5, 7, 10]
			],
			ajax: {
				url: "api/masa-kerja",
				data: function(d) {
					d.periode = $('#periode').val();
					d.years = $('#years').val();
					d.search = $('input[type="search"]').val();
				}
			},
			columns: [{
					data: 'periode',
					name: 'periode'
				},
				{
					data: 'years_worked',
					name: 'years_worked',
					render: function(data, type, row) {
						text = '';
						if (data > 0) {
							text = data + ' Tahun';
						}
						return text;
					}
				},
				{
					data: 'count',
					name: 'count',
				},
				{
					data: 'total_tunj_mk',
					name: 'total_tunj_mk',
					render: function(data, type, row) {
						rupiah = '';
						if (data > 0) {
							rupiah = 'Rp' + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
						} else {
							rupiah = '-';
						}
						return rupiah;
					}
				},
			],
			order: [
				[1, 'desc']
			]
		});

		$("#periode").change(function() {
			table.draw();
		});

		$("#years").change(function() {
			table.draw();
		});
	});
</script>

<script>
	const data = {
		labels: label_masa,
		datasets: [{
			axis: 'y',
			label: 'Masa Kerja Karyawan',
			data: jumlah_masa_kerja,
			backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(255, 159, 64, 0.2)',
				'rgba(255, 205, 86, 0.2)',
				'rgba(75, 192, 192, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(153, 102, 255, 0.2)',
				'rgba(201, 203, 207, 0.2)'
			],
			borderColor: [
				'rgb(255, 99, 132)',
				'rgb(255, 159, 64)',
				'rgb(255, 205, 86)',
				'rgb(75, 192, 192)',
				'rgb(54, 162, 235)',
				'rgb(153, 102, 255)',
				'rgb(201, 203, 207)'
			],
			borderWidth: 1
		}]
	};

	const config_masa_kerja = {
		type: 'horizontalBar',
		data: data,
		options: {
			indexAxis: 'y',
		},
	};

	const data_perbandingan_mk = {
		labels: label_masa,
		datasets: [{
				label: periode_saat_ini,
				data: jumlah_mk_penerima_upah,
				backgroundColor: 'rgba(255, 99, 132, 0.2)',
				borderColor: 'rgb(255, 99, 132)',
				fill: true,
			},
			{
				label: periode_tahun_lalu,
				data: jumlah_mk_penerima_upah_tahun_lalu,
				backgroundColor: 'rgba(255, 159, 64, 0.2)',
				borderColor: 'rgb(255, 159, 64)',
				fill: true,
			},
			{
				label: periode_tahun_lalu_min1,
				data: jumlah_mk_penerima_upah_tahun_lalu_min1,
				backgroundColor: 'rgba(255, 205, 86, 0.2)',
				borderColor: 'rgb(255, 205, 86)',
				fill: true,
			}
		]
	};

	const config_perbandingan_mk = {
		type: 'bar',
		data: data_perbandingan_mk,
		options: {
			indexAxis: 'y',
			// Elements options apply to all of the options unless overridden in a dataset
			// In this case, we are setting the border of each horizontal bar to be 2px wide
			elements: {
				bar: {
					borderWidth: 2,
				}
			},
			responsive: true,
			plugins: {
				legend: {
					position: 'right',
				},
				title: {
					display: true,
					text: 'Chart.js Horizontal Bar Chart'
				}
			}
		},
	};

	window.onload = function() {
		var ctx_masa_kerja = document.getElementById("canvas_mk").getContext("2d");
		window.myLineMasaKerja = new Chart(ctx_masa_kerja, config_masa_kerja);

		var ctx_perbandingan_mk = document.getElementById("canvas_perbandingan_mk").getContext("2d");
		window.myLineMasaKerja = new Chart(ctx_perbandingan_mk, config_perbandingan_mk);
	};
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

@endpush
@endsection