@can('edit_item')
<a href="{{ route('item.edit', $item->id) }}">
    <i class="fas fa-edit mx-1 mb-1"></i>{{__('Edit')}}
</a>
@endcan
@can('delete_item')
<form action="{{ route('item.destroy', $item->id) }}" method="post">
    @csrf
    @method('delete')
    <button class="bg-transparent border-0 text-danger mt-2 delete_item" type="submit">
        <i class="fas fa-trash"></i>{{__('Hapus')}}
    </button>
</form>
@endcan
