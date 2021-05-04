@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Items','Edit'],
        'text_right'=>'<a href="'.route('item.index').'" class="btn btn-sm btn-neutral">'.__('Kembali').'</a>'
    ])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{__('Edit Item')}}
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('item.update', $item->id) }}">
                            @method('put')
                            @include('admin.item._form')
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">{{__('Update')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>

@endsection

@push('js')
    <script>
        $('#items').addClass('active');
    </script>
@endpush
