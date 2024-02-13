$(function() {
  
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
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

