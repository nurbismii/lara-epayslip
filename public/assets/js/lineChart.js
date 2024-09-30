const data_emp = {
  labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agust", "Sept", "Oct", "Nov", "Dec"],
  datasets: [{
          label: tahun_lalu,
          data: total_karyawan_tahun_lalu,
          backgroundColor: 'rgba(214, 49, 88, 0.1)',
          borderColor: '#d63158',
          fill: true,
      },
      {
          label: tahun_sekarang,
          data: total_karyawan,
          backgroundColor: 'rgba(57, 126, 204, 0.1)',
          borderColor: '#397ecc',
          fill: true,
      }
  ]
};

const config_emp = {
  type: 'line',
  data: data_emp,
  options: {
      responsive: true,
      plugins: {
          legend: {
              position: 'top',
          },
      },
      title: {
        display: true,
        text: "Line graph penerima upah pokok " + tahun_lalu + " & " + tahun_sekarang
    },
  },
};

var config = {
  type: "line",
  data: {
      labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agust", "Sept", "Oct", "Nov", "Dec"],
      datasets: [{
              label: tahun_lalu,
              backgroundColor: 'rgba(214, 49, 88, 0.1)',
              borderColor: '#d63158',
              fill: true,
              data: payroll_tahun_lalu_record
          },
          {
              label: tahun_sekarang,
              backgroundColor: 'rgba(57, 126, 204, 0.1)',
              borderColor: '#397ecc',
              fill: true,
              data: payroll_record
          }
      ]
  },
  options: {
      tooltips: {
          callbacks: {
              label: function(t, d) {
                  var xLabel = d.datasets[t.datasetIndex].label;
                  var yLabel = t.yLabel >= 1000 ? 'Rp ' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : 'Rp ' + t.yLabel;
                  var result = yLabel.length >= 16 ? yLabel.substring(0, 5) : yLabel;
                  return ': ' + yLabel;
              }
          }
      },
      scales: {
          yAxes: [{
              ticks: {
                  callback: function(value, index, yValues) {
                      if (parseInt(value) >= 1000) {
                          var rupiah = 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                          return rupiah.length >= 16 ? rupiah.substring(0, 5) + ' M' : rupiah
                      } else {
                          return 'Rp ' + value;
                      }
                  }
              }
          }]
      },
      responsive: true,
      title: {
          display: true,
          text: "Line graph total upah pokok " + tahun_lalu + " & " + tahun_sekarang
      },
  }
};

window.onload = function() {
  var ctx = document.getElementById("canvas_pay").getContext("2d");
  window.myLine = new Chart(ctx, config);
};

document.getElementById("randomizeData").addEventListener("click", function() {
  config.data.datasets.forEach(function(dataset) {
      dataset.data = dataset.data.map(function() {
          return randomScalingFactor();
      });
  });

  window.myLine.update();
});