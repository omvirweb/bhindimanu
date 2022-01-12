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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                Job Card List
                <?php $isAdd = $this->app_model->have_access_role(JOB_CARD_ENTRY_MODULE_ID, "add"); ?>
                <?php if($isAdd) { ?>
                    <a href="<?= base_url('job_card/add') ?>" class="btn btn-primary btn-sm float-right" style="margin: 5px;">Add Job Card</a>
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for=""> Job Card No</label>
                                    <input type="text" name="" id="job_card_no" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2" style="display: none;">
                                <label>Party</label>
                                <select name="party_id" id="party_id" class="form-control"></select>
                            </div>
                            <div class="col-md-1">
                                <a href="javascript:void(0)" id="btn_search" class="btn btn-primary btn-sm search_btn pull-left d-none" style="margin-top: 33px;">Search</a>
                            </div>
                            <div class="col-md-12">
                                <table id="job_card_table" class="table table-bordered table-striped" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Job Card No</th>
                                            <th>Party</th>
                                            <th>Melting</th>
                                            <th>Order Date</th>
                                            <th>Delivery Date</th>
                                            <th>Labor</th>
                                            <th>Total Reference</th>
                                            <th>Total Costing Fine</th>
                                            <th>Total Costing Amount</th>
                                            <th>Profit/Loss Fine</th>
                                            <th>Profit/Loss Amount</th>
                                            <th>Remark</th>
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
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<div class="modal fade" id="job_card_itemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Job Card Items</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="job_card_item_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th id="sr_no">Sr. No</th>
                                    <th>Item</th>
                                    <th>Design No</th>
                                    <th>Qty</th>
                                    <th>Total Qty</th>
                                    <th>Weight</th>
                                    <th>Total Weight</th>
                                    <th>Remark</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="clicked_job_card_id">
<div id="viewImageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 99999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body edit-content text-center">
                <img id="doc_img_src" alt="No Image Found" class="img-responsive" width='300px'>
                </div>
        </div>
    </div>
</div>
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
        var job_card_table = $('#job_card_table').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                text: 'Export to Excel',
                title: function () { return ('Job_Card_List_<?php echo date("Y_m_d_H_i_s"); ?>') },
                action: newExportAction,
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                },
            }],
            "serverSide": true,
            "ordering": true,
            "scrollY": '480px',
            "scrollX": true,
            "searching": true,
            "aaSorting": [[1, 'desc']],
            "scroller": {
                loadingIndicator: true
            },
            "ajax": {
                    "url": "<?php echo site_url('job_card/job_card_datatable') ?>",
                "type": "POST",
                "data": function (d) {
                    d.from_date = $("#from_date").val();
                    d.to_date = $("#to_date").val();
                    d.job_card_no = $("#job_card_no").val();
                    d.party_id = $("#party_id").val();
                },
            },
            "columnDefs": [{
                    "className": "text-right",
                    "targets": [1,3,6,7,8,9,10,11]
            },{
                    "className": "text-nowrap",
                    "targets": [0,4,5]
            }],
        });
        $(document).on('click','#btn_search',function(){
            job_card_table.draw();
        });

        $(document).on('change','#from_date, #to_date',function(){
            job_card_table.draw();
        });
        $(document).on('keyup','#job_card_no',function(){
            job_card_table.draw();
        });

        job_card_item_table = $('#job_card_item_table').DataTable({
            serverSide: true,
            "scrollY": "300px",
            "sScrollX": "100%",
            "sScrollXInner": "100%",
            "search": true,
            paging: false,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('job_card/job_card_items_datatable') ?>",
                "type": "POST",
                "data": function (d) {
                    d.job_card_id = $('#clicked_job_card_id').val();
                },
            },
            "columnDefs": [{
                    "className": "text-right",
                    "targets": [0,3,4,5,6]
            }]
        });

        $(document).on('click', '.view_job_card_items', function () {
            $('#clicked_job_card_id').val($(this).attr('data-id'));
            job_card_item_table.draw();
            $('#job_card_itemModal').modal('show');
            setTimeout(function () {
                $('#sr_no').click();
            }, 200);
        });

        $(document).on('click', '.item_photo_modal', function () {
            var src = $(this).data("img_src");
            setTimeout(function () {
                $("#doc_img_src").attr('src', src);
            }, 0);
            $('#viewImageModal').modal('show');
        });

        $(document).on("click",".delete_button",function(){
            if(confirm('Are you sure delete this records?')){
                $.ajax({
                    url: $(this).data('href'),
                    type: "POST",
                    data: '',
                    success: function (response) {
                        var json = $.parseJSON(response);
                        if (json['error'] == 'Error') {
                            show_notify('You cannot delete this Job Card. This Job Card has been used.', false);
                        } else if (json['success'] == 'Deleted') {
                            job_card_table.draw();
                            show_notify('Job Card Deleted Successfully!', true);
                        }
                    }
                });
            }
        });
    });
</script>
<?php
    $this->load->view('footer');
?>