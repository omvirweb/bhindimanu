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
                Tag List
                <?php $isAdd = $this->app_model->have_access_role(MANUFACTURE_MODULE_ID, "add"); ?>
                <?php if($isAdd) { ?>
                    <a href="<?= base_url('tag/add') ?>" class="btn btn-primary btn-sm float-right" style="margin: 5px;">Add Tag</a>
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
                            <div class="col-md-2 pr-0">
                                <div class="form-group">
                                    <label><input type="checkbox" name="view_only_not_sell_tags" id="view_only_not_sell_tags" checked > View only not Sell Tags</label>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <a href="javascript:void(0)" id="btn_search" class="btn btn-primary btn-sm search_btn pull-left d-none" style="margin-top: 33px;">Search</a>
                            </div>
                            <div class="col-md-12">
                                <div class="clearfix"></div>
                                <div class="box-body">
                                    <table class="table row-border table-bordered table-striped" style="width:100%" id="tag_table">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Job Card No</th>
                                                <th>Party</th>
                                                <th>Tag Date</th>
                                                <th>Item</th>
                                                <th>Gross</th>
                                                <th>Item Weight</th>
                                                <th>Less</th>
                                                <th>Stone Wt.</th>
                                                <th>Moti</th>
                                                <th>Net</th>
                                                <th>Patch</th>
                                                <th>Patch Wstg</th>
                                                <th>Other Charges</th>
                                                <th>Image</th>
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
    $(document).ready(function(){
        initAjaxSelect2($("#party_id"), "<?= base_url('app/party_select2_source') ?>");

        var tag_table = $('#tag_table').DataTable({
            "serverSide": true,
            "ordering": false,
            "scrollY": '480px',
            "scrollX": true,
            "searching": false,
            "paging": false,
            "aaSorting": [[0, 'desc']],
//            "scroller": {
//                loadingIndicator: true
//            },
            "ajax": {
                "url": "<?php echo site_url('tag/tag_datatable') ?>",
                "type": "POST",
                "data": function (d) {
                    d.job_card_no = $("#job_card_no").val();
                    d.party_id = $("#party_id").val();
                    d.view_only_not_sell_tags = $('input[name="view_only_not_sell_tags"]').prop('checked');
                },
            },
            "columnDefs": [
            {
                "className": "text-right",
                "targets": [5, 6, 7, 8, 9, 10, 11, 12, 13],
            },{
                "className": "text-nowrap",
                "targets": [0, 3],
            }],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0;
                };
                // Total over all pages
                total = api.column( 5 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                // Update footer
                $( api.column( 5 ).footer() ).html( total.toFixed(3) );

                total = api.column( 6 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                $( api.column( 6 ).footer() ).html( total.toFixed(3) );

                total = api.column( 7 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                $( api.column( 7 ).footer() ).html( total.toFixed(3) );

                total = api.column( 8 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                $( api.column( 8 ).footer() ).html( total.toFixed(3) );

                total = api.column( 9 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                $( api.column( 9 ).footer() ).html( total.toFixed(3) );

                total = api.column( 10 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                $( api.column( 10 ).footer() ).html( total.toFixed(3) );

                total = api.column( 11 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                $( api.column( 11 ).footer() ).html( total.toFixed(3) );

                total = api.column( 12 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                $( api.column( 12 ).footer() ).html( total.toFixed(3) );

                total = api.column( 13 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                $( api.column( 13 ).footer() ).html( total.toFixed(2) );
            }
        });
        $(document).on('click','#btn_search',function(){
            tag_table.draw();
        });

        $(document).on('change','#party_id, #view_only_not_sell_tags',function(){
            tag_table.draw();
        });
        $(document).on('keyup','#job_card_no',function(){
            tag_table.draw();
        });

        $(document).on('click', '.item_photo_modal', function () {
            var src = $(this).data("img_src");
            setTimeout(function () {
                $("#doc_img_src").attr('src', src);
            }, 0);
            $('#viewImageModal').modal('show');
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
                        tag_table.draw();
                        toastr.success('Tag Deleted Successfully!');                        
                    }
                });
            }
        });
    });
</script>
<?php
    $this->load->view('footer');
?>