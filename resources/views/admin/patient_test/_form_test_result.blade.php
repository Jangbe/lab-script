@if (!$patient_tests->isEmpty())
    <input type="hidden" name="no_pendaftaran" value="{{$patientTest->no_pendaftaran}}">
    @foreach ($patient_tests as $index => $test)
        <div class="card mt-2">
        @if ($test['item']['hasilLab']->isNotEmpty())
            <div class="card-header">
                <div id="showTime"></div>
                <span>{{$test['item']['nm_item']}}</span>
                <a class="close" data-toggle="collapse" href="#test_{{$index}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="ni ni-bold-down"></i>
                    <i class="ni ni-bold-right d-none"></i>
                </a>
            </div>
            <div class="card-body collapse show" id="test_{{$index}}">
                @foreach ($test['item']['hasilLab']->sortBy('no_urut') as $no => $hasilLab)
                    @php
                        $id_pendaftar=substr(strval($patientTest['no_pendaftaran']),-3,3);
                        $no_urut=$id_pendaftar.$hasilLab->id;
                    @endphp
                    @if ($hasilLab->is_judul!=1)
                    <input type="hidden" name="id_hasil_lab[{{$no_urut}}]" value="{{$hasilLab->id}}" readonly>
                    @endif
                    {{-- Jika jenis hasil lab nya judul --}}
                    @if ($hasilLab->is_judul==1)
                        <h4 class="mb-4">{{$hasilLab->nm_hasil}}</h4>
                    {{-- Jika jenis hasil lab nya berupa select options --}}
                    @elseif (!is_null($hasilLab['id_tiper']))
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-5 col-9">
                                <label for="id_tiper_{{$no_urut}}">{{$hasilLab->nm_hasil}}</label>
                                <select name="id_tiper[{{$no_urut}}]" id="id_tiper_{{$no_urut}}" class="custom-select">
                                    @foreach ($hasilLab['hasilLabTiper']['hasilLabTipe']['hasilLabTiper'] as $opt)
                                    <option value="{{$opt['id']}}">{{$opt['nm_tiper']}}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">
                                    Nilai Normal: {{$hasilLab['hasilLabTiper']['nm_tiper']}}
                                </small>
                            </div>
                            <div class="col-md-1 col-3">
                                <label for="is_duplo_{{$no_urut}}">Duplo</label>
                                <div class="form-control">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1" id="is_duplo_{{$no_urut}}" name="is_duplo[{{$no_urut}}]">
                                        <label class="custom-control-label" for="is_duplo_{{$no_urut}}">Ya</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <label for="keterangan_{{$no_urut}}">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan_{{$no_urut}}" name="keterangan[{{$no_urut}}]">
                            </div>
                            <div class="col-md-3 col-6">
                                <label for="kesimpulan_{{$no_urut}}">Kesimpulan</label>
                                <input type="text" {{$hasilLab->is_kesimpulan==1?'':'disabled'}} name="kesimpulan[{{$no_urut}}]" class="form-control">
                            </div>
                        </div>
                    </div>
                    {{-- Jika jenis hasil lab nya teks --}}
                    @elseif($hasilLab->is_teks==1)
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-5 col-9">
                                <label for="hasil_teks_{{$no_urut}}">{{$hasilLab->nm_hasil}}</label>
                                <input type="text" id="hasil_teks_{{$no_urut}}" name="hasil_teks[{{$no_urut}}]" class="form-control">
                                <small class="form-text text-muted">
                                    Nilai Normal: Teks
                                </small>
                            </div>
                            <div class="col-md-1 col-3">
                                <label for="is_duplo_{{$no_urut}}">Duplo</label>
                                <div class="form-control">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1" id="is_duplo_{{$no_urut}}" name="is_duplo[{{$no_urut}}]">
                                        <label class="custom-control-label" for="is_duplo_{{$no_urut}}">Ya</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <label for="keterangan_{{$no_urut}}">Keterangan</label>
                                <input type="text" id="keterangan_{{$no_urut}}" name="keterangan[{{$no_urut}}]" class="form-control">
                            </div>
                            <div class="col-md-3 col-6">
                                <label for="kesimpulan_{{$no_urut}}">Kesimpulan</label>
                                <input type="text" {{$hasilLab->is_kesimpulan==1?'':'disabled'}} id="kesimpulan_{{$no_urut}}" name="kesimpulan[{{$no_urut}}]" class="form-control">
                            </div>
                        </div>
                    </div>
                    {{-- Jika jenis hasil lab nya angka dan mempunyai nilai normal --}}
                    @elseif($hasilLab->is_nilai_normal==1)
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-3 col-5">
                                <label for="nilai_{{$no_urut}}">{{$hasilLab->nm_hasil}}</label>
                                <input type="number" value="0" step="any" id="nilai_{{$no_urut}}" name="nilai[{{$no_urut}}]" class="form-control">
                                <small class="form-text text-muted">
                                    Nilai Normal: {{nilai_normal($patientTest,$hasilLab['nilaiNormal'])}}
                                </small>
                            </div>
                            <div class="col-md-2 col-4">
                                <label for="satuan_{{$no_urut}}">Satuan</label>
                                <input type="text" class="form-control" id="satuan_{{$no_urut}}" disabled value="{{$hasilLab['nilaiNormal']['satuan']??'-'}}">
                            </div>
                            <div class="col-md-1 col-3">
                                <label for="is_duplo_{{$no_urut}}">Duplo</label>
                                <div class="form-control">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="is_duplo_{{$no_urut}}" class="custom-control-input" value="1" name="is_duplo[{{$no_urut}}]">
                                        <label class="custom-control-label" for="is_duplo_{{$no_urut}}">Ya</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <label for="keterangan_{{$no_urut}}">Keterangan</label>
                                <input type="text" id="keterangan_{{$no_urut}}" name="keterangan[{{$no_urut}}]" class="form-control">
                            </div>
                            <div class="col-md-3 col-6">
                                <label for="kesimpulan_{{$no_urut}}">Kesimpulan</label>
                                <input type="text" {{$hasilLab->is_kesimpulan==1?'':'disabled'}} id="kesimpulan_{{$no_urut}}" name="kesimpulan[{{$no_urut}}]" class="form-control">
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (!$loop->last)
                        <hr class="my-1 mt--3 border-primary">
                    @endif
                @endforeach
            </div>
        @endif
        </div>
    @endforeach
@endif
