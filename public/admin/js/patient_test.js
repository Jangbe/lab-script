(function($){
    $('#pasien_test').addClass('active');

    "use_strict";

    var table=$('#patients_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
          url: "",
        },
        // orderCellsTop: true,
        fixedHeader: false,
        "columns": [
           {data:"no_pendaftaran"},
           {data:"nama"},
           {data:"no_identitas"},
           {data:"no_telepon"},
           {data:"action",searchable:false,orderable:false,sortable:false}//action
        ],
        "language": {
           "sEmptyTable":     ("No data available in table"),
           "sInfo":           ("Showing")+" _START_ "+("to")+" _END_ "+("of")+" _TOTAL_ "+("records"),
           "sInfoEmpty":      ("Showing")+" 0 "+("to")+" 0 "+("of")+" 0 "+("records"),
           "sInfoFiltered":   "("+("filtered")+" "+("from")+" _MAX_ "+("total")+" "+("records")+")",
           "sInfoPostFix":    "",
           "sInfoThousands":  ",",
           "sLengthMenu":     ("Show")+" _MENU_ "+("records"),
           "sLoadingRecords": ("Loading..."),
           "sProcessing":     ("Processing..."),
           "sSearch":         ("Search")+":",
           "sZeroRecords":    ("No matching records found"),
           "oPaginate": {
               "sFirst":    ("First"),
               "sLast":     ("Last"),
               "sNext":     ("<i class='ni ni-bold-right'></i>"),
               "sPrevious": ("<i class='ni ni-bold-left'></i>")
           },
        }
     });

})(jQuery);

$('#tanggal_lahir').change(function(e){
    let tanggal=$(this).val();
    tanggal = new Date(tanggal);
    $('#umur').val(calculate_age(tanggal)+' tahun');
})

function calculate_age(dob) {
    var diff_ms = Date.now() - dob.getTime();
    var age_dt = new Date(diff_ms);

    return Math.abs(age_dt.getUTCFullYear() - 1970);
}

function autotab(current,to, max,e){
    if (current[0].value.length>=max) {
        current[0].value = current[0].value.slice(0,max);
        to.focus();
    }
}


// Input rt rw kodepos
$("#rt").keyup(function (e) {
    autotab($(this), $('#rw'),3,e);
});
$("#rw").keyup(function (e) {
    autotab($(this), $('#kodepos'),3,e);
});
$("#kodepos").keyup(function (e) {
    autotab($(this), $('#kd_provinsi'),6,e);
});

$('.kota').hide();
$('.kecamatan').hide();
$('.kelurahan').hide();

async function ajax_wilayah(id, kode, api, next, loader = true){
    if(loader) $('.preloader').fadeIn();
    $('#'+id).empty();
    $('#'+id).append(`<option value="0"></option>`);
    if(kode!=0){
        $('.'+next).fadeIn(1000);
        await fetch(`http://www.emsifa.com/api-wilayah-indonesia/api/${api}/${kode}.json`)
            .then(response => response.json())
            .then(results => {
                results.forEach(result=>{
                    $('#'+id).append(`<option value="${result.id}">${result.name}</option>`);
                })
        }).catch(function(e){
            console.log(e);
        });
        if(loader) $('.preloader').fadeOut();
    }else{
        if(loader) $('.preloader').fadeOut();
        $('.'+next).fadeOut(1000);
        $('#'+id).val(0);
    }
}

// Pemilihan wilayah
fetch(`http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json`)
.then(response => response.json())
.then(provinces => {
    $('#kd_provinsi').empty();
    $('#kd_provinsi').append(`<option value="0"></option>`);
    provinces.forEach((province) => {
        $('#kd_provinsi').append(`<option value="${province.id}">${province.name}</option>`);
    });
});

$('#kd_provinsi').change(function(){
    let kd_provinsi = $(this).val();
    ajax_wilayah('kd_kota',kd_provinsi,'regencies','kota');
});

$('#kd_kota').change(function(){
    let kd_kota = $(this).val();
    ajax_wilayah('kd_kecamatan',kd_kota,'districts','kecamatan');
});

$('#kd_kecamatan').change(function(){
    let kd_kecamatan = $(this).val();
    ajax_wilayah('kd_kelurahan',kd_kecamatan,'villages','kelurahan');
});

