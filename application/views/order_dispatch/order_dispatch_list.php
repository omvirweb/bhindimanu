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
                Order & Dispatch
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
                            <div class="col-md-1" style="display: none;">
                                <a href="javascript:void(0)" id="btn_search" class="btn btn-primary btn-sm search_btn pull-left" style="margin-top: 33px;">Search</a>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive1">
                                    <table id="order_dispatch_table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>JB</th>
                                                <th>Party</th>
                                                <th>Touch</th>
                                                <th>Order</th>
                                                <?php
                                                    $process_column_keys = '';
                                                    if(!empty($process_master_res)) {
                                                        foreach ($process_master_res as $key => $process_master_row) {
                                                            if($key != 0) {
                                                                $process_column_keys .= ',';
                                                            }
                                                            $process_column_keys .= ($key + 4);
                                                            ?>
                                                            <th><?=$process_master_row->process_name?></th>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                                <th>Dispatched</th>
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
        var order_dispatch_table = $('#order_dispatch_table').on('preXhr.dt', function ( e, settings, data ) {
                    if (settings.jqXHR) settings.jqXHR.abort();
            }).DataTable({
            "serverSide": true,
            "ordering": true,
            "searching": true,
            "aaSorting": [[1, 'asc']],
            "ajax": {
                    "url": "<?php echo site_url('order_dispatch/order_dispatch_datatable') ?>",
                "type": "POST",
                "data": function (d) {
                },
            },
            "scrollY": '350',
            "scrollX": false,
            "paging": false,
            "columnDefs": [
            {
                "className": "text-right",
                "targets": [2,3,<?=$process_column_keys?>],
            },
            {
                "orderable": false,
                "targets": [<?=$process_column_keys?>],
            }]
        });
        $(document).on('click','#btn_search',function(){
            order_dispatch_table.draw();
        });
    });
</script>
<?php
    $this->load->view('footer');
?>