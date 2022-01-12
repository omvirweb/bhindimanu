<?php
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
                Ad Pcs Report
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for=""> From Date</label>
                                    <input type="text" name="" id="from_date" class="form-control input-datepicker" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for=""> To Date</label>
                                    <input type="text" name="" id="to_date" class="form-control input-datepicker" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for=""> Person</label>
                                    <select name="" id="job_worker_id" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <a href="javascript:void(0)" id="btn_search" class="btn btn-primary btn-sm search_btn pull-left" style="margin-top: 33px;">Search</a>
                            </div>
                            <div class="col-md-12">
                                <table id="ad_pcs_report" class="table table-bordered table-striped" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Person</th>
                                            <th>Receive Ad Pcs</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total</th>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">

    $(document).ready(function(){
        initAjaxSelect2($("#job_worker_id"), "<?= base_url('app/job_worker_select2_source') ?>");

        var buttonCommon = {
            exportOptions: {
                format: { body: function ( data, row, column, node ) { return data.replace(/(&nbsp;|<([^>]+)>)/ig, ""); } },
            }
        };

        var ad_pcs_report = $('#ad_pcs_report').DataTable({
            dom: 'Bfrtip',
            buttons: [
                $.extend( true, {}, buttonCommon, { extend: 'print',  title: function () { return ("Ad Pcs Report")},
                    customize : function(win){
                        $(win.document.body).find('table thead th:nth-child(3)').css('text-align', 'right');
                        $(win.document.body).find('table tbody td:nth-child(3)').css('text-align', 'right');
                        $(win.document.body).find('table tfoot th:nth-child(3)').css('text-align', 'right');
                    }
                }),
            ],
            "serverSide": true,
            "ordering": true,
            "scrollY": '480px',
            "scrollX": true,
            "searching": false,
            "aaSorting": [[0, 'desc']],
            "scroller": {
                loadingIndicator: true
            },
            "ajax": {
                    "url": "<?php echo site_url('report/ad_pcs_report_datatable') ?>",
                "type": "POST",
                "data": function (d) {
                    d.job_worker_id = $("#job_worker_id").val();
                    d.from_date = $("#from_date").val();
                    d.to_date = $("#to_date").val();
                },
            },
            "columnDefs": [{
                "className": "text-right",
                "targets": [2]
            },{
                "className": "text-nowrap",
                "targets": [0,1]
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
                
                var total_receive_ad_pcs = api
                        .column(2)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                $(api.column(2).footer()).html(total_receive_ad_pcs);
            }
        });
        $(document).on('click','#btn_search',function(){
            ad_pcs_report.draw();
        });
    });
</script>
<?php
    $this->load->view('footer');
?>