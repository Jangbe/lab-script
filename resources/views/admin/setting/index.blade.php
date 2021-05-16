@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Settings','Index'],
        'text_right'=>'<a href="'.route('patient_test.create').'" class="btn btn-sm btn-neutral">'.__('Create').'</a>'
    ])

    <div class="container-fluid mt--6">
        @foreach ($settings as $index => $setting)
        <form action="{{route('setting.update',$setting['id'])}}" method="post">
            @method('put')
            @csrf
            <div class="card mt-2">
                <div class="card-header">
                    <div id="showTime"></div>
                    <span>{{$setting['name']}}</span>
                    <a class="close" data-toggle="collapse" href="#test_{{$index}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="ni ni-bold-down"></i>
                        <i class="ni ni-bold-right d-none"></i>
                    </a>
                </div>
                <div class="card-body collapse show" id="test_{{$index}}">
                    <div class="form-row">
                        @foreach (json_decode($setting['value']) as $key => $value)
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
        @endforeach
    </div>
@endsection

@push('js')
    <script>
        $('.close').click(function(e){
            $(this).children()[0].classList.toggle('d-none');
            $(this).children()[1].classList.toggle('d-none');
        })
    </script>
@endpush
