@csrf
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="sts_pengunjung">Pasien</label>
            <div class="form-control">
                <div class="form-check form-check-inline mr-6">
                    <input class="form-check-input" type="radio" name="sts_pengunjung" id="P-B" value="B" checked="checked">
                    <label class="form-check-label" for="P-B">Baru</label>
                </div>
                <div class="form-check form-check-inline ml-6">
                    <input class="form-check-input" type="radio" name="sts_pengunjung" id="P-L" value="L">
                    <label class="form-check-label" for="P-L">Lama</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="no_pendaftaran">No Pendaftaran</label>
            <input type="text" readonly value="{{old('no_pendaftaran')}}" class="form-control" id="no_pendaftaran" name="no_pendaftaran">
        </div>
        <div class="form-group lama">
            <div class="form-row">
                <div class="col-6">
                    <label for="s_no_rm">Cari No RM</label>
                    <select name="s_no_rm" id="s_no_rm" class="custom-select">
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="s_nama">Cari Nama Pasien</label>
                    <select name="s_nama" id="s_nama" class="custom-select">
                        <option value=""></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group baru">
            <label for="noreg">No RM</label>
            <input type="text" id="noreg" name="noreg" readonly value="{{old('noreg')??time()}}" class="form-control">
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
                <i class="text-sm text-danger">{{$message}}</i>
            @enderror
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-8">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="custom-select">
                        <option value=""></option>
                        <option value="1">Belum Menikah</option>
                        <option value="2">Menikah</option>
                        <option value="3">Duda / Janda</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="gol_darah">Gol Darah</label>
                    <select name="gol_darah" id="gol_darah" class="custom-select">
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
            <div class="form-row">
                <div class="col-9">
                    <label for="cara_bayar">Cara Bayar</label>
                    <select name="cara_bayar" id="cara_bayar" class="custom-select">
                        <option value=""></option>
                        <option value="1">TUNAI</option>
                        <option value="2">BPJS</option>
                    </select>
                    @error('cara_bayar')
                        <i class="text-sm text-danger">{{$message}}</i>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="">Status Cito</label>
                    <div class="form-control">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" value="1" id="is_cito" name="is_cito">
                            <label class="custom-control-label" for="is_cito">Ya</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="id_penanggung_jawab">Penanggung Jawab</label>
            <select name="id_penanggung_jawab" id="id_penanggung_jawab" class="custom-select"></select>
        </div>
        <div class="form-group">
            <label for="id_pengirim">Pengirim</label>
            <select name="id_pengirim" id="id_pengirim" class="custom-select"></select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-row">
                <div class="col-4">
                    <label for="rt">Rt</label>
                    <input type="number" id="rt" value="{{old('rt')}}" placeholder="000" name="rt" class="form-control inputs" maxlength="3">
                    @error('rt')
                        <i class="text-sm text-danger">{{$message}}</i>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="rw">Rw</label>
                    <input type="number" id="rw" value="{{old('rw')}}" placeholder="000" name="rw" class="form-control inputs" maxlength="3">
                    @error('rw')
                        <i class="text-sm text-danger">{{$message}}</i>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="kodepos">Kodepos</label>
                    <input type="number" id="kodepos" value="{{old('kodepos')}}" placeholder="000000" name="kodepos" class="form-control inputs" maxlength="6">
                    @error('kodepos')
                        <i class="text-sm text-danger">{{$message}}</i>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="kd_provinsi">Provinsi</label>
            <select id="kd_provinsi" name="kd_provinsi" value="{{old('kd_provinsi')}}" class="custom-select"></select>
        </div>
        <div class="form-group kota">
            <label for="kd_kota">Kab / Kota</label>
            <select id="kd_kota" name="kd_kota" value="{{old('kd_kota')}}" class="custom-select"></select>
        </div>
        <div class="form-group kecamatan">
            <label for="kd_kecamatan">Kecamatan</label>
            <select id="kd_kecamatan" name="kd_kecamatan" value="{{old('kd_kecamatan')}}" class="custom-select"></select>
        </div>
        <div class="form-group kelurahan">
            <label for="kd_kelurahan">Kelurahan</label>
            <select id="kd_kelurahan" name="kd_kelurahan" value="{{old('kd_kelurahan')}}" class="custom-select"></select>
        </div>
        <div class="form-group">
            <label for="no_identitas">No Identitas</label>
            <input type="number" id="no_identitas" value="{{old('no_identitas')}}" name="no_identitas" class="form-control">
        </div>
        <div class="form-group">
            <label for="no_telepon">No Telepon</label>
            <input type="number" id="no_telepon" value="{{old('no_telepon')}}" name="no_telepon" class="form-control">
            @error('no_telepon')
                <i class="text-sm text-danger">{{$message}}</i>
            @enderror
        </div>
        <div class="form-group">
            <label for="id_perusahaan">Perusahaan</label>
            <select id="id_perusahaan" name="id_perusahaan" value="{{old('id_perusahaan')}}" class="custom-select"></select>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" name="alamat1" value="{{old('alamat1')}}" id="alamat1" cols="30" rows="3"></textarea>
            <textarea class="form-control mt-2" name="alamat2" value="{{old('alamat2')}}" id="alamat2" cols="30" rows="2"></textarea>
        </div>
    </div>
</div>
<hr class="mt--1">
<div class="form-row d-flex justify-content-between">
    <div class="col-6">
        <h3>Pemeriksaan</h3>
    </div>
    <div class="col-6">
        <div class="form-group d-flex justify-content-end">
            <button class="btn btn-primary mb-4" id="tambah" type="button">Tambah Pemeriksaan</button>
        </div>
    </div>
</div>
<div class="list-pemeriksaan">

</div>
