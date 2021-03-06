@canany(['hasil_pemeriksaan_pemeriksaan_pasien','pembayaran_pemeriksaan_pasien','edit_pemeriksaan_pasien','delete_pemeriksaan_pasien'])
<div class="dropdown float-right">
    <a class="btn btn-netral dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="ni ni-settings mr-2"></i>
        {{__('Opsi Lainya')}}
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        @can('hasil_pemeriksaan_pemeriksaan_pasien')
        <a class="dropdown-item text-success detail" href="{{route('patient_test.show',$patient->no_pendaftaran)}}">
            <i class="fas fa-info-circle"></i>
            {{__('Hasil Pemeriksaan')}}
        </a>
        @endcan
        @can('pembayaran_pemeriksaan_pasien')
        <a class="dropdown-item text-primary detail" href="{{route('patient_registration.bayar',$patient->no_pendaftaran)}}">
            <i class="fas fa-hand-holding-usd"></i>
            {{__('Pembayaran')}}
        </a>
        @endcan
        @can('edit_pemeriksaan_pasien')
        <a href="{{route('patient_registration.edit', $patient->no_pendaftaran)}}" class="dropdown-item text-info">
            <i class="fas fa-edit"></i>{{__('Edit')}}
        </a>
        @endcan
        @can('delete_pemeriksaan_pasien')
        <form action="{{ route('patient_registration.destroy', $patient->no_pendaftaran) }}" method="post">
            @csrf
            @method('delete')
            <button class="dropdown-item text-danger delete_patient" type="submit">
                <i class="fas fa-trash"></i>{{__('Hapus')}}
            </button>
        </form>
        @endcan
    </div>
</div>
@endcan
