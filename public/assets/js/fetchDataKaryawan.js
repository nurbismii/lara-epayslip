$(function() {

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  var tableKaryawan = $('#table-list-karyawan').DataTable({
      processing: true,
      serverSide: true,
      searching: true,
      responsive: true,
      ajax: {
          url: "/karyawan",
          data: function(d) {
              d.search = $('input[type="search"]').val();
          }
      },
      columns: [{
              data: 'nik',
              name: 'nik'
          },
          {
              data: 'no_ktp',
              name: 'no_ktp'
          },
          {
              data: 'nama',
              name: 'nama'
          },
          {
              data: 'nm_perusahaan',
              name: 'nm_perusahaan'
          },
          {
              data: 'tgl_lahir',
              name: 'tgl_lahir'
          },
          {
              data: 'vaksin_1',
              name: 'vaksin_1'
          },
          {
              data: 'tgl_join',
              name: 'tgl_join'
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

