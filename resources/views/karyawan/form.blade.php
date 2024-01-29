<div class="modal" id="modal-form-karyawan" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" style="display: none;">
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
                <input type="text" id="nik" name="nik" class="form-control" placeholder="Nik Karyawan" autofocus required>
                <input type="hidden" id="nik_lm" name="nik_lm" class="form-control" >
                <span class="help-block with errors"></span>
              </div>
            </div>
            <div class="form-group">
              <label for="nama" class="col-md-6 control-label">No Ktp</label>
              <div class="col-md-12">
                <input type="text" id="no_ktp" name="no_ktp" class="form-control" placeholder="No KTP" required>
                <input type="hidden" id="no_ktp_lm" name="no_ktp_lm" class="form-control" >
                <span class="help-block with errors"></span>
              </div>
            </div>
            <div class="form-group">
              <label for="nama" class="col-md-6 control-label">Nama</label>
              <div class="col-md-12">
                <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Karyawan" required>
                <span class="help-block with errors"></span>
              </div>
            </div>
              <div class="form-group">
                <label for="nama" class="col-md-6 control-label">Perusahaan</label>
                <div class="col-md-12">
                  <input type="text" id="nm_perusahaan" name="nm_perusahaan" class="form-control" placeholder="Perusahaan" required>
                  <span class="help-block with errors"></span>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-md-6 control-label">Tanggal Lahir</label>
                <div class="col-md-12">
                  <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="" required>
                  <span class="help-block with errors"></span>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-md-6 control-label">NO NPWP</label>
                <div class="col-md-12">
                  <input type="text" id="npwp" name="npwp" class="form-control" placeholder="NO NPWP" >
                  <span class="help-block with errors"></span>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-md-6 control-label">NO BPJS Kes</label>
                <div class="col-md-12">
                  <input type="text" id="bpjs_ket" name="bpjs_ket" class="form-control" placeholder="NO BPJS KESEHATAN" >
                  <span class="help-block with errors"></span>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-md-6 control-label">NO BPJS TK</label>
                <div class="col-md-12">
                  <input type="text" id="bpjs_tk" name="bpjs_tk" class="form-control" placeholder="NO BPJS TK">
                  <span class="help-block with errors"></span>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-md-6 control-label">Vaksin </label>
                <div class="col-md-12">
                  <select id="vaksin_1" name="vaksin_1" class="form-control">
                    <option value="">Pilih Vaksin</option>
                    <option>SUDAH</option>
                    <option>BELUM</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="nama" class="col-md-6 control-label">Tanggal Join</label>
                <div class="col-md-12">
                  <input type="date" id="tgl_join" name="tgl_join" class="form-control" required>
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
