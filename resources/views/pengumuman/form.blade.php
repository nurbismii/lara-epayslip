<div class="modal" id="modal-form-pengumuman" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
          {{ csrf_field() }} {{ method_field('POST') }}
          <div class="modal-header">
            <h3 class="modal-title"></h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"> &times; </span>
            </button>

          </div>

          <div class="modal-body">
            <input type="hidden" id="id" name="id">
            <div class="form-group">
              <label for="nama" class="col-md-6 control-label">Judul</label>
              <div class="col-md-12">
                <input type="text" id="judul" name="judul" class="form-control" placeholder="Judul" autofocus required>
                <span class="help-block with errors"></span>
              </div>
            </div>
            <div class="form-group">
              <label for="nama" class="col-md-6 control-label">Description</label>
              <div class="col-md-12">
                <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
                <span class="help-block with errors"></span>
              </div>
            </div>
            <div class="form-group">
                <label for="nama" class="col-md-6 control-label">Caption</label>
                <div class="col-md-12">
                  <input type="text" id="caption" name="caption" class="form-control" placeholder="Caption" >
                  <span class="help-block with errors"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="nama" class="col-md-6 control-label">Gambar</label>
                <div class="col-md-12">
                  <input type="file" id="image" name="image" class="form-control" >
                  <span class="help-block with errors"></span>
                </div>
            </div>



            <div class="modal-footer">
              <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary btn-save">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
