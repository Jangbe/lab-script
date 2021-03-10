
@csrf
<div class="form-group">
    <label for="example-text-input" class="form-control-label">{{__('Nama Item')}}</label>
    <input class="form-control" name="nm_item" type="text" value="{{isset($item) ? $item->nm_item : old('nm_item')}}" id="example-text-input">
</div>
<div class="form-group">
    <label for="id_group" class="form-control-label">{{__('Group')}}</label>
    <select name="id_group" class="custom-select" id="id_group">
        @foreach($groups as $group)
            <option value="{{$group->id}}" {{isset($item) && $group->id == $item->id_group? 'selected' : ''}}>{{$group->group_name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="id_klasifikasi" class="form-control-label">{{__("Klasifikasi")}}</label>
    <select name="id_klasifikasi" class="custom-select" id="id_klasifikasi">
        @foreach($clasifications as $clsf)
        <option value="{{$clsf->id}}" {{isset($item) && $clsf->id == $item->id_klasifikasi? 'selected' : ''}}>{{$clsf->clasification_name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <div class="custom-control custom-checkbox">
        <input class="custom-control-input" name="is_active" type="checkbox" {{isset($item) && $item->is_active? 'checked' : ''}} value="1" id="example-password-input">
        <label for="example-password-input" class="custom-control-label">{{__('Aktif')}}</label>
    </div>
</div>
