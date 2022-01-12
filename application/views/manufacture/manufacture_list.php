<?php
    $ExternalCss = array(
        base_url('assets/plugins/datatables/media/css/jquery.dataTables.min.css'),
        base_url('assets/plugins/datatables/extensions/Scroller/css/scroller.dataTables.min.css'),
        base_url('assets/plugins/datatables/extensions/FixedColumns/css/fixedColumns.dataTables.min.css'),
        base_url('assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css'),
        base_url('assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css'),
        base_url('assets/plugins/datatables/extensions/Select/css/select.dataTables.min.css'),
    );

    $ExternalJs = array(
        base_url('assets/plugins/datatables/media/js/jquery.dataTables.min.js'),
        base_url('assets/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js'),
        base_url('assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js'),
        base_url('assets/plugins/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.min.js'),
        base_url('assets/plugins/datatables/extensions/Buttons/js/buttons.flash.min.js'),
        base_url('assets/plugins/datatables/extensions/Buttons/js/buttons.html5.min.js'),
        base_url('assets/plugins/datatables/extensions/Buttons/js/buttons.print.min.js'),
        base_url('assets/plugins/datatables/extensions/Buttons/js/buttons.colVis.min.js'),
        base_url('assets/plugins/datatables/extensions/Buttons/js/jszip.min.js'),
        base_url('assets/plugins/datatables/extensions/Buttons/js/pdfmake.min.js'),
        base_url('assets/plugins/datatables/extensions/Buttons/js/vfs_fonts.js'),
        base_url('assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js'),
        base_url('assets/plugins/datatables/extensions/Select/js/dataTables.select.min.js'),
    );
    $this->load->view('header');
?>
<style>
    .dataTables_filter {
    float: right !important;
}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                Manufacture: Issue/Receive
                <?php $isAdd = $this->app_model->have_access_role(MANUFACTURE_MODULE_ID, "add"); ?>
                <?php if($isAdd) { ?>
                    <a href="<?= base_url('manufacture/add') ?>" class="btn btn-primary btn-sm float-right" style="margin: 5px;">Add Manufacture</a>
                <?php } ?>
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-1 pr-0">
                                <div class="form-group">
                                    <label for=""> From Date</label>
                                    <input type="text" name="" id="from_date" class="form-control input-datepicker" value="">
                                </div>
                            </div>
                            <div class="col-md-1 pr-0">
                                <div class="form-group">
                                    <label for=""> To Date</label>
                                    <input type="text" name="" id="to_date" class="form-control input-datepicker" value="">
                                </div>
                            </div>
                            <div class="col-md-2 pr-0">
                                <div class="form-group">
                                    <label for=""> Job Card No</label>
                                    <input type="text" name="" id="job_card_no" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2 pr-0">
                                <div class="form-group">
                                    <label for=""> Party</label>
                                    <select name="" id="party_id" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1 pr-0">
                                <div class="form-group">
                                    <label for=""> Touch</label>
                                    <input type="text" name="" id="touch" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2 pr-0">
                                <div class="form-group">
                                    <label for="Party"> Process</label>
                                    <select name="process_id" id="process_id" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-md-2 pr-0">
                                <div class="form-group">
                                    <label for=""> Calculated Loss</label>
                                    <select name="" id="close_to_calculate_loss" class="form-control">
                                        <option value="">All</option>
                                        <option value="1">Open</option>
                                        <option value="2">Close</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <a href="javascript:void(0)" id="btn_search" class="btn btn-primary btn-sm search_btn pull-left d-none" style="margin-top: 33px;">Search</a>
                            </div>
                            <div class="col-md-12">
                                <div class="clearfix"></div>
                                <div class="box-body">
                                    <table class="table row-border table-bordered table-striped" style="width:100%" id="manufacture_table">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Job Card No</th>
                                                <th>Party</th>
                                                <th>Touch</th>
                                                <th>Order Date</th>
                                                <th>Process</th>
                                                <th>Calculate Loss</th>
                                                <th>Bal. Weight</th>
                                                <th>Loss</th>
                                                <th>Bal. Fine</th>
                                                <th>Bal. Pcs</th>
                                                <th>Bal. Alloy</th>
                                                <th>Difference</th>
                                                <th>Costing</th>
                                                <th>Costing Per</th>
                                                <th>Labor</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Total</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<div class="modal fade" id="manufacture_ir_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Manufacture <span class="label_issue_receive"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table  id="manufacture_ir_table" class="table custom-table item-table">
                            <thead>
                                <tr>
                                    <th class="text-nowrap" id="action">Date</th>
                                    <th class="text-right">Weight</th>
                                    <th class="text-right">Pcs</th>
                                    <th>Item</th>
                                    <th>Person</th>
                                    <th>Remark</th>
                                    <th class="text-right">Ad Weight</th>
                                    <th class="text-right">Ad Pcs</th>
                                    <th class="">Type</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="clicked_manufacture_id" value="0">
