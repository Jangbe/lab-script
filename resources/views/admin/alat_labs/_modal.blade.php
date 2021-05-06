<!-- Modal -->
<div class="modal fade" id="alatLab" tabindex="-1" aria-labelledby="alatLabLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="post" id="form">
            @csrf
            @method('patch')
            <div class="modal-header">
                <h5 class="modal-title" id="alatLabLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nm_alat">Nama Alat</label>
                    <input type="text" name="nm_alat" id="nm_alat" class="form-control">
                </div>
                <div class="form-group">
                    <label for="uraian">Uraian</label>
                    <input type="text" name="uraian" id="uraian" class="form-control">
                </div>
                <hr>
                <h4 class="text-center mb-3">RS-232</h4>
                <div class="form-row">
                    <div class="col-md-4 col-6">
                        <div class="form-group">
                            <label for="com">Com</label>
                            <input type="number" name="com" id="com" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="form-group">
                            <label for="timeout">Timeout</label>
                            <input type="number" name="timeout" id="timeout" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="form-group">
                            <label for="buffer">Buffer</label>
                            <input type="number" name="buffer" id="buffer" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="form-group">
                            <label for="baudrate">BaudRate</label>
                            <input type="number" name="baudrate" id="baudrate" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="form-group">
                            <label for="databits">Databits</label>
                            <input type="number" name="databits" id="databits" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="form-group">
                            <label for="parity">Parity</label>
                            <input type="number" name="parity" id="parity" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="form-group">
                            <label for="stopbits">StopBits</label>
                            <input type="number" name="stopbits" id="stopbits" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="form-group">
                            <label for="timer">Timer</label>
                            <input type="number" name="timer" id="timer" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" name="is_active" type="checkbox" value="1" id="is_active">
                        <label for="is_active" class="custom-control-label">{{__('Aktif')}}</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
</div>
