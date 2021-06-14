(function($){

    "use strict";

    //active
    $('#user-role').addClass('active').removeClass('collapsed').next().addClass('show');
    $('#user-menu').addClass('active');

    var ajax_url='../../../ajax/';

    //datatable
    var table=$('#reports_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bSort" : false,
          "ajax": {
              url:"../../admin/get_users"
          },
          // orderCellsTop: true,
          fixedHeader: true,
          "columns": [
              {data:"id"},
              {data:"name"},
              {data:"email"},
              {data:"roles"},
              {data:"action",sortable:false,searchable:false,orderable:false}
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

    //prepare edit user page
    var user_roles=$('#user_roles').val();

    if(user_roles!=null)
    {
        var user_roles= JSON.parse(user_roles);
        var roles=[];
        console.log('yes');
        user_roles.forEach(function(role){
            roles.push(parseInt(role.role_id));
        });
        console.log(roles);

        $('#roles_assign').val(roles).trigger('change');
    }

    // $('.select2').select2();


    //delete user
    $(document).on('click','.delete_user',function(e){
        e.preventDefault();
        var el=$(this);
        swal({
            title: ("Are you sure to delete user ?"),
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: ("Delete"),
            cancelButtonText: ("Cancel"),
            closeOnConfirm: false
        }).then(result=>{
            if(result.value===true){
                $(el).parent().submit();
            }
        });
    });

})(jQuery);
