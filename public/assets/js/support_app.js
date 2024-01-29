//Table Karyawan
var table_karyawan = $('#karyawan-table').DataTable({
     processing : true,
     serverSide : true,
     dom: 'Bfrtip',
     buttons: [
         'excel', 'pdf', 'print'
     ],
     ajax: "/api/karyawan",
     columns: [
       {data:'nik', name:'nik'},
       {data:'no_ktp', name:'no_ktp'},
       {data:'nama', name:'nama'},
       {data:'nm_perusahaan', name:'nm_perusahaan'},
       {data:'tgl_lahir', name:'tgl_lahir'},
       {data:'npwp', name:'npwp'},
       {data:'bpjs_ket', name:'bpjs_ket'},
       {data:'bpjs_tk', name:'bpjs_tk'},
       {data:'vaksin_1', name:'vaksin_1'},
       {data:'tgl_join', name:'tgl_join'},
       {data:'action', name:'action', orderable: false, searchable: false}
     ]
   });

   function add_karyawan() {
     save_method = "add";
     $('input[name=_method]').val('POST');
     $('#modal-form-karyawan').modal('show');
     $('#modal-form-karyawan from').modal('show');
     $('#modal-form-karyawan form')[0].reset();
     $('.modal-title').text('Tambah Karyawan');
     }

     function edit_karyawan(id) {
       save_method = 'edit';
       $('input[name=_method]').val('PATCH');
       $('#modal-form-karyawan form')[0].reset();
       $.ajax({
         url:"karyawan" + '/' + id + "/edit",
         type: "GET",
         dataType : "JSON",
         success : function(data) {
           $('#modal-form-karyawan').modal('show');
           $('.modal-title').text('Ubah Karyawan');
           $('#id').val(data.id);
           $('#nik').val(data.nik);
           $('#nik_lm').val(data.nik);
           $('#no_ktp').val(data.no_ktp);
           $('#no_ktp_lm').val(data.no_ktp);
           $('#nama').val(data.nama);
           $('#nm_perusahaan').val(data.nm_perusahaan);
           $('#tgl_lahir').val(data.tgl_lahir);
           $('#npwp').val(data.npwp);
           $('#bpjs_ket').val(data.bpjs_ket);
           $('#bpjs_tk').val(data.bpjs_tk);
           $('#vaksin_1').val(data.vaksin_1);
           $('#vaksin_2').val(data.vaksin_2);
           $('#tgl_join').val(data.tgl_join);
         },
         error : function(){
           alert("Data Tidak Ditemukan");
         }
       });
     }

    function delete_karyawan(id){
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    swal({
        title: 'Apakah Anda Yakin?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        type: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus Data!'
    }).then(function () {
        $.ajax({
            url : "karyawan" + '/' + id,
            type : "POST",
            data : {'_method' : 'DELETE', '_token' : csrf_token},
            success : function(data) {
                table_karyawan.ajax.reload();
                swal({
                    title: 'Berhasil!!',
                    text: data.message,
                    type: 'success',
                    timer: '1500'
                })
            },
            error : function (data) {
                swal({
                    title: 'Oops, Ada Yang Salah',
                    text: data.message,
                    type: 'error',
                    timer: '1500'
                })
            }
        });
    });
  }

    $(function(){
      $('#modal-form-karyawan form').validator().on('submit', function(e){
        if (!e.isDefaultPrevented()) {
          var id = $('#id').val();
          if (save_method == 'add') url = "karyawan";
          else url = "karyawan/" + id;

          $.ajax({
                   url : url,
                   type : "POST",
//                        data : $('#modal-form1 form').serialize(),
                   data: new FormData($("#modal-form-karyawan form")[0]),
                   contentType: false,
                   processData: false,
                   success : function(data) {
                       $('#modal-form-karyawan').modal('hide');
                       table_karyawan.ajax.reload();
                       swal({
                           title: 'Berhasil!!',
                           text: data.message,
                           type: 'success',
                           timer: '1500'
                       })
                   },
                   error : function(data){
                       swal({
                           title: 'Oops, Data Yang Anda Input Tidak Valid!!',
                           text: data.message,
                           type: 'error',
                           timer: '1500'
                       })
                   }
               });
               return false;
        }
      });
    });

