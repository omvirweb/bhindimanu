<?php
    $this->load->view('header');
?>
<?php $this->load->view('success_false_notify'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <a href="<?= base_url('/') ?>" class="btn btn-primary btn-sm" style="margin: 5px;"><i class="fa fa-angle-double-left"></i> Back to Dashboard</a>
                Person wise Process Gross
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered bg-white">
                    <tr>
                        <th colspan="5" class="text-center"><?php echo isset($process_name) ? $process_name : ''; ?></th>
                    </tr>
                    <tr>
                        <th>Person</th>
                        <th class="text-right">Issue Finish</th>
                        <th class="text-right">Issue Scrap</th>
                        <th class="text-right">Receive Finish</th>
                        <th class="text-right">Receive Scrap</th>
                    </tr>
                    <?php
                        $issue_finish = 0;
                        $issue_scrap = 0;
                        $receive_finish = 0;
                        $receive_scrap = 0;
                        if(!empty($person_wise_process_gross_data)) {
                            foreach ($person_wise_process_gross_data as $key => $person_wise_process_gross_row) {
                                echo '<tr>';
                                echo '<td><a href="javascript:void(0);" class="view_detail" data-job_worker_id="' . $person_wise_process_gross_row->job_worker_id . '" data-process_id="' . $person_wise_process_gross_row->process_id . '"><span>' . $person_wise_process_gross_row->job_worker . '</span></a></td>';
                                echo '<td class="text-right">' . $person_wise_process_gross_row->issue_finish . '</td>';
                                echo '<td class="text-right">' . $person_wise_process_gross_row->issue_scrap . '</td>';
                                echo '<td class="text-right">' . $person_wise_process_gross_row->receive_finish . '</td>';
                                echo '<td class="text-right">' . $person_wise_process_gross_row->receive_scrap . '</td>';
                                echo '</tr>';
                                $issue_finish = $issue_finish + $person_wise_process_gross_row->issue_finish;
                                $issue_scrap = $issue_scrap + $person_wise_process_gross_row->issue_scrap;
                                $receive_finish = $receive_finish + $person_wise_process_gross_row->receive_finish;
                                $receive_scrap = $receive_scrap + $person_wise_process_gross_row->receive_scrap;
                            }
                        }
                        $issue_gross = $issue_finish + $issue_scrap;
                        $receive_gross = $receive_finish + $receive_scrap;
                        $gross_bal = ($issue_gross - $receive_gross);
                        echo '<tr>';
                        echo '<th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">Total</th>';
                        echo '<th colspan="2" class="text-center">' . $issue_gross . '</th>';
                        echo '<th colspan="2" class="text-center">' . $receive_gross . '</th>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th colspan="4" class="text-center">' . $gross_bal . '</th>';
                        echo '</tr>';
                    ?>
                </table>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.content -->
  </div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Person wise Detail : <span id="p_name"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <tr>
                                    <th>Job Card No.</th>
                                    <th id="date_f">Date</th>
                                    <th>Issue Finish</th>
                                    <th>Issue Scrap</th>
                                    <th>Receive Finish</th>
                                    <th>Receive Scrap</th>
                                </tr>
                            </thead>
                            <tbody id="tbody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.view_detail', function () {
            $('#myModal').modal('show');
            $.ajax({
                url: "<?= base_url('auth/get_person_wise_detail') ?>",
                type: "POST",
                data: {job_worker_id : $(this).attr('data-job_worker_id'), process_id : $(this).attr('data-process_id') },
                dataType:'json',
                async :false,
                success: function (res) {
//                    var json = $.parseJSON(res);
                    console.log(res.person_wise_data);
                    $('#tbody').html();
                    var t_html = '';
                    var issue_finish = 0;
                    var issue_scrap = 0;
                    var receive_finish = 0;
                    var receive_scrap = 0;
                    var total_1 = 0;
                    var total_2 = 0;
                    var total_3 = 0;
                    var total_4 = 0;
                    if(res.person_wise_data != ''){
                        $('#p_name').html(res.person_wise_data[0]['job_worker']);
                        $.each(res.person_wise_data,function(ind,value){
                            t_html += '<tr>';
                            t_html += '<td>';
                            job_card_no = '';
                            $.each(value.job_card_data,function(ind_sub,value_sub){
                                if(job_card_no == ''){
                                    job_card_no = value_sub.job_card_no;
                                    t_html += ''+job_card_no+' : <a class="edit_button btn-primary btn-xs" href="<?php echo site_url('manufacture/add') ?>/'+value_sub.manufacture_id+'" target="blank" title="Edit Manufacture"><i class="fa fa-edit"></i></a>&nbsp;';
                                } else {
                                    if(value_sub.job_card_no == job_card_no){
                                        t_html += '<a class="edit_button btn-primary btn-xs" href="<?php echo site_url('manufacture/add') ?>/'+value_sub.manufacture_id+'" target="blank" title="Edit Manufacture"><i class="fa fa-edit"></i></a>&nbsp;';
                                    } else {
                                        job_card_no = value_sub.job_card_no;
                                        t_html += '<br/>'+job_card_no+' : <a class="edit_button btn-primary btn-xs" href="<?php echo site_url('manufacture/add') ?>/'+value_sub.manufacture_id+'" target="blank" title="Edit Manufacture"><i class="fa fa-edit"></i></a>&nbsp;';
                                    }
                                }
                            });
                            t_html += '</td>';
                            t_html += '<td>'+value.tr_date+'</td>';
                            if(value.type_id == '1'){
                                var issue_finish_v = parseFloat(value.issue_finish).toFixed(2);
                                var issue_scrap_v = parseFloat(value.issue_scrap).toFixed(2);
                                var receive_finish_v = parseFloat(value.receive_finish).toFixed(2);
                                var receive_scrap_v = parseFloat(value.receive_scrap).toFixed(2);
                                t_html += '<td class="text-right">'+issue_finish_v+'</td>';
                                t_html += '<td class="text-right">'+issue_scrap_v+'</td>';
                                t_html += '<td class="text-right">'+receive_finish_v+'</td>';
                                t_html += '<td class="text-right">'+receive_scrap_v+'</td>';
                                total_1 = parseFloat(total_1) + parseFloat(issue_finish_v);
                                total_2 = parseFloat(total_2) + parseFloat(issue_scrap_v);
                                total_3 = parseFloat(total_3) + parseFloat(receive_finish_v);
                                total_4 = parseFloat(total_4) + parseFloat(receive_scrap_v);
                            }
                            t_html += '</tr>';
                        });
//                        var issue_gross = parseFloat(issue_finish) + parseFloat(issue_scrap);
//                        var receive_gross = parseFloat(receive_finish) + parseFloat(receive_scrap);
//                        var gross_bal = (parseFloat(issue_gross) - parseFloat(receive_gross));
//                        t_html += '<tr>';
//                        t_html += '<th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">Total</th>';
//                        t_html += '<th colspan="2" class="text-center">' + issue_gross + '</th>';
//                        t_html += '<th colspan="2" class="text-center">' + receive_gross + '</th>';
//                        t_html += '</tr>';
//                        t_html += '<tr>';
//                        t_html += '<th colspan="4" class="text-center">' + gross_bal + '</th>';
//                        t_html += '</tr>';
//                        
                        t_html += '<tr>';
                        t_html += '<th class="text-right">Total</th>';
                        t_html += '<th class="text-right">' + total_1 + '</th>';
                        t_html += '<th class="text-right">' + total_2 + '</th>';
                        t_html += '<th class="text-right">' + total_3 + '</th>';
                        t_html += '<th class="text-right">' + total_4 + '</th>';
                        t_html += '</tr>';
                        $('#tbody').html(t_html);
                    }
                    
                },
            });
        });
    });
</script>
<?php
    $this->load->view('footer');
?>