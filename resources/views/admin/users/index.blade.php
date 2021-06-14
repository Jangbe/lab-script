@extends('layouts.app')

@section('text_right')
    @can('create_user')
        <a href="{{route('users.create')}}" class="btn btn-sm btn-neutral">{{__('Create')}}</a>
    @endcan
@endsection

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Users','Index'],
        'text_right'=>''
    ])
    <div class="container-fluid mt--6">
        <div class="card card-primary card-outline">
            <div class="card-header">
            <h3 class="card-title">
                {{__('Users Table')}}
            </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="col-lg-12 table-responsive">
                <table id="reports_table" class="table table-striped table-hover table-bordered"  width="100%">
                    <thead>
                    <tr>
                    <th width="10px">#</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('Roles')}}</th>
                    <th width="150px">{{__('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            </div>
            <!-- /.card-body -->
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
@push('js')
  <script src="{{url('admin/js/users.js')}}"></script>
@endpush
