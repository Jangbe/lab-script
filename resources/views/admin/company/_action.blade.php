<a href="{{ route('perusahaan.edit', $company->id) }}">
    <i class="fas fa-edit mx-1 mb-1"></i>{{__('Edit')}}
</a>
<form action="{{ route('perusahaan.destroy', $company->id) }}" method="post">
    @csrf
    @method('delete')
    <button class="bg-transparent border-0 text-danger mt-2 delete_company" type="submit">
        <i class="fas fa-trash"></i>{{__('Hapus')}}
    </button>
</form>
