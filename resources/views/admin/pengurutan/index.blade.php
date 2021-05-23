@extends('layouts.app')

@section('content')
    @include('admin.layouts.header', [
        'breadcrumbs'=>['Pengurutan Pemeriksaan','Index'],
        'text_right'=>''
    ])

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="card">

            <div class="card-header border-0">
                <h3 class="mb-0">{{__('Tabel Pengurutan Pemeriksaan')}}</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="hasil_lab_tiper_table">
                    <thead class="thead-light text-center">
                        <tr>
                        <th style="width: 2%">{{__('ID')}}</th>
                        <th>{{__('Pemeriksaan')}}</th>
                        <th style="width: 30%">{{__('Group Pemeriksaan')}}</th>
                        <th>{{__('Jumlah Pemeriksaan')}}</th>
                        <th>{{__('Aksi')}}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
        @include('admin.hasil_lab.modal_detail')
    </div>
@endsection
@push('js')
    <script>
        (function($){
            var status = null;

            $('#hasil-menu').addClass('active').removeClass('collapsed').next().addClass('show');
            $('#pengurutan-menu').addClass('active');

            "use_strict";

            var table=$('#hasil_lab_tiper_table').DataTable( {
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
                {data:"id"},
                {data:"nm_item"},
                {data:"group_name"},
                {data:"jml_pemeriksaan"},
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

    </script>
@endpush
