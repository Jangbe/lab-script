@can('create_setting_hasil_alat_lab')
<button data-id="{{$item->id}}" type="button" class="bg-transparent border-0 text-success mt-2 edit">
    <i class="fas fa-edit mx-1 mb-1"></i>{{__('Edit')}}
</button>
@endcan
@can('delete_setting_hasil_alat_lab')
<form action="{{ route('hasil_lab_alat.destroy', $item->id) }}" method="post">
    @csrf
    @method('delete')
    <button class="bg-transparent border-0 text-danger mt-2 delete_item" type="submit">
        <i class="fas fa-trash"></i>{{__('Hapus')}}
    </button>
</form>
@endcan
