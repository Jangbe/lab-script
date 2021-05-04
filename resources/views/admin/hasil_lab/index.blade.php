@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Hasil Lab Rinci','Index'],
        'text_right'=>'<a href="'.route('hasil_lab.create').'" class="btn btn-sm btn-neutral">'.__('Create').'</a>'
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
                        <th>{{__('Pemeriksaan')}}</th>
                        <th style="width: 30%">{{__('Nama Hasil')}}</th>
                        <th>{{__('Level')}}</th>
                        <th class="text-center">{{__('Aksi')}}</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
        @include('admin.hasil_lab.modal_detail')
    </div>
@endsection
@push('js')
    <script src="{{asset('admin/js/hasil_lab.js')}}"></script>
@endpush
