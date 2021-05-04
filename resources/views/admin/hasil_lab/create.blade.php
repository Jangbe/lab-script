@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Hasil Lab Rinci','Tambah'],
        'text_right'=>'<a href="'.route('hasil_lab.index').'" class="btn btn-sm btn-neutral">'.__('Kembali').'</a>'
    ])

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="card">

            <div class="card-header border-0">
                <h3 class="mb-0">{{__('Tambah Data Hasil Lab')}}</h3>
            </div>

            <div class="card-body">
                <form action="{{route('hasil_lab.store')}}" method="post">
                    @include('admin.hasil_lab._form')
                </form>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{asset('admin/js/hasil_lab.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#id_tipe').change(function(){
                let id_tipe = $(this).val();
                is_number = $(this).find(':selected').text();
                $.ajax({
                    url: "../get_hsllab_tiper/"+id_tipe,
                    method: 'get',
                    success: function(result){
                        $('#id_tiper').empty();
                        result.forEach(v=>{
                            $('#id_tiper').append(`<option value="${v.id}">${v.nm_tiper}</option>`);
                        })
                    }
                })
                form_result();
            })
            $('input:checkbox').change(function(){
                form_result();
            });
        })
    </script>
@endpush
