(function($){
    var status = null;

    $('#hasil-menu').addClass('active');
    $('#tipe-hasil-menu').addClass('active');

    "use_strict";

    var table=$('#hasil_lab_tipe_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
          url: "../../admin/get_hsllab_tipe",
          data: function(data){
              data.filter_status = status;
          }
        },
        // orderCellsTop: true,
        fixedHeader: false,
        "columns": [
           {data:"id"},
           {data:"keterangan"},
           {data:"is_number"},
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
