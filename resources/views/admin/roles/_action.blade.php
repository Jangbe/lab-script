@can('edit_roles')
    <a href="{{route('hak_akses.edit',$role['id'])}}" class="btn btn-primary btn-sm">
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('delete_roles')
    <form method="POST" action="{{route('hak_akses.destroy',$role['id'])}}" class="d-inline">
        @csrf
        <input type="hidden" name="_method" value="delete">
        <button type="submit" class="btn btn-danger btn-sm delete_role">
            <i class="fa fa-trash"></i>
        </button>
    </form>
@endcan
