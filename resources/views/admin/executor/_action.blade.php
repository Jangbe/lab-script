<a href="{{ route('executor.edit', $executor->id) }}">
    <i class="fas fa-edit mx-1 mb-1"></i>{{__('Edit')}}
</a>
<form action="{{ route('executor.destroy', $executor->id) }}" method="post">
    @csrf
    @method('delete')
    <button class="bg-transparent border-0 text-danger mt-2 delete_executor" type="submit">
        <i class="fas fa-trash"></i>{{__('Hapus')}}
    </button>
</form>
