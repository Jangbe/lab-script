<!-- Modal -->
<div class="modal fade" id="itemTarif" tabindex="-1" aria-labelledby="itemTarifLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="post" id="form">
            @csrf
            @method('patch')
            <div class="modal-header">
                <h5 class="modal-title" id="itemTarifLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="id_item">Pemeriksaan</label>
                    <select class="custom-select" disabled name="id_item" id="id_item">
                        @foreach ($items as $item)
                            <option value="{{$item->id}}">{{$item->nm_item}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tarif_bayar">Tarif Dasar</label>
                            <input type="number" name="tarif_bayar" class="form-control" id="tarif_bayar">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tarif_bpjs">Tarif BPJS</label>
                            <input type="number" name="tarif_bpjs" class="form-control" id="tarif_bpjs">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tarif_jaminan">Tarif Jaminan</label>
                            <input type="number" name="tarif_jaminan" class="form-control" id="tarif_jaminan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_berlaku">Tanggal Berlaku</label>
                            <input type="date" name="tanggal_berlaku" class="form-control" id="tanggal_berlaku">
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
