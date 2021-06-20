@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Laporan Keuangan','Index'],
        'text_right'=>''
    ])

    <div class="container-fluid mt--6">
        <div class="card">
            <form action="ajax_transaksi" target="_blank" id="form" method="post">
                <div class="card-header">
                    @csrf
                    <input type="hidden" name="aksi">
                    <div class="form-group form-row">
                        <div class="col-md-3 col-6">
                            <label for="from">Tanggal</label>
                            <input type="date" name="from" id="from" class="form-control">
                        </div>
                        <div class="col-md-3 col-6">
                            <label for="to">s.d</label>
                            <input type="date" name="to" id="to" class="form-control">
                        </div>
                        <div class="col-md-4 col-6">
                            <label for="docter">Dokter</label>
                            <select name="docter" id="docter" class="custom-select">
                                <option value="all">Semua</option>
                                @foreach ($docters as $docter)
                                    <option value="{{$docter->id}}">{{$docter->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-6">
                            <label for="aksi">Aksi</label>
                            <button type="submit" name="aksi" id="preview" value="preview" class="form-control btn btn-primary">Preview</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="result table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>TANGGAL</th>
                                    <th>NAMA</th>
                                    <th>TOTAL BIAYA</th>
                                    <th>DOKTER PENGIRIM</th>
                                    <th>FEE</th>
                                </tr>
                            </thead>
                            <tbody id="result">

                            </tbody>
                        </table>
                        <button type="submit" id="pdf" name="aksi" value="pdf" class="btn btn-info mt-2">
                            <i class="fas fa-file-pdf"></i> Print PDF</button>
                        <button type="submit" id="excel" name="aksi" value="excel" class="btn btn-success mt-2">
                            <i class="fas fa-file-excel"></i> Export EXCEL</button>
                    </div>
                    <div class="before-result">
                        <div class="alert alert-primary">Silahkan klik preview dulu.</div>
                    </div>
                </div>
            </form>
        </div>
        @include('layouts.footers.guest')
    </div>
@endsection

@push('js')
    <script>
        $('#transaksi').addClass('active')
        $('.result').hide();
        $('#form').on('submit',function(e){
            let from = $('#from').val().trim();
            let to = $('#to').val().trim();
            let docter = $('#docter').val();
            let aksi = $('button[name=aksi]').val();
            let _token = $('input[name=_token]').val();
            $.ajax({
                url:"ajax_transaksi",
                method: 'post',
                data: {from,to,docter,_token},
                success: function(result){
                    $('#err-from').remove();
                    $('#err-to').remove();
                    $('.result').fadeIn();
                    $('.before-result').fadeOut();
                    $('#result').empty();
                    result.forEach((v,k)=>{
                        $('#result').append(`
                            <tr>
                                <td>${k}</td>
                                <td>${v.tanggal}</td>
                                <td>${v.nama}</td>
                                <td>Rp. ${formated_price(v.total_biaya)}</td>
                                <td>${v.nama_dokter}</td>
                                <td>Rp. ${formated_price(v.fee)}</td>
                            </tr>
                        `);
                    })
                },
                error: function(err){
                    let errors = JSON.parse(err.responseText).errors
                    for(let error in errors){
                        $('#'+error).parent().append(`<i class="text-danger text-sm" id="err-${error}">${errors[error][0]}</i>`);
                    }
                    $('.result').fadeOut();
                    $('.before-result').fadeIn();
                }
            })
            e.preventDefault();
        })
        $('#pdf').click(function(){
            $('input[name=aksi]').val('pdf')
            $('#form').unbind('submit').submit();
        })
        $('#excel').click(function(){
            $('input[name=aksi]').val('excel')
            $('#form').unbind('submit').submit();
        })
    </script>
@endpush
