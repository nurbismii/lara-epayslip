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
              name: 'gaji_pokok'
          },
          {
              data: 'tunj_um',
              name: 'tunj_um'
          },
          {
              data: 'tunj_pengawas',
              name: 'tunj_pengawas'
          },
          {
              data: 'tunj_mk',
              name: 'tunj_mk'
          },
          {
            data: 'tot_diterima',
            name: 'tot_diterima'
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

});

