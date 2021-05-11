@if (!$patient_tests->isEmpty())
    <input type="hidden" name="no_pendaftaran" value="{{$patientTest->no_pendaftaran}}">
    @php
        $i=0;
    @endphp
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
                    @if ($hasilLab->is_judul!=1)
                    <input type="hidden" name="id_hasil_lab[{{$i}}]" value="{{$hasilLab->id}}" readonly>
                    @endif
                    {{-- Jika jenis hasil lab nya judul --}}
                    @if ($hasilLab->is_judul==1)
                        <h4>{{$hasilLab->nm_hasil}}</h4>
                    {{-- Jika jenis hasil lab nya berupa select options --}}
                    @elseif (!is_null($hasilLab['id_tiper']))
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-5">
                                <label for="id_tiper_{{$i}}">{{$hasilLab->nm_hasil}}</label>
                                <select name="id_tiper[{{$i}}]" id="id_tiper_{{$i}}" class="custom-select">
                                    @foreach ($hasilLab['hasilLabTiper']['hasilLabTipe']['hasilLabTiper'] as $opt)
                                    <option value="{{$opt['id']}}">{{$opt['nm_tiper']}}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">
                                    Nilai Normal: {{$hasilLab['hasilLabTiper']['nm_tiper']}}
                                </small>
                            </div>
                            <div class="col-1">
                                <label for="is_duplo_{{$i}}">Duplo</label>
                                <div class="form-control">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1" id="is_duplo_{{$i}}" name="is_duplo[{{$i}}]">
                                        <label class="custom-control-label" for="is_duplo_{{$i}}">Ya</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="keterangan_{{$i}}">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan_{{$i}}" name="keterangan[{{$i}}]">
                            </div>
                            <div class="col-3">
                                <label for="kesimpulan_{{$i}}">Kesimpulan</label>
                                <input type="text" {{$hasilLab->is_kesimpulan==1?'':'disabled'}} name="kesimpulan[{{$i}}]" class="form-control">
                            </div>
                        </div>
                    </div>
                    {{-- Jika jenis hasil lab nya teks --}}
                    @elseif($hasilLab->is_teks==1)
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-5">
                                <label for="hasil_teks_{{$i}}">{{$hasilLab->nm_hasil}}</label>
                                <input type="text" id="hasil_teks_{{$i}}" name="hasil_teks[{{$i}}]" class="form-control">
                                <small class="form-text text-muted">
                                    Nilai Normal: Teks
                                </small>
                            </div>
                            <div class="col-1">
                                <label for="is_duplo_{{$i}}">Duplo</label>
                                <div class="form-control">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1" id="is_duplo_{{$i}}" name="is_duplo[{{$i}}]">
                                        <label class="custom-control-label" for="is_duplo_{{$i}}">Ya</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="keterangan_{{$i}}">Keterangan</label>
                                <input type="text" id="keterangan_{{$i}}" name="keterangan[{{$i}}]" class="form-control">
                            </div>
                            <div class="col-3">
                                <label for="kesimpulan_{{$i}}">Kesimpulan</label>
                                <input type="text" {{$hasilLab->is_kesimpulan==1?'':'disabled'}} id="kesimpulan_{{$i}}" name="kesimpulan[{{$i}}]" class="form-control">
                            </div>
                        </div>
                    </div>
                    {{-- Jika jenis hasil lab nya angka dan mempunyai nilai normal --}}
                    @elseif($hasilLab->is_nilai_normal==1)
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-3">
                                <label for="nilai_{{$i}}">{{$hasilLab->nm_hasil}}</label>
                                <input type="number" value="0" id="nilai_{{$i}}" name="nilai[{{$i}}]" class="form-control">
                                <small class="form-text text-muted">
                                    Nilai Normal: {{nilai_normal($patientTest,$hasilLab['nilaiNormal'])}}
                                </small>
                            </div>
                            <div class="col-2">
                                <label for="satuan_{{$i}}">Satuan</label>
                                <input type="text" class="form-control" id="satuan_{{$i}}" disabled value="{{$hasilLab['nilaiNormal']['satuan']}}">
                            </div>
                            <div class="col-1">
                                <label for="is_duplo_{{$i}}">Duplo</label>
                                <div class="form-control">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="is_duplo_{{$i}}" class="custom-control-input" value="1" name="is_duplo[{{$i}}]">
                                        <label class="custom-control-label" for="is_duplo_{{$i}}">Ya</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="keterangan_{{$i}}">Keterangan</label>
                                <input type="text" id="keterangan_{{$i}}" name="keterangan[{{$i}}]" class="form-control">
                            </div>
                            <div class="col-3">
                                <label for="kesimpulan_{{$i}}">Kesimpulan</label>
                                <input type="text" {{$hasilLab->is_kesimpulan==1?'':'disabled'}} id="kesimpulan_{{$i}}" name="kesimpulan[{{$i}}]" class="form-control">
                            </div>
                        </div>
                    </div>
                    @endif
                    @php
                        $i++;
                    @endphp
                @endforeach
            </div>
        @endif
        </div>
    @endforeach
@endif