//Table Pengguna
var table_pengguna = $('#pengguna-table').DataTable({
    processing : true,
    serverSide : true,
    ajax: "/api/pengguna",
    columns: [
      {data:'name', name:'name'},
      {data:'email', name:'email'},
      {data:'level', name:'level'},
      {data:'status', name:'status'},
      {data:'action', name:'action', orderable: false, searchable: false}
    ]
  });

  function add_pengguna() {
    save_method = "add";
    $('input[name=_method]').val('POST');
    $('#modal-form-pengguna').modal('show');
    $('#modal-form-pengguna from').modal('show');
    $('#modal-form-pengguna form')[0].reset();
    $('.modal-title').text('Tambah Pengguna');
    }

    function edit_pengguna(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      $('#modal-form-pengguna form')[0].reset();
      $.ajax({
        url:"pengguna" + '/' + id + "/edit",
        type: "GET",
        dataType : "JSON",
        success : function(data) {
          $('#modal-form-pengguna').modal('show');
          $('.modal-title').text('Ubah Pengguna');
          $('#id').val(data.id);
          $('#nama').val(data.name);
          $('#email').val(data.email);
          $('#email_lm').val(data.email);
          $('#status1').val(data.status);
        },
        error : function(){
          alert("Data Tidak Ditemukan");
        }
      });
    }

   function delete_pengguna(id){
   var csrf_token = $('meta[name="csrf-token"]').attr('content');
   swal({
       title: 'Apakah Anda Yakin?',
       text: "Anda tidak akan dapat mengembalikan ini!",
       type: 'warning',
       showCancelButton: true,
       cancelButtonColor: '#d33',
       confirmButtonColor: '#3085d6',
       confirmButtonText: 'Ya, Hapus Data!'
   }).then(function () {
       $.ajax({
           url : "pengguna" + '/' + id,
           type : "POST",
           data : {'_method' : 'DELETE', '_token' : csrf_token},
           success : function(data) {
               table_pengguna.ajax.reload();
               swal({
                   title: 'Berhasil!!',
                   text: data.message,
                   type: 'success',
                   timer: '1500'
               })
           },
           error : function (data) {
               swal({
                   title: 'Oops, Ada Yang Salah',
                   text: data.message,
                   type: 'error',
                   timer: '1500'
               })
           }
       });
   });
 }

   $(function(){
     $('#modal-form-pengguna form').validator().on('submit', function(e){
       if (!e.isDefaultPrevented()) {
         var id = $('#id').val();
         if (save_method == 'add') url = "pengguna";
         else url = "pengguna/" + id;

         $.ajax({
                  url : url,
                  type : "POST",
//                        data : $('#modal-form1 form').serialize(),
                  data: new FormData($("#modal-form-pengguna form")[0]),
                  contentType: false,
                  processData: false,
                  success : function(data) {
                      $('#modal-form-pengguna').modal('hide');
                      table_pengguna.ajax.reload();
                      swal({
                          title: 'Berhasil!!',
                          text: data.message,
                          type: 'success',
                          timer: '1500'
                      })
                  },
                  error : function(data){
                      swal({
                          title: 'Oops, Email Tidak Boleh Sama',
                          text: data.message,
                          type: 'error',
                          timer: '1500'
                      })
                  }
              });
              return false;
       }
     });
   });

   //Table User
