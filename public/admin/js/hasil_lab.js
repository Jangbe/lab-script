(function($){
    var status = null;

    $('#hasil-menu').addClass('active');
    $('#pemeriksaan-menu').addClass('active');

    "use_strict";

    var table=$('#hasil_lab_tiper_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
          url: "../../admin/get_hsllab",
          data: function(data){
              data.filter_status = status;
          }
        },
        // orderCellsTop: true,
        fixedHeader: false,
        "columns": [
           {data:"id"},
           {data:"pemeriksaan"},
           {data:"nm_hasil"},
           {data:"level_hasil"},
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

    $('.filter_status').click(function(){
        let info = $(this).val();
        if(info != 2){
            status = info;
        }else{
            status = null;
        }
        table.draw();
    });

})(jQuery);

function is_true(check){
    return check==1?
        '<i class="fa fa-check-double text-success"></i>':
        '<i class="fa fa-times-circle text-danger"></i>';
}
$('#nilai_normal').hide();
$('#nilai_biasa').hide();

$(document).on('click','.detail',function(){
    let id = $(this).data('id');
    $.ajax({
        url: 'hasil_lab/'+id,
        success: function(result){
            $('#detailModalLabel').text('Detail Pemeriksaan Hasil Lab '+result.nm_hasil)
            $('#nm_hasil').text(result.nm_hasil);
            $('#level_hasil').text(result.level_hasil);
            $('#jml_koma').text(result.jml_koma);
            $('#is_kesimpulan').html(is_true(result.is_kesimpulan));
            $('#is_teks').html(is_true(result.is_teks));
            $('#is_judul').html(is_true(result.is_judul));
            $('#is_nilai_normal').html(is_true(result.is_nilai_normal));
            $('#pemeriksaan').text(result.item.nm_item);
            $('#ket_tambahan').text(result.ket_tambahan);
            $('#edit').attr('href', 'hasil_lab/'+result.id+'/edit');
            if(result.is_nilai_normal==1&&!result.is_teks==1&&!result.is_judul==1){
                if(result.nilai_normal&&result.hasil_lab_tiper==null){
                    $('#min_p').text(result.nilai_normal.min_p);
                    $('#max_p').text(result.nilai_normal.max_p);
                    $('#min_w').text(result.nilai_normal.min_w);
                    $('#max_w').text(result.nilai_normal.max_w);
                    $('#min_a').text(result.nilai_normal.min_a);
                    $('#max_a').text(result.nilai_normal.max_a);
                    $('#min_b').text(result.nilai_normal.min_b);
                    $('#max_b').text(result.nilai_normal.max_b);
                    $('#satuan').text(result.nilai_normal.satuan);
                    $('#nilai_normal').show();
                    $('#nilai_biasa').hide();
                }else{
                    $('#nilai_biasa').show();
                    $('#nilai_normal').hide();
                    $('#id_tiper').text(result.hasil_lab_tiper.nm_tiper)
                }
            }
            if(result.is_rumus==1){
                $('#rumus').show();
                $('#ket_rumus').text(result.ket_rumus);
            }else{
                $('#rumus').hide();
            }
            if(result.hasil_lab_tiper){
                $('#tipe_hasil').text(result.hasil_lab_tiper.hasil_lab_tipe.keterangan);
            }else{
                $('#tipe_hasil').text('Angka');
            }
            $('#detailModal').modal('show');
        }
    })
})

$(document).on('click','.edit_tipe',function(){
    var id_tipe = $(this).data('id');
    $.ajax({
        url: "hasil_lab_tiper/"+id_tipe,
        success:function(result){
            $('#id_tipe').val(result.id_tipe);
            $('#nm_tiper').val(result.nm_tiper);
            $('input[name=_method]').val('patch');
            $('#form').attr('action', "hasil_lab_tiper/"+id_tipe);
            $('#hslLabTipeLabel').text('Edit Hasil Lab Tipe Rinci '+result.nm_tiper);
            $('#hslLabTipe').modal('show');
        }
    })
});

$(document).on('click','.delete_item',function(e){
    e.preventDefault();
    var el=$(this);
    swal({
        title: "Apakah kamu yakin ingin menghapus hasil lab ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel"
    }).then(result => {
        if(result.value == true){
            $(el).parent().submit();
        }
    });
});

$('#create').click(function(){
    $('input[name=_method]').val('post');
    $('#id_tipe').val(0);
    $('#nm_tiper').val('');
    $('#form').attr('action', "{{route('hasil_lab_tiper.store')}}");
    $('#hslLabTipeLabel').text('Buat Hasil Lab Tipe Rinci');
    $('#hslLabTipe').modal('show');
});

var is_number=$('#id_tipe').find(':selected').text();
function form_result(){
    let is_nilai_normal = $('#is_nilai_normal')[0].checked;
    let is_teks = $('#is_teks')[0].checked;
    let is_judul = $('#is_judul')[0].checked;
    if((is_number == 'angka' || is_number == 'angka antara')&&(is_nilai_normal&&!is_teks&&!is_judul)){
        $('#form-angka').fadeIn(1000);
        $('#form-teks').fadeOut(1000);
    }else if(is_nilai_normal&&!is_teks&&!is_judul){
        $('#form-angka').fadeOut(1000);
        $('#form-teks').fadeIn(1000);
    }else{
        $('#form-angka').fadeOut(1000);
        $('#form-teks').fadeOut(1000);
    }
}
// form_result();
$('#form-angka').hide();
$('#form-teks').hide();

var is_rumus = false;
function form_keterangan(){
    $('#ket_rumus').attr('disabled', !is_rumus);
}
$('#is_rumus').change(function(){
    is_rumus = $(this)[0].checked;
    form_keterangan();
})

form_keterangan();
