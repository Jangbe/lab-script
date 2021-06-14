(function($){
    $('#pasien').addClass('active');

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
           {data:"id"},
           {data:"noreg"},
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
    tanggal=new Date(tanggal);
    $('#umur').val(calculate_age(tanggal)+' tahun');
})

$.ajax({
    url: "/admin/perusahaan",
    success: function({data}){
        $('#id_perusahaan').empty().append('<option></option>');
        data.forEach(v=>{
            $('#id_perusahaan').append(`<option value="${v.id}">${v.company_name}</option>`);
        })
    }
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
$("#rt").keyup(function () {
    autotab($(this), $('#rw'),3);
});
$("#rw").keyup(function () {
    autotab($(this), $('#kodepos'),3);
});
$("#kodepos").keyup(function () {
    autotab($(this), $('#kd_provinsi'),5);
});
function focusout(node,max){
    let value = '00000'+node.val();
    value = value.substr(value.length-max,max)
    node.val(value);
}
$("#rt").focusout(function () {
    focusout($(this),3)
});
$("#rw").focusout(function () {
    focusout($(this),3)
});
$("#kodepos").focusout(function () {
    focusout($(this),5)
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
