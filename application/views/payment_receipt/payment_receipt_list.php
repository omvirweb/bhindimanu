<?php
    $this->load->view('header');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                Payment / Receipt List
                <?php $isAdd = $this->app_model->have_access_role(PAYMENT_RECEIPT_MODULE_ID, "add"); ?>
                <?php if($isAdd) { ?>
                    <a href="<?= base_url('payment_receipt/add') ?>" class="btn btn-primary btn-sm float-right" style="margin: 5px;">Add Payment Receipt</a>
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="from_date"> From Date</label>
                                    <input type="text" name="from_date" id="from_date" class="form-control input-datepicker" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="to_date"> To Date</label>
                                    <input type="text" name="to_date" id="to_date" class="form-control input-datepicker" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="job_worker_id"> Person<span style="color:red"> *</span></label>
                                    <select class="form-control" name="job_worker_id" id="job_worker_id"></select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <a href="javascript:void(0)" id="btn_search" class="btn btn-primary btn-sm search_btn pull-left" style="margin-top: 33px;">Search</a>
                            </div>
                            <div class="col-md-12">
                                <div class="clearfix"></div>
                                <div class="box-body">
                                    <table class="table row-border table-bordered table-striped" style="width:100%" id="payment_receipt_table">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Person</th>
                                                <th>Date</th>
                                                <th>Item</th>
                                                <th>Weight Jama/Udhar</th>
                                                <th>Weight</th>
                                                <th>Touch</th>
                                                <th>Fine</th>
                                                <th>Amount Jama/Udhar</th>
                                                <th>Amount</th>
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
    $(document).ready(function(){
        initAjaxSelect2($("#job_worker_id"), "<?= base_url('app/job_worker_select2_source') ?>");
        var payment_receipt_table = $('#payment_receipt_table').DataTable({
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
                "url": "<?php echo site_url('payment_receipt/payment_receipt_datatable') ?>",
                "type": "POST",
                "data": function (d) {
                    d.from_date = $("#from_date").val();
                    d.to_date = $("#to_date").val();
                    d.job_worker_id = $("#job_worker_id").val();
                },
            },
            "columnDefs": [
            {
                "className": "text-right",
                "targets": [5, 6, 7, 9],
            },{
                "className": "text-nowrap",
                "targets": [0, 2],
            }]
        });
        $(document).on('click','#btn_search',function(){
            payment_receipt_table.draw();
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
                        payment_receipt_table.draw();
                        toastr.success('Payment Receipt Deleted Successfully!');                        
                    }
                });
            }
        });
    });
</script>
<?php
    $this->load->view('footer');
?>