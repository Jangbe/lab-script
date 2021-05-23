<div class="card mt-3">
    <div class="card-header">
        <div id="showTime"></div>
        {{__('Informasi Pasien')}}
        <a class="close" data-toggle="collapse" href="#formPengurutan" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="ni ni-bold-down"></i>
            <i class="ni ni-bold-right d-none"></i>
        </a>
    </div>
    <div class="card-body collapse show" id="formPengurutan">
        @foreach ($pengurutan->hasilLab->sortBy('no_urut') as $i => $hasilLab)
            <div class="form-group {{$hasilLab->level_hasil==1?'':'ml-3'}}" id="no_{{$hasilLab->no_urut}}">
                <div class="form-row">
                    <div class="col-5 col-md-9">
                        <input type="hidden" name="id[]" value="{{$hasilLab->id}}">
                        <label for="{{$i.'-'.$hasilLab->id}}">Nama Pemeriksaan</label>
                        <input type="text" class="form-control" readonly value="{{$hasilLab->nm_hasil}}">
                    </div>
                    <div class="col-md-2 col-4">
                        <label for="">Level</label>
                        <input type="text" class="form-control" readonly value="{{$hasilLab->level_hasil==1?'Pemeriksaan':'Sub Pemeriksaan'}}">
                    </div>
                    <div class="col-3 col-md-1">
                        <label for="{{$i.'-'.$hasilLab->id}}">No Urut</label>
                        <select name="no_urut[]" data-old="{{$hasilLab->no_urut}}" class="custom-select no_urut">
                            @for ($i = 1; $i <= count($pengurutan->hasilLab); $i++)
                                <option value="{{$i}}" {{$i==$hasilLab->no_urut?'selected':''}}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
