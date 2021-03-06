@can('edit_pasien')
<a href="{{ route('patient.edit', $patient->id) }}">
    <i class="fas fa-edit mx-1 mb-1"></i>{{__('Edit')}}
</a>
@endcan
@can('delete_pasien')
<form action="{{ route('patient.destroy', $patient->id) }}" method="post">
    @csrf
    @method('delete')
    <button class="bg-transparent border-0 text-danger mt-2 delete_patient" type="submit">
        <i class="fas fa-trash"></i>{{__('Hapus')}}
    </button>
</form>
@endcan
