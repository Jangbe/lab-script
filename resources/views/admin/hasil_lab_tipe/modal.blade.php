<!-- Modal -->
<div class="modal fade" id="hslLabTipe" tabindex="-1" aria-labelledby="hslLabTipeLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="post" id="form">
            @csrf
            @method('patch')
            <div class="modal-header">
                <h5 class="modal-title" id="hslLabTipeLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="keterangan">Nama Tipe</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" name="is_number" type="checkbox" value="1" id="is_number">
                        <label for="is_number" class="custom-control-label">{{__('Number')}}</label>
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
