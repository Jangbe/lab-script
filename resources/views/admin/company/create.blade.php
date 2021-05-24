@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Perusahaan','Tambah'],
        'text_right'=>'<a href="'.route('perusahaan.index').'" class="btn btn-sm btn-neutral">'.__('Kembali').'</a>'
    ])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{__('Tambah Perusahaan')}}
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('perusahaan.store') }}">
                            @include('admin.company._form')
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">{{__('Tambahkan')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script>
        $('#perusahaan').addClass('active');
    </script>
@endpush
