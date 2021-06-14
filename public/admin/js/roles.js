
(function($){

    "use strict";

    //active
    $('#user-role').addClass('active').removeClass('collapsed').next().addClass('show');
    $('#hak-akses').addClass('active');

    //intialize select2 for permissions
    $('.select2').select2();

    //roles datatable
    var table=$('#roles_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bSort" : false,
        "ajax": {
            url: "../../admin/get_roles"
        },
        // orderCellsTop: true,
        fixedHeader: true,
        "columns": [
            {data:'id'},
            {data:'name'},
            {data:"action",searchable:false,sortable:false,orderable:false},
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



    //delete role
    $(document).on('click','.delete_role',function(e){
        e.preventDefault();
        var el=$(this);
        swal({
            title: ("Are you sure to delete role ?"),
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: ("btn-danger"),
            confirmButtonText: ("Delete"),
            cancelButtonText: ("Cancel")
        }).then(result=>{
            if(result.value == true){
                $(el).parent().submit();
            }
        });
    });

    $('.select_all_modules').on('click',function(){
        $('input[type=checkbox]').prop('checked',true);
    });

    $('.deselect_all_modules').on('click',function(){
        $('input[type=checkbox]').prop('checked',false);
    });

    $('.select_module').on('click',function(){
        $(this).parent().next('.card-body').find('input[type=checkbox]').prop('checked',true);
    });

    $('.deselect_module').on('click',function(){
        $(this).parent().next('.card-body').find('input[type=checkbox]').prop('checked',false);
    });

})(jQuery);


