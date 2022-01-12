<?php
    $this->load->view('header');
?>
<style>
    .dataTables_filter {
        float: right !important;
    }
    table.dataTable tbody th, table.dataTable tbody td {
        padding: 2px 10px;
    }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                Person Ledger
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
                                    <label for=""> Person</label>
                                    <select name="" id="job_worker_id" class="form-control">
                                    </select>
                                </div>
                            </div>
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
                            <div class="col-md-1">
                                <a href="javascript:void(0)" id="btn_search" class="btn btn-primary btn-sm search_btn pull-left" style="margin-top: 33px;">Search</a>
                            </div>
                            <div class="col-md-12">
                                    <label>Receive Toggle column: </label>&nbsp;&nbsp;
                                    <a class="toggle-vis text-info" data-column="2">Receive Gross</a> &nbsp;-&nbsp;
                                    <a class="toggle-vis text-info" data-column="3">Receive Item Weight</a> &nbsp;-&nbsp;
                                    <a class="toggle-vis text-info" data-column="4">Receive Kundan</a> &nbsp;-&nbsp;
                                    <a class="toggle-vis text-info" data-column="5">Receive Meena Wt.</a> &nbsp;-&nbsp;
                                    <a class="toggle-vis text-info" data-column="6">Receive Moti Wt.</a> &nbsp;-&nbsp;
                                    <a class="toggle-vis text-info" data-column="7">Receive Stone Wt.</a> &nbsp;-&nbsp;
                                    <a class="toggle-vis text-info" data-column="8">Receive Stone Pcs</a> &nbsp;-&nbsp;
                                    <a class="toggle-vis text-info" data-column="9">Receive Fine</a> &nbsp;-&nbsp;
                                    <a class="toggle-vis text-info" data-column="10">Receive Amount</a><br>
                                    <label>Issue Toggle column: </label>&nbsp;&nbsp;
                                    <a class="toggle-vis text-info" data-column="13">Issue Gross</a> &nbsp;-&nbsp;
                                    <a class="toggle-vis text-info" data-column="14">Issue Moti Wt.</a> &nbsp;-&nbsp;
                                    <a class="toggle-vis text-info" data-column="15">Issue Stone Wt.</a> &nbsp;-&nbsp;
                                    <a class="toggle-vis text-info" data-column="16">Issue Stone Pcs</a> &nbsp;-&nbsp;
                                    <a class="toggle-vis text-info" data-column="17">Issue Fine</a> &nbsp;-&nbsp;
                                    <a class="toggle-vis text-info" data-column="18">Issue Amount</a>
                            </div>
                            <div class="col-md-12">
                                <table id="person_new_ledger_report" class="table table-bordered table-striped" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th colspan="9" class="text-center">Receive / Jama</th>
                                            <th colspan="8" class="text-center">Issue / Udhar</th>
                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <th>Particular</th>
                                            <th>Gross</th>
                                            <th>Item Weight</th>
                                            <th>Kundan</th>
                                            <th>Meena Wt.</th>
                                            <th>Moti Wt.</th>
                                            <th>Stone Wt.</th>
                                            <th>Stone Pcs</th>
                                            <th>Fine</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Particular</th>
                                            <th>Gross</th>
                                            <th>Moti Wt.</th>
                                            <th>Stone Wt.</th>
                                            <th>Stone Pcs</th>
                                            <th>Fine</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <label>Total Issue V Pcs : <span id="total_issue_v_pcs" class="text-muted"></span></label> - <label>Total Receive V Pcs : <span id="total_receive_v_pcs" class="text-muted"></span></label> = <label>Balance V Pcs : <span id="balance_v_pcs" class="text-muted"></span></label><br>
                                <label>Kaarigar Balance Gross : <span id="kaarigar_balance_gross" class="text-muted"></span></label><br>
                                <label>Kaarigar Balance Fine : <span id="kaarigar_balance_fine" class="text-muted"></span></label><br>
                                <label>Balance Bandhanu : <span id="balance_bandhanu" class="text-muted"></span></label>
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
    var person_new_ledger_report;
    $(document).ready(function(){
        initAjaxSelect2($("#job_worker_id"), "<?= base_url('app/job_worker_select2_source') ?>");

        person_new_ledger_report = $('#person_new_ledger_report').DataTable({
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
                "url": "<?php echo site_url('report/person_new_ledger_datatable') ?>",
                "type": "POST",
                "data": function (d) {
                    d.job_worker_id = $("#job_worker_id").val();
                    d.from_date = $("#from_date").val();
                    d.to_date = $("#to_date").val();
                },
                "dataSrc": function ( jsondata ) {
                    $('#total_issue_v_pcs').html(jsondata.total_issue_v_pcs);
                    $('#total_receive_v_pcs').html(jsondata.total_receive_v_pcs);
                    $('#balance_v_pcs').html(jsondata.balance_v_pcs);
                    $('#kaarigar_balance_gross').html(jsondata.kaarigar_balance_gross);
                    $('#kaarigar_balance_fine').html(jsondata.kaarigar_balance_fine);
                    $('#balance_bandhanu').html(jsondata.balance_bandhanu);
                    return jsondata.data;
                },
            },
            "columnDefs": [{
                "className": "text-right",
                "targets": [2, 3, 4, 5, 6, 7, 8, 9, 10, 13, 14, 15, 16, 17, 18]
            },{
                "className": "text-nowrap",
                "targets": [0]
            }],
        });

        $('a.toggle-vis').on( 'click', function (e) {
            e.preventDefault();
            // Get the column API object
            var column = person_new_ledger_report.column( $(this).attr('data-column') );
            // Toggle the visibility
            column.visible( ! column.visible() );
        } );

        $(document).on('click','#btn_search',function(){
            person_new_ledger_report.draw();
        });
    });
</script>
<?php
    $this->load->view('footer');
?>