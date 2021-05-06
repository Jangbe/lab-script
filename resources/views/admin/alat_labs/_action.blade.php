<div class="dropdown float-right">
    <a class="btn btn-netral dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="ni ni-settings mr-2"></i>
        {{__('Opsi Lainya')}}
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <button class="dropdown-item text-success detail" data-id="{{$item->id}}">
            <i class="fas fa-info-circle"></i>
            {{__('Detail')}}
        </button>
        <button data-id="{{$item->id}}" type="button" class="dropdown-item text-info edit_tipe">
            <i class="fas fa-edit"></i>{{__('Edit')}}
        </button>
        <form action="{{ route('alat_lab.destroy', $item->id) }}" method="post">
            @csrf
            @method('delete')
            <button class="dropdown-item text-danger delete_item" type="submit">
                <i class="fas fa-trash"></i>{{__('Hapus')}}
            </button>
        </form>
    </div>
</div>
