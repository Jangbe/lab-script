@csrf
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="noreg">No RM</label>
            <input type="text" readonly value="{{time()}}" class="form-control" id="noreg" name="noreg">
        </div>
        <div class="form-group">
            <label for="hub">Hubungan Keluarga</label>
            <select name="hub" id="hub" class="custom-select">
                <option value=""></option>
                <option value="1">Peserta / YBS</option>
                <option value="2">Istri / Suami</option>
                <option value="3">Anak Ke-1</option>
                <option value="4">Anak Ke-2</option>
                <option value="5">Anak Ke-3</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" value="{{old('nama')}}" class="form-control" id="nama" name="nama">
        </div>
        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" value="{{old('tempat_lahir')}}" class="form-control" id="tempat_lahir" name="tempat_lahir">
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-8">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" value="{{old('tanggal_lahir')}}" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                </div>
                <div class="col-4">
                    <label for="umur">Umur</label>
                    <input type="text" value="{{old('umur')}}" disabled class="form-control" id="umur" name="umur">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <div class="form-control">
                <div class="form-check form-check-inline mr-6">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="L" value="L">
                    <label class="form-check-label" for="L">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline ml-6">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="P" value="P">
                    <label class="form-check-label" for="P">Perempuan</label>
                </div>
            </div>
            @error('jenis_kelamin')
                <i class="text-danger text-sm italic">{{$message}}</i>
            @enderror
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-8">
                    <label for="status">Status</label>
                    <select name="status" value="{{old('status')}}" id="status" class="custom-select">
                        <option value=""></option>
                        <option value="1">Belum Menikah</option>
                        <option value="2">Menikah</option>
                        <option value="3">Duda / Janda</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="gol_darah">Gol Darah</label>
                    <select name="gol_darah" value="{{old('gol_darah')}}" id="gol_darah" class="custom-select">
                        <option value=""></option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" name="alamat1" value="{{old('alamat1')}}" id="alamat1" cols="30" rows="3"></textarea>
            <textarea class="form-control mt-2" name="alamat2" value="{{old('alamat2')}}" id="alamat2" cols="30" rows="2"></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-row">
                <div class="col-4">
                    <label for="rt">Rt</label>
                    <input type="number" value="{{old('rt')}}" id="rt" placeholder="000" name="rt" class="form-control inputs" maxlength="3">
                    @error('rt')
                        <i class="text-danger text-sm italic">{{$message}}</i>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="rw">Rw</label>
                    <input type="number" value="{{old('rw')}}" id="rw" placeholder="000" name="rw" class="form-control inputs" maxlength="3">
                    @error('rw')
                        <i class="text-danger text-sm italic">{{$message}}</i>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="kodepos">Kodepos</label>
                    <input type="number" value="{{old('kodepos')}}" id="kodepos" placeholder="00000" name="kodepos" class="form-control inputs" maxlength="5">
                    @error('kodepos')
                        <i class="text-danger text-sm italic">{{$message}}</i>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="kd_provinsi">Provinsi</label>
            <select id="kd_provinsi" value="{{old('kd_provinsi')}}" name="kd_provinsi" class="custom-select"></select>
        </div>
        <div class="form-group kota">
            <label for="kd_kota">Kab / Kota</label>
            <select id="kd_kota" value="{{old('kd_kota')}}" name="kd_kota" class="custom-select"></select>
        </div>
        <div class="form-group kecamatan">
            <label for="kd_kecamatan">Kecamatan</label>
            <select id="kd_kecamatan" value="{{old('kd_kecamatan')}}" name="kd_kecamatan" class="custom-select"></select>
        </div>
        <div class="form-group kelurahan">
            <label for="kd_kelurahan">Kelurahan</label>
            <select id="kd_kelurahan" value="{{old('kd_kelurahan')}}" name="kd_kelurahan" class="custom-select"></select>
        </div>
        <div class="form-group">
            <label for="no_identitas">No Identitas</label>
            <input type="number" value="{{old('no_identitas')}}" id="no_identitas" name="no_identitas" class="form-control">
        </div>
        <div class="form-group">
            <label for="no_telepon">No Telepon</label>
            <input type="number" value="{{old('no_telepon')}}" id="no_telepon" name="no_telepon" class="form-control">
            @error('no_telepon')
                <i class="text-danger text-sm italic">{{$message}}</i>
            @enderror
        </div>
        <div class="form-group">
            <label for="id_perusahaan">Perusahaan</label>
            <select id="id_perusahaan" value="{{old('id_perusahaan')}}" name="id_perusahaan" class="custom-select"></select>
        </div>
    </div>
</div>
