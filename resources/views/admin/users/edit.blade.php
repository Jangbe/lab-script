@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Users','Index'],
        'text_right'=>'<a href="'.route('users.index').'" class="btn btn-sm btn-neutral">Kembali</a>'
    ])
    <div class="container-fluid mt--6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit User') }}</h3>
            </div>
            <!-- /.card-header -->
            <form method="POST" action="{{route('users.update',$user['id'])}}">
                @csrf
                @method('put')
                <input type="hidden" id="user_roles" value="{{$user['roles']}}">
                <div class="card-body">
                    <div class="col-lg-12">
                        @include('admin.users._form')
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check"></i>  {{__('Save')}}
                        </button>
                    </div>
                </div>
            </form>

            <!-- /.card-body -->
        </div>
        @include('layouts.footers.auth')
    </div>

@endsection
@section('js')
    <script src="{{url('admin/js/users.js')}}"></script>
@endsection
