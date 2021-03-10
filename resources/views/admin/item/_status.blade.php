@if($item['is_active'] && $item['group']['is_active'])
    <div class="text-center"><i class="fa fa-check-double text-success"></i></div>
@else
    <div class="text-center"><i class="fa fa-times-circle text-danger"></i></div>
@endif
