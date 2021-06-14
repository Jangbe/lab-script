@can('edit_user')
    <a href="{{route('users.edit',$user['id'])}}" class="btn btn-primary btn-sm">
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('delete_user')
    <form method="POST" action="{{route('users.destroy',$user['id'])}}"  class="d-inline">
        <input type="hidden" name="_method" value="delete">
        <button type="submit" class="btn btn-danger btn-sm delete_user">
            <i class="fa fa-trash"></i>
        </button>
    </form>
@endcan
