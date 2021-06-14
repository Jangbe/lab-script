@can('edit_pengurutan_pemeriksaan')
<a href="{{route('pengurutan.show',$item['id'])}}">
    <i class="fas fa-edit mr-2"></i>
    {{__('Edit')}}
</a>
@endcan