<input type="hidden" id="clicked_issue_receive" value="0">
<script type="text/javascript">
    var oldExportAction = function (self, e, dt, button, config) {
        if (button[0].className.indexOf('buttons-copy') >= 0) {
            $.fn.dataTable.ext.buttons.copyHtml5.action(e, dt, button, config);
        } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
            $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
        } else if (button[0].className.indexOf('buttons-csv') >= 0) {
            $.fn.dataTable.ext.buttons.csvHtml5.action(e, dt, button, config);
        } else if (button[0].className.indexOf('buttons-excel') >= 0) {
            if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
            }
            else {
                $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
            }
        } else if (button[0].className.indexOf('buttons-print') >= 0) {
            $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
        }
    };

    var newExportAction = function (e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;
//            $(".box-body").addClass('overlay clearfix');
//            $(".box-body").append('<i class="fa fa-refresh fa-spin"></i>');
        $('#ajax-loader').show();
        dt.one('preXhr', function (e, s, data) {
            // Just this once, load all data from the server...
            data.start = 0;
            data.length = 2147483647;

            dt.one('preDraw', function (e, settings) {
                // Call the original action function
                oldExportAction(self, e, dt, button, config);

                dt.one('preXhr', function (e, s, data) {
                    // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                    // Set the property to what it was before exporting.
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });

                // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                setTimeout(dt.ajax.reload, 0);
//
//                    $(".box-body").removeClass('overlay');
//                    $(".box-body i.fa.fa-refresh.fa-spin").remove();
                $('#ajax-loader').hide();
                // Prevent rendering of the full data to the DOM
                return false;
            });
        });

        // Requery the server with the new one-time export settings
        dt.ajax.reload();
    };

    $(document).ready(function(){
        initAjaxSelect2($("#party_id"), "<?= base_url('app/party_select2_source') ?>");
        initAjaxSelect2($("#process_id"), "<?= base_url('app/process_select2_source') ?>");

        var manufacture_table = $('#manufacture_table').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdf',
                download: 'open',
                text: 'Export to PDF',
                orientation: 'landscape',
                title: function () { return ('Manufactures_<?php echo date("Y_m_d_H_i_s"); ?>') },
                header: true,
                footer: true,
                action: newExportAction,
                customize: function(doc) {
                    var objLayout = {};
                    objLayout['hLineWidth'] = function(i) { return .5; };
                    objLayout['vLineWidth'] = function(i) { return .5; };
                    doc.content[1].layout = objLayout;
                    doc.defaultStyle.fontSize = 10;
                },
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
                },
            }],
            "serverSide": true,
            "ordering": false,
            "scrollY": '480px',
            "scrollX": true,
            "searching": false,
            "aaSorting": [[0, 'desc']],
            "scroller": {
                loadingIndicator: true
            },
            "ajax": {
                "url": "<?php echo site_url('manufacture/manufacture_datatable') ?>",
                "type": "POST",
                "data": function (d) {
                    d.from_date = $("#from_date").val();
                    d.to_date = $("#to_date").val();
                    d.job_card_no = $("#job_card_no").val();
                    d.party_id = $("#party_id").val();
                    d.touch = $("#touch").val();
                    d.process_id = $("#process_id").val();
                    d.close_to_calculate_loss = $("#close_to_calculate_loss").val();
                },
            },
            "columnDefs": [
            {
                "className": "text-right",
                "targets": [1,3,7,8,9,10,11,12,13,14,15],
            },{
                "className": "text-nowrap",
                "targets": [0,4],
            }],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };

                var bal_net_weight = api
                        .column(7)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                $(api.column(7).footer()).html(bal_net_weight.toFixed(3));

                var bal_fine = api
                        .column(8)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                $(api.column(8).footer()).html(bal_fine.toFixed(3));

                var bal_pcs = api
                        .column(9)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                $(api.column(9).footer()).html(bal_pcs.toFixed(3));

                var bal_alloy = api
                        .column(10)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                $(api.column(10).footer()).html(bal_alloy.toFixed(3));

                var bal_loss = api
                        .column(11)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                $(api.column(11).footer()).html(bal_loss.toFixed(3));

                var costing = api
                        .column(12)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                $(api.column(12).footer()).html(costing.toFixed(3));
                
                var costing_per = api
                        .column(13)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                $(api.column(13).footer()).html(costing_per.toFixed(3));
                
                var labor = api
                        .column(14)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                $(api.column(14).footer()).html(labor.toFixed(3));

                var bal_weight = api
                        .column(15)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                $(api.column(15).footer()).html(bal_weight.toFixed(3));
            }
        });
        $(document).on('click','#btn_search',function(){
            manufacture_table.draw();
        });

        $(document).on('change','#from_date, #to_date, #party_id, #process_id, #close_to_calculate_loss',function(){
            manufacture_table.draw();
        });
        $(document).on('keyup','#job_card_no, #touch',function(){
            manufacture_table.draw();
        });

        manufacture_ir_table = $('#manufacture_ir_table').DataTable({
            serverSide: true,
            "scrollY": "300px",
            "sScrollX": "100%",
            "sScrollXInner": "100%",
            "search": true,
            paging: false,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('manufacture/manufacture_ir_datatable') ?>",
                "type": "POST",
                "data": function (d) {
                    d.manufacture_id = $('#clicked_manufacture_id').val();
                    d.issue_receive = $('#clicked_issue_receive').val();
                },
            },
            "columnDefs": [{
                "className": "text-nowrap",
                "targets": [0],
            },
            {
                "className": "text-right",
                "targets": [1,2,6,7],
            }]
        });

        $(document).on('click', '.view_manufacture_ir', function () {
            $('#clicked_manufacture_id').val($(this).attr('data-id'));
            $('#clicked_issue_receive').val($(this).attr('data-issue_receive'));
            if($(this).attr('data-issue_receive') == 1) {
                $(".label_issue_receive").text('Issue');
            } else {
                $(".label_issue_receive").text('Receive');
            }
            manufacture_ir_table.search('').draw();
            $('#manufacture_ir_modal').modal('show');
            setTimeout(function () {
                $('#action').click();
            }, 200);
        });

        $(document).on("click",".delete_button",function(){
            var value = confirm('Are you sure delete this records?');
            var tr = $(this).closest("tr");
            if(value){
                $.ajax({
                    url: $(this).data('href'),
                    type: "POST",
                    data: '',
                    dataType: 'json',
                    success: function(response){
                        manufacture_table.draw();
                        toastr.success('Manufacture Deleted Successfully!');                        
                    }
                });
            }
        });
    });
</script>
<?php
    $this->load->view('footer');
?>