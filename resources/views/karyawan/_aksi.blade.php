<div class="btn-group dropleft">
	<button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Opsi
	</button>
	<div class="dropdown-menu">
		<a class="dropdown-item" href="{{ $edit }}">Edit</a>
		<a class="dropdown-item" href="{{ $show }}">Detail</a>
		<a class="dropdown-item" href="{{ $destroy }}" onclick="return confirm('Apa kamu yakin ingin menghapus karyawan ini ? {{($data->nama)}}')">Delete</a>
	</div>
</div>