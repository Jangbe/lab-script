@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Settings','Index'],
        'text_right'=>''
    ])

    <div class="container-fluid mt--6">
        {{-- @foreach ($settings as $index => $setting) --}}
        {{-- <form action="{{route('setting.update',$settings[0]['id'])}}" method="post">
            @method('put')
            @csrf
            <div class="card mt-2">
                <div class="card-header">
                    <div id="showTime"></div>
                    <span>{{$settings[0]['name']}}</span>
                    <a class="close" data-toggle="collapse" href="#info_web" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="ni ni-bold-down"></i>
                        <i class="ni ni-bold-right d-none"></i>
                    </a>
                </div>
                <div class="card-body collapse show" id="info_web">
                    <div class="form-row">
                        @foreach (json_decode($settings[0]['value']) as $key => $value)
                        <div class="col-6">
                            <div class="form-group">
                                <label for="{{$key}}">{{$key}}</label>
                                <input type="text" class="form-control" value="{{$value}}" id="{{$key}}" name="{{$key}}">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </div>
        </form> --}}
        {{-- @endforeach --}}
        <form action="{{route('setting.update',$settings[1]['id'])}}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="card mt-2">
                <div class="card-header">
                    <div id="showTime"></div>
                    <span>{{$settings[1]['name']}}</span>
                    <a class="close" data-toggle="collapse" href="#info_pdf" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="ni ni-bold-down"></i>
                        <i class="ni ni-bold-right d-none"></i>
                    </a>
                </div>
                <div class="card-body collapse show" id="info_pdf">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" name="header" id="header" class="custom-file-input">
                            <label for="header" class="custom-file-label">Gambar Header</label>
                        </div>
                        <small class="text-muted">
                            Lebar maks: 640px dan Tinggi maks: 110px
                        </small>
                        @error('header')
                            <i class="text-sm text-danger">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group form-row">
                        <div class="col-6">
                            <label for="show_header">Tampilkan Header</label>
                            <select name="show_header" id="show_header" class="custom-select">
                                <option value="1">Ya</option>
                                <option value="0" {{setting('pdf','show_header')==0?'selected':''}}>Tidak</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="show_header">Tampilkan Penanggung Jawab</label>
                            <select name="show_penanggung_jawab" id="show_penanggung_jawab" class="custom-select">
                                <option value="1">Ya</option>
                                <option value="0" {{setting('pdf','show_penanggung_jawab')==0?'selected':''}}>Tidak</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </div>
        </form>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script>
        $('#settings').addClass('active');
        $('.close').click(function(e){
            $(this).children()[0].classList.toggle('d-none');
            $(this).children()[1].classList.toggle('d-none');
        })
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
        $('input[type=file]').change(function(){
            console.log($(this));
        })
    </script>
@endpush