// Search no_rm and name
function set_form_patient(id){
    $('.preloader').fadeIn();
    $.ajax({
        url: "../patient/"+id,
        success: async function(result){
            await ajax_wilayah('kd_kota',result.kd_provinsi,'regencies','kota', false);

            await ajax_wilayah('kd_kecamatan',result.kd_kota,'districts','kecamatan', false);

            await ajax_wilayah('kd_kelurahan',result.kd_kecamatan,'villages','kelurahan', false);

            let rrk = result.rt_rw_kodepos!=null?result.rt_rw_kodepos.split('-'):['','',''];
            $('#rt').val(rrk[0]);
            $('#rw').val(rrk[1]);
            $('#kodepos').val(rrk[2]);

            $('#'+result.jenis_kelamin).attr('checked', true);

            $('#umur').val(calculate_age(new Date(result.tanggal_lahir))+' tahun');

            for(i in result){
                $('#'+i).val(result[i]);
            }

            $('#s_no_rm').val(id);
            $('#s_nama').val(id);
            $('#select2-s_no_rm-container').text(result.noreg);
            $('#select2-s_nama-container').text(result.nama);

            $('#noreg').attr('disabled',true);

            $('.preloader').fadeOut();
        }
    })
}

var no_id=1;

function set_form_test(id,url='../'){
    $('.list-pemeriksaan').append(`<div class="form-group">
        <div class="form-row mt--4">
            <div class="col-6 col-md-3">
                <label for=_item_${no_id}">Layanan / Pemeriksaan</label>
                <select name="id_item[${no_id}]" id="id_item_${no_id}" class="custom-select item">
                    <option value=""></option>
                </select>
            </div>
            <div class="col-6 col-md-3">
                <label for="id_pelaksana_${no_id}">Pelaksana</label>
                <select name="id_pelaksana[${no_id}]" id="id_pelaksana_${no_id}" class="custom-select pelaksana">
                    <option value=""></option>
                </select>
            </div>
            <div class="col-4 col-md-2">
                <label for="no_alat_${no_id}">No Alat</label>
                <input type="text" name="no_alat[${no_id}]" id="no_alat_${no_id}" class="form-control">
            </div>
            <div class="col-3 col-md-1">
                <label for="">Non Jmn</label>
                <div class="form-control">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="non_jaminan_${no_id}" value="1" name="non_jaminan[${no_id}]">
                        <label class="custom-control-label" for="non_jaminan_${no_id}">Ya</label>
                    </div>
                </div>

            </div>
            <div class="col-3 col-md-2">
                <label for="harga_${no_id}">Harga</label>
                <input type="text" name="harga[${no_id}]" value="0" readonly class="form-control harga_total" id="harga_${no_id}">
            </div>
            <div class="col-1">
                <label>Hapus</label>
                <button type="button" class="btn btn-danger delete-test"><i class="fas fa-trash"></i></button>
            </div>
        </div>
        <hr class="mt-3">
    </div>`);
    $('.total').show();
    // Untuk pemilihan test
    $.ajax({
        url: url+'get_items',
        async: false,
        success: function({data}){
            data.forEach(v=>{
                $('#id_item_'+no_id).append(`<option value="${v.id}">${v.nm_item}</option>`)
            })
        }
    })

    // Untuk pemilihan pelaksana
    $.ajax({
        url: url+'get_executors',
        async: false,
        success: function({data}){
            data.forEach(v=>{
                if(v.pelaksana==1){$('#id_pelaksana_'+no_id).append(`<option value="${v.id}">${v.nama}</option>`)};
            })
        }
    })
    no_id++;
}

function set_executors(url){
    $.ajax({
        url: url+'get_executors',
        async: false,
        success: function({data}){
            $('#id_penanggung_jawab').append('<option></option>');
            $('#id_pengirim').append('<option></option>');
            data.forEach(v=>{
                if(v.pjawab==1){$('#id_penanggung_jawab').append(`<option value="${v.id}">${v.nama}</option>`)};
                if(v.pengirim==1){$('#id_pengirim').append(`<option value="${v.id}">${v.nama}</option>`)};
            })
        }
    })
}

$('.total').hide();

$(document).on('click','.delete-test',function(){
    $(this).parent().parent().parent().remove();
    let id = $('.list-pemeriksaan').children().length + 1;
    if(id<=1){
        $('.total').hide();
    }
    let total_harga = $('.harga_total');
    let tot=0;
    total_harga.each((k,v)=>{
        tot+=parseInt(v.value);
    })
    $('#subtotal').val(tot);
})
