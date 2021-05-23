(function($){
    var status = null;

    $('#hasil-menu').addClass('active').removeClass('collapsed').next().addClass('show');
    $('#rincian-hasil-menu').addClass('active');

    "use_strict";

    var table=$('#hasil_lab_tiper_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
          url: "../../admin/get_hsllab_tiper",
          data: function(data){
              data.filter_status = status;
          }
        },
        // orderCellsTop: true,
        fixedHeader: false,
        "columns": [
           {data:"id"},
           {data:"keterangan"},
           {data:"nm_tiper"},
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
        title: "Apakah kamu yakin ingin menghapus hasil lab tipe ini?",
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
    $('#form').attr('action', "hasil_lab_tiper/");
    $('#hslLabTipeLabel').text('Buat Hasil Lab Tipe Rinci');
    $('#hslLabTipe').modal('show');
});
