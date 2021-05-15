@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Pasien Test','Pembayaran'],
        'text_right'=>
            '<div class="dropdown">
                <button class="btn btn-sm btn-neutral dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  '.__('Cetak').'
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                  <a href="'.route('pdf.nota',$patientRegistration['no_pendaftaran']).'" target="_blank" class="dropdown-item">'.__('Nota').'</a>
                  <a href="'.route('pdf.kwitansi',$patientRegistration['no_pendaftaran']).'" target="_blank" class="dropdown-item">'.__('Kwitansi').'</a>
                </div>
            </div>
            <a href="'.route('patient_test.index').'" class="btn btn-sm btn-neutral">'.__('Kembali').'</a>'
    ])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-md-7 mb-3">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                      <h3 class="mb-0">Tagihan {{$patientRegistration['patient']['nama']}}</h3>
                    </div>
                    <!-- Light table -->
                    <div class="card-body">
                        <div class="table-responsive">
                          <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr>
                                <th style="width: 10px">No</th>
                                <th>Layanan / Pemeriksaan</th>
                                <th>Pelaksana</th>
                                <th>Harga</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($patientRegistration['patientTest'] as $patientTest)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$patientTest['item']['nm_item']}}</td>
                                        <td>{{$patientTest['executors']['nama']}}</td>
                                        <td class="text-right">{{formated_price($patientTest['item']['itemTarif']['tarif_bayar'])}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2" class="text-right"><b class="pr-2">Total: </b>{{formated_price($patientRegistration['subtotal'])}}</td>
                                </tr>
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                      <h3 class="mb-0">Pembayaran</h3>
                    </div>
                    <!-- Light table -->
                    <div class="card-body">
                        <form action="{{route('patient_registration.bayar_stor',$patientRegistration['no_pendaftaran'])}}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-6">
                                        <label for="tagihan">Tagihan</label>
                                        <input class="number form-control" disabled type="text" id="tagihan" value="{{intval($patientRegistration['subtotal'])}}">
                                    </div>
                                    <div class="col-6">
                                        <label for="nilai_cito">Cito</label>
                                        <input class="number form-control bayar" type="text" id="nilai_cito" name="nilai_cito" {{$patientRegistration['is_cito']==1?'':'disabled'}} value="{{intval($patientRegistration['nilai_cito'])}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-5">
                                        <label for="nilai_admin">Admin</label>
                                        <input class="number form-control bayar" type="text" id="nilai_admin" name="nilai_admin" value="{{intval($patientRegistration['nilai_admin'])}}">
                                    </div>
                                    <div class="col-7">
                                        <div class="form-row">
                                            <div class="col-7">
                                                <label for="discount">Discount</label>
                                                <input class="number form-control bayar" type="text" id="nilai_discount" name="nilai_discount" value="{{intval($patientRegistration['nilai_discount'])}}">
                                            </div>
                                            <div class="col-5">
                                                <label for="discount">Persen (%)</label>
                                                <input class="number form-control bayar"step="any" type="text" id="discount_persen" name="discount_persen" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <small class="form-text text-muted">
                                            Total Keseluruhan: <span id="total_keseluruhan"></span>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-5">
                                        <label for="nilai_uangmuka">Uang Muka</label>
                                        <input class="number form-control" type="text" id="nilai_uangmuka" name="nilai_uangmuka" value="{{intval($patientRegistration['nilai_uangmuka'])}}">
                                    </div>
                                    <div class="col-7">
                                        <label for="pembayar">Pembayar</label>
                                        <input class="form-control" type="text" id="pembayar" name="pembayar" value="{{$patientRegistration['pembayar']}}">
                                    </div>
                                    <div class="col-12">
                                        <small class="form-text text-muted">
                                            <span id="sisa"></span>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lunas">Tanggal Lunas</label>
                                <input class="form-control" type="date" id="tanggal_lunas" value="{{date('Y-m-d')}}" name="tanggal_lunas" value="{{$patientRegistration['tanggal_lunas']}}">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Bayar</button>
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
    <script src="{{ asset('admin') }}/js/patient_payment.js"></script>
@endpush
