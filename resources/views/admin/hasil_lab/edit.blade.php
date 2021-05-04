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
                <form action="{{route('hasil_lab.update',$hasilLab->id)}}" method="post">
                    @method('patch')
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
                    url: "../../get_hsllab_tiper/"+id_tipe,
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
        $.ajax({
            url: "{{url('admin/hasil_lab').'/'.$hasilLab->id}}",
            success: function(result){
                $('#id_item').val(result.id_item);
                $('#nm_hasil').val(result.nm_hasil);
                $('#level_hasil').val(result.level_hasil);
                $('#is_nilai_normal').attr('checked', result.is_nilai_normal==1);
                $('#is_judul').attr('checked', result.is_judul==1);
                $('#is_teks').attr('checked', result.is_teks==1);
                $('#jml_koma').val(result.jml_koma);
                $('#is_kesimpulan').attr('checked', result.is_kesimpulan==1);
                $('#is_rumus').attr('checked', result.is_rumus==1);
                $('#ket_tambahan').val(result.ket_tambahan);
                $('#ket_rumus').val(result.ket_rumus);
                if(result.nilai_normal&&result.hasil_lab_tiper==null){
                    is_number = 'angka';
                    $('#id_tipe').val(1);
                    for(i in result.nilai_normal){
                        $('#'+i).val(result.nilai_normal[i]);
                    }
                }else{
                    $('#id_tipe').val(result.hasil_lab_tiper.id_tipe);
                    let id_tiper = result.id_tiper;
                    $.ajax({
                        url: "../../get_hsllab_tiper/"+result.hasil_lab_tiper.id_tipe,
                        method: 'get',
                        success: function(result){
                            $('#id_tiper').empty();
                            result.forEach(v=>{
                                $('#id_tiper').append(`<option value="${v.id}">${v.nm_tiper}</option>`);
                            })
                            $('#id_tiper').val(id_tiper);
                        }
                    })
                }
                form_result();
            }
        })
    </script>
@endpush
