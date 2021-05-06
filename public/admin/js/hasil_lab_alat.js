(function($){
    var status = null;

    $('#alat-menu').addClass('active');
    $('#setting-hasil-menu').addClass('active');

    "use_strict";

    var table=$('#hasil_lab_tipe_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
          url: "",
          data: function(data){
              data.filter_status = status;
          }
        },
        // orderCellsTop: true,
        fixedHeader: false,
        "columns": [
        //    {data:"id"},
           {data:"nm_hasil"},
           {data:"parameter_alat"},
           {data:"nilai_pembagi"},
           {data:"nilai_pengali"},
           {data:"jumlah_koma"},
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
