
@csrf
<div class="form-group">
    <label for="example-text-input" class="form-control-label">{{__('Nama')}}</label>
    <input class="form-control" name="nama" type="text" value="{{isset($executor) ? $executor->nama : old('nama')}}" id="example-text-input">
    @error('nama')
        <i class="text-danger text-sm">{{$message}}</i>
    @enderror
</div>
<div class="form-group">
    <label for="example-email-input" class="form-control-label">{{__('NIP')}}</label>
    <input class="form-control" name="nip" type="number" maxlength="13" value="{{isset($executor) ? $executor->nip : old('nip')}}" id="example-email-input">
</div>
<div class="form-group">
    <label for="example-url-input" class="form-control-label">{{__("Alamat")}}</label>
    <input class="form-control" name="alamat" type="text" value="{{isset($executor) ? $executor->alamat : old('alamat')}}" id="example-url-input">
</div>
<div class="form-group">
    <label for="example-tel-input" class="form-control-label">{{__('Telepon')}}</label>
    <input class="form-control" name="telp" type="number" value="{{isset($executor) ? $executor->telp : old('telp')}}" id="example-tel-input">
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" name="aktif" type="checkbox" {{isset($executor) && $executor->aktif? 'checked' : ''}} value="1" id="example-password-input">
                <label for="example-password-input" class="custom-control-label">{{__('Aktif')}}</label>
            </div>
            <div class="custom-control custom-checkbox my-3">
                <input class="custom-control-input" name="pengirim" type="checkbox" {{isset($executor) && $executor->pengirim? 'checked' : ''}} value="1" id="pengirim">
                <label for="pengirim" class="custom-control-label">{{__('Pengirim')}}</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" name="pjawab" type="checkbox" {{isset($executor) && $executor->pjawab? 'checked' : ''}} value="1" id="example-datetime-local-input">
                <label for="example-datetime-local-input" class="custom-control-label">{{__('Penanggung Jawab')}}</label>
            </div>
            <div class="custom-control custom-checkbox my-3">
                <input class="custom-control-input" name="pelaksana" type="checkbox" {{isset($executor) && $executor->pelaksana? 'checked' : ''}} value="1" id="example-date-input">
                <label for="example-date-input" class="custom-control-label">{{__('Pelaksana')}}</label>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="fee">Fee</label>
    <div class="input-group">
        <input type="number" id="fee" name="fee" class="form-control" value="{{isset($executor) ? $executor->fee : old('fee')}}">
        <div class="input-group-append">
            <input type="text" class="form-control" disabled value="% (persen)">
        </div>
    </div>
    @error('fee')
        <i class="text-danger text-sm">{{$message}}</i>
    @enderror
    {{-- <label for="example-month-input" class="form-control-label">{{__('Jenis Pelaksana')}}</label>
    <select name="jenis_pelaksana" id="example-month-input" class="form-control">
        <option value="">1</option>
        <option value="">1</option>
        <option value="">1</option>
        <option value="">1</option>
    </select> --}}
</div>
