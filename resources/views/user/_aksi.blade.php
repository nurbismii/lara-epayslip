<a href="{{ $edit }}" class="btn btn-sm btn-outline-blue waves-effect waves-light">
  <i class="mdi mdi-pencil mr-2"></i><b> Ubah </b>
</a>
<a href="{{ $destroy }}" onclick="return confirm('Yakin ingin menghapus pengguna ini ({{ $data->name }}) ?')" class="btn btn-sm btn-outline-danger waves-effect waves-light">
  <i class="mdi mdi-close mr-1"></i><b> Hapus </b>
</a>