var table_user = $('#user-table').DataTable({
    processing : true,
    serverSide : true,
    dom: 'Bfrtip',
    buttons: [
         'excel', 'pdf', 'print'
    ],
    ajax: "/api/user",
    columns: [
      {data:'nik', name:'nik'},
      {data:'name', name:'name'},
      {data:'email', name:'email'},
      {data:'status', name:'status'},
      {data:'action', name:'action', orderable: false, searchable: false}
    ]
  });

  function add_user() {
    save_method = "add";
    $('input[name=_method]').val('POST');
    $('#modal-form-user').modal('show');
    $('#modal-form-user from').modal('show');
    $('#modal-form-user form')[0].reset();
    $('.modal-title').text('Tambah Pengguna');
    }

    function edit_user(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      $('#modal-form-user form')[0].reset();
      $.ajax({
        url:"user" + '/' + id + "/edit",
        type: "GET",
        dataType : "JSON",
        success : function(data) {
          $('#modal-form-user').modal('show');
          $('.modal-title').text('Ubah Pengguna');
          $('#id').val(data.id);
          $('#nama').val(data.name);
          $('#email').val(data.email);
          $('#nik').val(data.nik);
          $('#status1').val(data.status);
        },
        error : function(){
          alert("Data Tidak Ditemukan");
        }
      });
    }

   function delete_user(id){
   var csrf_token = $('meta[name="csrf-token"]').attr('content');
   swal({
       title: 'Apakah Anda Yakin?',
       text: "Anda tidak akan dapat mengembalikan ini!",
       type: 'warning',
       showCancelButton: true,
       cancelButtonColor: '#d33',
       confirmButtonColor: '#3085d6',
       confirmButtonText: 'Ya, Hapus Data!'
   }).then(function () {
       $.ajax({
           url : "user" + '/' + id,
           type : "POST",
           data : {'_method' : 'DELETE', '_token' : csrf_token},
           success : function(data) {
               table_user.ajax.reload();
               swal({
                   title: 'Berhasil!!',
                   text: data.message,
                   type: 'success',
                   timer: '1500'
               })
           },
           error : function (data) {
               swal({
                   title: 'Oops, Ada Yang Salah',
                   text: data.message,
                   type: 'error',
                   timer: '1500'
               })
           }
       });
   });
 }

   $(function(){
     $('#modal-form-user form').validator().on('submit', function(e){
       if (!e.isDefaultPrevented()) {
         var id = $('#id').val();
         if (save_method == 'add') url = "user";
         else url = "user/" + id;

         $.ajax({
                  url : url,
                  type : "POST",
//                        data : $('#modal-form1 form').serialize(),
                  data: new FormData($("#modal-form-user form")[0]),
                  contentType: false,
                  processData: false,
                  success : function(data) {
                      $('#modal-form-user').modal('hide');
                      table_user.ajax.reload();
                      swal({
                          title: 'Berhasil!!',
                          text: data.message,
                          type: 'success',
                          timer: '1500'
                      })
                  },
                  error : function(data){
                      swal({
                          title: 'Oops, Email Tidak Boleh Sama',
                          text: data.message,
                          type: 'error',
                          timer: '1500'
                      })
                  }
              });
              return false;
       }
     });
   });

  //Table Pengumuman
  var table_pengumuman = $('#pengumuman-table').DataTable({
    processing : true,
    serverSide : true,
    ajax: "/api/pengumuman",
    columns: [
      {data:'judul', name:'judul'},
      {data:'description', name:'description'},
      {data:'gambar', name:'gambar'},
      {data:'caption', name:'caption'},
      {data:'action', name:'action', orderable: false, searchable: false}
    ]
  });

  function add_pengumuman() {
    save_method = "add";
    $('input[name=_method]').val('POST');
    $('#modal-form-pengumuman').modal('show');
    $('#modal-form-pengumuman from').modal('show');
    $('#modal-form-pengumuman form')[0].reset();
    $('.modal-title').text('Tambah Pengumuman');
    }

    function edit_pengumuman(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      $('#modal-form-pengumuman form')[0].reset();
      $.ajax({
        url:"info-pengumuman" + '/' + id + "/edit",
        type: "GET",
        dataType : "JSON",
        success : function(data) {
          $('#modal-form-pengumuman').modal('show');
          $('.modal-title').text('Ubah Pengumuman');
          $('#id').val(data.id);
          $('#judul').val(data.judul);
          $('#caption').val(data.caption);
          $('#description').val(data.description);
          $('#image').val(data.image);
        },
        error : function(){
          alert("Data Tidak Ditemukan");
        }
      });
    }

   function delete_pengumuman(id){
   var csrf_token = $('meta[name="csrf-token"]').attr('content');
   swal({
       title: 'Apakah Anda Yakin?',
       text: "Anda tidak akan dapat mengembalikan ini!",
       type: 'warning',
       showCancelButton: true,
       cancelButtonColor: '#d33',
       confirmButtonColor: '#3085d6',
       confirmButtonText: 'Ya, Hapus Data!'
   }).then(function () {
       $.ajax({
           url : "info-pengumuman" + '/' + id,
           type : "POST",
           data : {'_method' : 'DELETE', '_token' : csrf_token},
           success : function(data) {
               table_pengumuman.ajax.reload();
               swal({
                   title: 'Berhasil!!',
                   text: data.message,
                   type: 'success',
                   timer: '1500'
               })
           },
           error : function (data) {
               swal({
                   title: 'Oops, Ada Yang Salah',
                   text: data.message,
                   type: 'error',
                   timer: '1500'
               })
           }
       });
   });
 }

   $(function(){
     $('#modal-form-pengumuman form').validator().on('submit', function(e){
       if (!e.isDefaultPrevented()) {
         var id = $('#id').val();
         if (save_method == 'add') url = "info-pengumuman";
         else url = "info-pengumuman/" + id;

         $.ajax({
                  url : url,
                  type : "POST",
//                        data : $('#modal-form1 form').serialize(),
                  data: new FormData($("#modal-form-pengumuman form")[0]),
                  contentType: false,
                  processData: false,
                  success : function(data) {
                      $('#modal-form-pengumuman').modal('hide');
                      table_pengumuman.ajax.reload();
                      swal({
                          title: 'Berhasil!!',
                          text: data.message,
                          type: 'success',
                          timer: '1500'
                      })
                  },
                  error : function(data){
                      swal({
                          title: 'Oops, Email Tidak Boleh Sama',
                          text: data.message,
                          type: 'error',
                          timer: '1500'
                      })
                  }
              });
              return false;
       }
     });
   });

