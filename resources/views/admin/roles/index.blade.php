@extends('layouts.app')

@section('text_right')
    @can('create_roles')
    <a href="{{route('hak_akses.create')}}" class="btn btn-sm btn-neutral">{{__('Create')}}</a>
    @endcan
@endsection

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Hak Akses','Index']
    ])
    <div class="container-fluid mt--6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">{{ __('Roles Table') }}</h3>
                @can('create_role')
                <a href="{{route('admin.roles.create')}}" class="btn btn-primary btn-sm float-right">
                <i class="fa fa-plus"></i> {{ __('Create') }}
                </a>
                @endcan
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table id="roles_table" class="table table-striped table-hover table-bordered"  width="100%">
                            <thead>
                                <tr>
                                    <th width="10px">#</th>
                                    <th>{{ __('Role Name') }}</th>
                                    <th width="150px">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>

        @include('layouts.footers.auth')
    </div>

@endsection
@push('js')
    <script src="{{url('admin/js/roles.js')}}"></script>
@endpush
