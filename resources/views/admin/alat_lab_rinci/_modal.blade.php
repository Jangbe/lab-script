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
                    <label for="id_alat">Nama Alat</label>
                    <select name="id_alat" id="id_alat" class="custom-select">
                        @foreach ($alat_labs as $alat)
                            <option value="{{$alat->id}}">{{$alat->nm_alat}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="parameter">Parameter</label>
                    <input type="text" name="parameter" id="parameter" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tipe_nilai">Tipe Nilai</label>
                    <select name="tipe_nilai" id="tipe_nilai" class="custom-select">
                        <option value="1">Numeric</option>
                        <option value="2">Teks</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nilai">Nilai</label>
                            <input type="number" name="nilai" id="nilai" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <input type="number" name="satuan" id="satuan" class="form-control">
                        </div>
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
