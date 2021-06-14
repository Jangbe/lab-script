@can('edit_hasil_lab_tipe')
<button type="button" class="bg-transparent border-0 text-info edit_tipe" data-id="{{$item->id}}">
    <i class="fas fa-edit mx-1 mb-1"></i>{{__('Edit')}}
</button>
@endcan
@can('delete_hasil_lab_tipe')
<form action="{{ route('hasil_lab_tipe.destroy', $item->id) }}" method="post">
    @csrf
    @method('delete')
    <button class="bg-transparent border-0 text-danger mt-2 delete_item" type="submit">
        <i class="fas fa-trash mr-1"></i>{{__('Hapus')}}
    </button>
</form>
@endcan
