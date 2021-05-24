@csrf
<div class="form-group">
    <label for="example-text-input" class="form-control-label">{{__('Nama Perusahaan')}}</label>
    <input class="form-control" name="company_name" type="text" value="{{$perusahaan->company_name??old('company_name')}}" id="example-text-input">
</div>
<div class="form-row">
    <div class="col-md-4 col-12">
        <div class="form-group">
            <label for="example-email-input" class="form-control-label">{{__('Alamat 1')}}</label>
            <input class="form-control" name="alamat1" type="text" value="{{$perusahaan->alamat1??old('alamat1')}}" id="example-email-input">
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group">
            <label for="example-url-input" class="form-control-label">{{__("Alamat 2")}}</label>
            <input class="form-control" name="alamat2" type="text" value="{{$perusahaan->alamat2??old('alamat2')}}" id="example-url-input">
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group">
            <label for="example-url-input" class="form-control-label">{{__("Kota")}}</label>
            <input class="form-control" name="kota" type="text" value="{{$perusahaan->kota??old('kota')}}" id="example-url-input">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="example-url-input" class="form-control-label">{{__("Telepon 1")}}</label>
            <input class="form-control" name="telp1" type="number" value="{{$perusahaan->telp1??old('telp1')}}" id="example-url-input">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="example-url-input" class="form-control-label">{{__("Telepon 2")}}</label>
            <input class="form-control" name="telp2" type="number" value="{{$perusahaan->telp2??old('telp2')}}" id="example-url-input">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="custom-control custom-checkbox">
        <input class="custom-control-input" name="is_active" type="checkbox" {{isset($perusahaan) && $perusahaan->is_active? 'checked' : ''}} value="1" id="example-password-input">
        <label for="example-password-input" class="custom-control-label">{{__('Aktif')}}</label>
    </div>
</div>
