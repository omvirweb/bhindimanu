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
                Sell List
                <?php $isAdd = $this->app_model->have_access_role(MANUFACTURE_MODULE_ID, "add"); ?>
                <?php if($isAdd) { ?>
                    <a href="<?= base_url('sell/add') ?>" class="btn btn-primary btn-sm float-right" style="margin: 5px;">Add Sell</a>
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
                            <div class="col-md-1">
                                <a href="javascript:void(0)" id="btn_search" class="btn btn-primary btn-sm search_btn pull-left d-none" style="margin-top: 33px;">Search</a>
                            </div>
                            <div class="col-md-12">
                                <div class="clearfix"></div>
                                <div class="box-body">
                                    <table class="table row-border table-bordered table-striped" style="width:100%" id="sell_table">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Job Card No</th>
                                                <th>Party</th>
                                                <th>Sell Date</th>
                                                <th>Item</th>
                                                <th>Gross</th>
                                                <th>Net</th>
                                                <th>Touch</th>
                                                <th>Wastage</th>
                                                <th>fine</th>
                                                <th>Other Charges</th>
                                                <th>Sell Party</th>
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
<script type="text/javascript">
    $(document).ready(function(){
        initAjaxSelect2($("#party_id"), "<?= base_url('app/party_select2_source') ?>");

        var sell_table = $('#sell_table').DataTable({
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
                "url": "<?php echo site_url('sell/sell_datatable') ?>",
                "type": "POST",
                "data": function (d) {
                    d.from_date = $("#from_date").val();
                    d.to_date = $("#to_date").val();
                    d.job_card_no = $("#job_card_no").val();
                    d.party_id = $("#party_id").val();
                },
            },
            "columnDefs": [
            {
                "className": "text-right",
                "targets": [5, 6, 7, 8, 9, 10],
            },{
                "className": "text-nowrap",
                "targets": [0, 3],
            }],
        });
        $(document).on('click','#btn_search',function(){
            sell_table.draw();
        });

        $(document).on('change','#from_date, #to_date, #party_id',function(){
            sell_table.draw();
        });
        $(document).on('keyup','#job_card_no',function(){
            sell_table.draw();
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
                        sell_table.draw();
                        toastr.success('Sell Deleted Successfully!');                        
                    }
                });
            }
        });
    });
</script>
<?php
    $this->load->view('footer');
?>