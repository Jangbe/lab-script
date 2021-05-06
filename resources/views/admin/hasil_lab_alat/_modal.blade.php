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
                    <label for="id_hasil_lab">Nama Hasil</label>
                    <select name="id_hasil_lab" id="id_hasil_lab" class="custom-select">
                        @foreach ($hasil_labs as $item)
                            <option value="{{$item->id}}">{{$item->nm_hasil}} ({{$item['item']->nm_item}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_alat_lab_rinci">Parameter Alat</label>
                    <select name="id_alat_lab_rinci" id="id_alat_lab_rinci" class="custom-select">
                        @foreach ($alat_labs as $item)
                            <option value="{{$item->id}}">{{$item->parameter}} ({{$item['alatLab']->nm_alat}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="nilai_pembagi">Pembagi</label>
                            <input type="number" name="nilai_pembagi" id="nilai_pembagi" class="form-control">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="nilai_pengali">Pengali</label>
                            <input type="number" name="nilai_pengali" id="nilai_pengali" class="form-control">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="jumlah_koma">Koma</label>
                            <input type="number" name="jumlah_koma" id="jumlah_koma" class="form-control">
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
