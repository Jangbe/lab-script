@extends('layouts.app')

@section('text_right')
    @can('create_hasil_lab_rincian')
        <button id="create" class="btn btn-sm btn-neutral">{{__('Create')}}</button>
    @endcan
@endsection

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Hasil Lab Rinci','index']
    ])

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="card">

            <div class="card-header border-0">
                <h3 class="mb-0">{{__('Tabel Hasil Rinci')}}</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="hasil_lab_tiper_table">
                    <thead class="thead-light">
                        <tr>
                        <th style="width: 2%">{{__('ID')}}</th>
                        <th>{{__('Nama Tipe')}}</th>
                        <th>{{__('Uraian Tipe Rinci')}}</th>
                        <th>{{__('Aksi')}}</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
        @can('create_hasil_lab_rincian')
            @include('admin.hasil_lab_rinci.modal')
        @endcan
    </div>
@endsection
@push('js')
    <script src="{{asset('admin/js/hasil_lab_tiper.js')}}"></script>
@endpush
