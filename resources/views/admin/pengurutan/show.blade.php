@extends('layouts.app')

@section('content')
@include('admin.layouts.header', [
    'breadcrumbs'=>['Pasien Test','Tambah'],
    'text_right'=>
        '<a href="'.route('pengurutan.index').'" class="btn btn-sm btn-neutral">'.__('Kembali').'</a>'
])

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div id="showTime"></div>
                    {{__('Informasi Pasien')}}
                    <a class="close" data-toggle="collapse" href="#informasiPasien" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="ni ni-bold-down"></i>
                        <i class="ni ni-bold-right d-none"></i>
                    </a>
                </div>
                <div class="card-body collapse show" id="informasiPasien">
                    {{-- For patient registration --}}
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-row mb-2">
                                <label for="no_pendaftaran" class="col-5 col-form-label col-form-label-sm">Nama Pemeriksaan</label>
                                <div class="col-7">
                                    <input type="text" disabled class="form-control form-control-sm" id="no_pendaftaran" value="{{$pengurutan->nm_item}}">
                                </div>
                            </div>
                            <div class="form-row mb-2">
                                <label for="tanggal_daftar" class="col-5 col-form-label col-form-label-sm">Group</label>
                                <div class="col-7">
                                    <input type="text" disabled class="form-control form-control-sm" id="tanggal_daftar" value="{{$pengurutan->group->group_name}}">
                                </div>
                            </div>
                            <div class="form-row mb-2">
                                <label for="cara_bayar" class="col-5 col-form-label col-form-label-sm">Klasifikasi Pemeriksaan</label>
                                <div class="col-7">
                                    <input type="text" disabled class="form-control form-control-sm" id="cara_bayar" value="{{$pengurutan->clasification->clasification_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-row mb-2">
                                <label for="id_pengirim" class="col-5 col-form-label col-form-label-sm">Group Pemeriksaan</label>
                                <div class="col-7">
                                    <input type="text" disabled class="form-control form-control-sm" id="id_pengirim" value="{{$pengurutan->labGroup->lab_group_name}}">
                                </div>
                            </div>
                            <div class="form-row mb-2">
                                <label for="id_penanggung_jawab" class="col-5 col-form-label col-form-label-sm">Pemeriksaan Sample</label>
                                <div class="col-7">
                                    <input type="text" disabled class="form-control form-control-sm" id="id_penanggung_jawab" value="{{$pengurutan->labSample->lab_sample_name}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form method="post" action="{{ route('pengurutan.update',$pengurutan->id) }}">
                @method('put')
                @csrf
                @include('admin.pengurutan._form')
                <div class="form-group mt-3">
                    <button class="btn btn-success" type="submit">{{__('Simpan')}}</button>
                </div>
            </form>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
    <script>
        $('#hasil-menu').addClass('active').removeClass('collapsed').next().addClass('show')
        $('#pengurutan-menu').addClass('active')
        $('.no_urut').change(function(){
            let oldValue = $(this).data('old');
            let newValue = $(this).val();
            if($(this).val()==1||oldValue>newValue){
                $(this).parent().parent().parent().insertBefore($('#no_'+$(this).val()))
            }else{
                $(this).parent().parent().parent().insertAfter($('#no_'+$(this).val()))
            }
            $('.no_urut').each((v,k)=>{
                $(k).parent().parent().parent()[0].id = 'no_'+(v+1);
                $(k).data('old',v+1);
                k.value=v+1;
            });
        })
    </script>
@endpush
