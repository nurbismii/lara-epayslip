<div class="modal" id="modal-form-user" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form method="post" class="form-horizontal" data-toggle="validator">
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
              <label for="nama" class="col-md-6 control-label">Nik</label>
              <div class="col-md-12">
                <input type="text" id="nik" name="nik" class="form-control" autofocus readonly>
                <span class="help-block with errors"></span>
              </div>
            </div>
            <div class="form-group">
                <label for="nama" class="col-md-6 control-label">Nama</label>
                <div class="col-md-12">
                  <input type="text" id="nama" name="nama" class="form-control" autofocus readonly>
                  <span class="help-block with errors"></span>
                </div>
              </div>
            <div class="form-group">
              <label for="nama" class="col-md-6 control-label">Email</label>
              <div class="col-md-12">
                <input type="email" id="email" name="email" class="form-control" placeholder="Alamat Email" required readonly>
                <input type="hidden" id="email_lm" name="email_lm" class="form-control" >
                <span class="help-block with errors"></span>
              </div>
            </div>

            <div class="form-group">
                <label for="nama" class="col-md-6 control-label">Status</label>
                <div class="col-md-12">
                  <select class="form-control" name="status" id="status1">
                    <option value="">Pilih Status</option>
                    <option>Aktif</option>
                    <option>Tidak Aktif</option>
                  </select>
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
