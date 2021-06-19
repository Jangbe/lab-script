@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Settings','Index'],
        'text_right'=>''
    ])

    <div class="container-fluid mt--6">
        {{-- @foreach ($settings as $index => $setting) --}}
        <form action="{{route('setting.update',$settings[0]['id'])}}" method="post">
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
        </form>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script>
        $('#identitas').addClass('active')
    </script>
@endpush
