@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Pelaksana','Tambah'],
        'text_right'=>'<a href="'.route('executor.index').'" class="btn btn-sm btn-neutral">'.__('Kembali').'</a>'
    ])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{__('Tambah Pelaksana')}}
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('executor.store') }}">
                            @include('admin.executor._form')
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
        $('#fee').parent().hide();
        $('#pelaksana').addClass('active');
        $('#pengirim').change(function(e){
            if(e.target.checked){
                $('#fee').parent().fadeIn()
            }else{
                $('#fee').parent().fadeOut()
            }
        })
    </script>
@endpush
