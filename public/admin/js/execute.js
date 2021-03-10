(function($){
    $('#pelaksana').addClass('active');

    "use_strict";

    var table=$('#executors_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
          url: "../../admin/get_executors",
        },
        // orderCellsTop: true,
        fixedHeader: false,
        "columns": [
           {data:"no"},
           {data:"kode"},
           {data:"nama"},
           {data:"nip"},
           {data:"telp"},
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
