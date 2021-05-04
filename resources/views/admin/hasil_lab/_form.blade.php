@csrf
<div class="form-row">
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="id_item">Pemeriksaan</label>
            <select name="id_item" id="id_item" class="custom-select select2">
                <option value=""></option>
                @foreach ($tests as $test)
                    <option value="{{$test->id}}">{{$test->nm_item}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="id_tipe">Tipe Hasil</label>
            <select name="id_tipe" id="id_tipe" class="custom-select select2">
                <option data-number="0" value=""></option>
                @foreach ($tipes as $tipe)
                    <option data-number="{{$tipe->is_number}}" value="{{$tipe->id}}">{{$tipe->keterangan}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-9">
        <div class="form-group">
            <label for="nm_hasil">Nama Hasil</label>
            <input type="text" name="nm_hasil" id="nm_hasil" class="form-control">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="level_hasil">Level</label>
            <input type="number" name="level_hasil" id="level_hasil" class="form-control">
        </div>
    </div>
</div>
<div class="form-group">
    <label>Jenis Hasil</label>
    <div class="form-group">
        <div class="form-row">
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <input type="checkbox" value="1" name="is_nilai_normal" id="is_nilai_normal">
                      </div>
                    </div>
                    <label class="form-control" for="is_nilai_normal"><b>{{__('Nilai Normal')}}</b></label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <input type="checkbox" value="1" name="is_teks" id="is_teks">
                      </div>
                    </div>
                    <label class="form-control" for="is_teks"><b>{{__('Teks')}}</b></label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <input type="checkbox" value="1" name="is_judul" id="is_judul">
                      </div>
                    </div>
                    <label class="form-control" for="is_judul"><b>{{__('Judul')}}</b></label>
                </div>
            </div>
        </div>
    </div>
</div>
<label for="jml_koma">Jumlah Koma</label>
<div class="form-row">
    <div class="col-md-2">
        <input type="number" name="jml_koma" id="jml_koma" class="form-control mb-3">
    </div>
    <div class="col-md-5">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input type="checkbox" value="1" name="is_kesimpulan" id="is_kesimpulan">
              </div>
            </div>
            <label class="form-control" for="is_kesimpulan"><b>{{__('Kesimpulan')}}</b></label>
        </div>
    </div>
    <div class="col-md-5">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input type="checkbox" value="1" name="is_rumus" id="is_rumus">
              </div>
            </div>
            <label class="form-control" for="is_rumus"><b>{{__('Rumus')}}</b></label>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="ket_tambahan">Keterangan Tambahan</label>
            <textarea name="ket_tambahan" id="ket_tambahan" cols="30" rows="3" class="form-control"></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="ket_rumus">Keterangan Rumus</label>
            <textarea name="ket_rumus" id="ket_rumus" cols="30" rows="3" class="form-control"></textarea>
        </div>
    </div>
</div>
<div id="form-angka">
    <hr>
    <h3>Nilai Normal</h3>
    <div class="form-row">
        <div class="col-md-4 col-12">
            <div class="form-group">
                <label for="satuan">Satuan</label>
                <input type="text" name="satuan" class="form-control" id="satuan">
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="form-group">
                <label for="min_p">Min Pria</label>
                <input type="number" name="min_p" class="form-control" id="min_p">
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="form-group">
                <label for="max_p">Max Pria</label>
                <input type="number" name="max_p" class="form-control" id="max_p">
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="form-group">
                <label for="min_w">Min Wanita</label>
                <input type="number" name="min_w" class="form-control" id="min_w">
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="form-group">
                <label for="max_w">Max Wanita</label>
                <input type="number" name="max_w" class="form-control" id="max_w">
            </div>
        </div>
    </div>
    <h3>Nilai Normal Bayi dan Anak</h3>
    <div class="form-row">
        <div class="col-md-3 col-6">
            <div class="form-group">
                <label for="min_b">Min Bayi</label>
                <input type="number" name="min_b" class="form-control" id="min_b">
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="form-group">
                <label for="max_b">Max Bayi</label>
                <input type="number" name="max_b" class="form-control" id="max_b">
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="form-group">
                <label for="min_a">Min Anak</label>
                <input type="number" name="min_a" class="form-control" id="min_a">
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="form-group">
                <label for="max_a">Max Anak</label>
                <input type="number" name="max_a" class="form-control" id="max_a">
            </div>
        </div>
    </div>
</div>
<div id="form-teks">
    <hr>
    <h3>Nilai Normal</h3>
    <div class="form-group">
        <label for="id_tiper">Tipe Rinci</label>
        <select name="id_tiper" value="0" id="id_tiper" class="custom-select">

        </select>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-netral text-primary">Simpan</button>
</div>
