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
      <div class="col-md-6 col-lg-12">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('bpjs-tk') }}" method="get">
              <select name="periode" class="form-control mb-2">
                <option value="2024">2024</option>
                <option value="2023">2023</option>
              </select>
              <div class="mb-0 text-right">
                <a href="{{ route('bpjs-tk') }}" class="btn btn-warning">Bersihkan</a>
                <button type="submit" class="btn btn-primary">Cari data</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-12">
        <div class="widget-rounded-circle card-box">
          <canvas id="canvas_rentang_bpjs_tk" style="width:100%;max-width:1200px" class="chartjs-render-monitor"></canvas>
        </div>
      </div> <!-- end col-->
      <div class="col-md-6 col-lg-12">
        <div class="widget-rounded-circle card-box">
          <canvas id="canvas_karyawan_bpjs_tk" style="width:100%;max-width:1200px" class="chartjs-render-monitor"></canvas>
        </div>
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
  var data_bpjs_tk = JSON.parse('{!! json_encode($data_bpjs_tk) !!}');
  var data_bpjs_tk_tahun_lalu = JSON.parse('{!! json_encode($data_bpjs_tk_tahun_lalu) !!}');

  var periode_saat_ini = JSON.parse('{!! json_encode($periode_saat_ini) !!}');
  var periode_tahun_lalu = JSON.parse('{!! json_encode($periode_tahun_lalu) !!}');

  var data_jumlah_karyawan_jht = JSON.parse('{!! json_encode($data_jumlah_karyawan_jht) !!}');
  var data_jumlah_karyawan_jht_thn_lalu = JSON.parse('{!! json_encode($data_jumlah_karyawan_jht_thn_lalu) !!}');

  const data_rentang_bpjs_tk = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [{
        label: periode_tahun_lalu,
        data: data_bpjs_tk_tahun_lalu,
        backgroundColor: 'rgba(255, 159, 64, 0.8)',
        borderColor: 'rgb(255, 159, 64)',
        fill: true,
      },
      {
        label: periode_saat_ini,
        data: data_bpjs_tk,
        backgroundColor: 'rgba(255, 99, 132, 0.8)',
        borderColor: 'rgb(255, 99, 132)',
        fill: true,
      }
    ]
  };

  const data_karyawan_bpjs_tk = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [{
        label: periode_tahun_lalu,
        data: data_jumlah_karyawan_jht_thn_lalu,
        backgroundColor: 'rgba(255, 159, 64, 0.8)',
        borderColor: 'rgb(255, 159, 64)',
        fill: true,
      },
      {
        label: periode_saat_ini,
        data: data_jumlah_karyawan_jht,
        backgroundColor: 'rgba(255, 99, 132, 0.8)',
        borderColor: 'rgb(255, 99, 132)',
        fill: true,
      }
    ]
  };

  const config_bpjs_tk = {
    type: 'bar',
    data: data_rentang_bpjs_tk,
    options: {
      indexAxis: 'y',
      // Elements options apply to all of the options unless overridden in a dataset
      // In this case, we are setting the border of each horizontal bar to be 2px wide
      elements: {
        bar: {
          borderWidth: 2,
        }
      },
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var value = dataset.data[tooltipItem.index];
            var formattedValue = new Intl.NumberFormat('id-ID', {
              style: 'currency',
              currency: 'IDR',
              minimumFractionDigits: 0
            }).format(value);

            return data.labels[tooltipItem.index] + ': ' + formattedValue;
          }
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            callback: function(value) {
              // Jika nilai lebih besar atau sama dengan 1000
              if (parseInt(value) >= 1000) {
                // Format nilai menjadi rupiah dengan koma sebagai pemisah ribuan
                var rupiah = 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                // Jika panjang string rupiah lebih besar atau sama dengan 16 karakter, 
                // potong dan tambahkan ' M'
                return rupiah.length >= 16 ? rupiah.substring(0, 5) + ' M' : rupiah;
              } else {
                // Jika nilai kurang dari 1000, kembalikan nilai dengan format rupiah
                return 'Rp ' + value;
              }
            }
          }
        }]
      },
      title: {
        display: true,
        text: 'TREN PEMBAYARAN JHT & JK'
      },
      responsive: true,
      plugins: {
        legend: {
          position: 'right',
        }
      }
    },
  };

  const config_karyawan_bpjs_tk = {
    type: 'bar',
    data: data_karyawan_bpjs_tk,
    options: {
      indexAxis: 'y',
      // Elements options apply to all of the options unless overridden in a dataset
      // In this case, we are setting the border of each horizontal bar to be 2px wide
      elements: {
        bar: {
          borderWidth: 2,
        }
      },
      title: {
        display: true,
        text: 'TREN PEMBAYARAN JHT & JK'
      },
      responsive: true,
      plugins: {
        legend: {
          position: 'right',
        }
      }
    },
  };

  window.onload = function() {
    var ctx_rentang_bpjs_tk = document.getElementById("canvas_rentang_bpjs_tk").getContext("2d");
    window.myLineMasaKerja = new Chart(ctx_rentang_bpjs_tk, config_bpjs_tk);

    var ctx_karyawan_bpjs_tk = document.getElementById("canvas_karyawan_bpjs_tk").getContext("2d");
    window.myLineMasaKerja = new Chart(ctx_karyawan_bpjs_tk, config_karyawan_bpjs_tk);
  }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endpush
@endsection