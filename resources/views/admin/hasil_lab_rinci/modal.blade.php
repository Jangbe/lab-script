<!-- Modal -->
<div class="modal fade" id="hslLabTipe" tabindex="-1" role="dialog" aria-labelledby="hslLabTipeLabel" aria-hidden="true">
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
                    <label for="id_tipe">Tipe</label>
                    <select name="id_tipe" id="id_tipe" class="custom-select">
                        <option value=""></option>
                        @foreach ($hasilLabTipes as $item)
                        <option value="{{$item->id}}">{{$item->keterangan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nm_tiper">Uraian Tipe Rinci</label>
                    <input type="text" name="nm_tiper" id="nm_tiper" class="form-control">
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
