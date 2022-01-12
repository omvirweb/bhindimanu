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
                Item Stock Status
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
                                    <label for="item_id">Item</label>
                                    <select name="" id="item_id" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <a href="javascript:void(0)" id="btn_search" class="btn btn-primary btn-sm search_btn pull-left" style="margin-top: 33px;">Search</a>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="item_stock_status_table" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Gross</th>
                                                <th>Touch</th>
                                                <!--<th>Fine</th>-->
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
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
    var item_stock_status_table;
    $(document).ready(function(){
        initAjaxSelect2($("#item_id"), "<?= base_url('app/item_select2_source') ?>");

        item_stock_status_table = $('#item_stock_status_table').DataTable({
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
                "url": "<?php echo site_url('report/item_stock_status_datatable') ?>",
                "type": "POST",
                "data": function (d) {
                    d.item_id = $("#item_id").val();
                },
            },
            "columnDefs": [{
                "className": "text-right",
//                "targets": [1, 2, 3]
                "targets": [1, 2]
            },{
//                "className": "text-nowrap",
//                "targets": [0,1]
            }],
        });
        $(document).on('click','#btn_search',function(){
            item_stock_status_table.draw();
        });
    });
</script>
<?php
    $this->load->view('footer');
?>