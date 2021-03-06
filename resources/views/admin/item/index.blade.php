@extends('layouts.app')

@section('text_right')
@can('create_item')
<a href="{{route('item.create')}}" class="btn btn-sm btn-neutral">{{__('Create')}}</a>
@endcan
<div class="dropdown">
    <button class="btn btn-sm btn-neutral dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      {{__('Filter')}}
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
      <button class="dropdown-item filter_status" value="2" type="button">{{__('Semua')}}</button>
      <button class="dropdown-item filter_status" value="1" type="button">{{__('Aktif')}}</button>
      <button class="dropdown-item filter_status" value="0" type="button">{{__('Tidak Aktif')}}</button>
    </div>
</div>
@endsection

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Items','Index']
    ])

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">{{__('Tabel Items')}}</h3>
            </div>
            <!-- Light table -->
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table align-items-center table-flush" id="executors_table">
                    <thead class="thead-light">
                      <tr>
                        <th style="width: 2%">{{__('Kode')}}</th>
                        <th>{{__('Pemeriksaan')}}</th>
                        <th>{{__('Group')}}</th>
                        <th>{{__('Klasifikasi')}}</th>
                        <th>{{__('Aktif')}}</th>
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
    </div>
@endsection

@push('js')
<script src="{{ asset('admin') }}/js/item.js"></script>
<script>
    //delete patient
    $(document).on('click','.delete_item',function(e){
        e.preventDefault();
        var el=$(this);
        swal({
            title: "Are you sure to delete this item?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel"
        }).then(result => {
            if(result.value == true){
                $(el).parent().submit();
            }
        });
    });
</script>
@endpush
