$(function() {
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  var table = $('#table-list-salary').DataTable({
      processing: true,
      serverSide: true,
      searching: true,
      responsive: true,
      ajax: {
          url: "/salary",
          data: function(d) {
              d.search = $('input[type="search"]').val();
              d.periode = $('#periode').val();
          }
      },
      columns: [{
              data: 'nik',
              name: 'nik'
          },
          {
              data: 'periode',
              name: 'periode'
          },
          {
              data: 'gaji_pokok',
              name: 'gaji_pokok',
              render: function(data, type, row) {
                rupiah = '';
                if(data > 0) {
                    rupiah = 'Rp' + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                }else {
                    rupiah = '-';
                }
                return rupiah;
              }
          },
          {
              data: 'tunj_um',
              name: 'tunj_um',
              render: function(data, type, row) {
                rupiah = '';
                if(data > 0) {
                    rupiah = 'Rp' + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                }else {
                    rupiah = '-';
                }
                return rupiah;
              }
          },
          {
              data: 'tunj_pengawas',
              name: 'tunj_pengawas',
              render: function(data, type, row) {
                rupiah = '';
                if(data > 0) {
                    rupiah = 'Rp' + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                }else {
                    rupiah = '-';
                }
                return rupiah;
              }
          },
          {
              data: 'tunj_mk',
              name: 'tunj_mk',
              render: function(data, type, row) {
                rupiah = '';
                if(data > 0) {
                    rupiah = 'Rp' + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                }else {
                    rupiah = '-';
                }
                return rupiah;
              }
          },
          {
            data: 'tot_diterima',
            name: 'tot_diterima',
            render: function(data, type, row) {
                rupiah = '';
                if(data > 0) {
                    rupiah = 'Rp' + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                }else {
                    rupiah = '-';
                }
                return rupiah;
              }
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

  $(".filter").change(function() {
    table.draw();
  });

  var table = $('#table-list-pengguna').DataTable({
      processing: true,
      serverSide: true,
      searching: true,
      responsive: true,
      ajax: {
          url: "/user",
          data: function(d) {
              d.search = $('input[type="search"]').val();
          }
      },
      columns: [{
              data: 'nik',
              name: 'nik'
          },
          {
              data: 'name',
              name: 'name'
          },
          {
            data: 'email',
            name: 'email'
          },
          {
            data: 'status',
            name: 'status'
          },
          {
              data: 'action',
              name: 'action',
              orderable: false
          },
      ],
      order: [
          [0, 'desc']
      ]
  });

});

