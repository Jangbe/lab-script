@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Edit Hak Akses','Index'],
        'text_right'=>'<a href="'.route('hak_akses.index').'" class="btn btn-sm btn-neutral">'.__('Kembali').'</a>'
    ])
    <div class="container-fluid mt--6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit Role') }}</h3>
            </div>
            <!-- /.card-header -->
            <form method="POST" action="{{route('hak_akses.update',$role['id'])}}">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="col-lg-12">
                        @include('admin.roles._form')
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check"></i>
                            {{__('Save')}}
                        </button>
                    </div>
                </div>
            </form>

            <!-- /.card-body -->
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
@push('js')
    <script src="{{url('admin/js/roles.js')}}"></script>
    <script>
        (function($){

            "use strict";

            @if(isset($role))
                @foreach($role['permissions'] as $permission)
                    $("#{{$permission['permission']['key']}}").prop('checked',true);
                @endforeach
            @endif

        })(jQuery);
    </script>
@endpush
