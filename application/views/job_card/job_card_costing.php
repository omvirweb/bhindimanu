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
                Job Card Costing : <span class="text-muted">No. <?php echo $job_card_data->job_card_no; ?> &nbsp;&nbsp;&nbsp; Item : <?php echo $job_card_item_name; ?></span>
                <?php $isView = $this->app_model->have_access_role(JOB_CARD_ENTRY_MODULE_ID, "view"); ?>
                <?php if($isView) { ?>
                    <a href="<?= base_url('job_card/job_card_list') ?>" class="btn btn-primary btn-sm float-right" style="margin: 5px;">Job Card List</a>
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
                            <div class="col-md-12">
                                <table id="job_card_costing_table" class="table table-bordered" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Particular</th>
                                            <th class="text-right">Reference</th>
                                            <th class="text-right">Costing Fine</th>
                                            <th class="text-right">Costing Amount</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Karigar Receive Fine</td>
                                            <td class="text-right"><?php echo $karigar_rfw_gross_total; ?></td>
                                            <td class="text-right"><?php echo $karigar_receive_fine; ?></td>
                                            <td class="text-right"></td>
                                            <td>Receive : Gross * Touch / 100</td>
                                        </tr>
                                        <tr>
                                            <td>Karigar Wastage</td>
                                            <td class="text-right"></td>
                                            <td class="text-right"><?php echo $karigar_wastage; ?></td>
                                            <td class="text-right"></td>
                                            <td>Receive : Gross * Wastage / 100</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Bandhnu Other Charges
                                                <?php
                                                    if(!empty($bandhanu_manufacture_ids)){
                                                        foreach($bandhanu_manufacture_ids as $bandhanu_manufacture_id){
                                                            echo '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'manufacture/add/'. $bandhanu_manufacture_id.'" title="Edit Manufacture" target="_blank"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"><?php echo $bandhnu_other_charges; ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Bandhnu Moti
                                                <?php
                                                    if(!empty($bandhanu_manufacture_ids)){
                                                        foreach($bandhanu_manufacture_ids as $bandhanu_manufacture_id){
                                                            echo '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'manufacture/add/'. $bandhanu_manufacture_id.'" title="Edit Manufacture" target="_blank"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"><?php echo $bandhnu_moti_amount; ?></td>
                                            <td></td>
                                        </tr>
                                        <?php if(isset($meena_other_charges) && !empty($meena_other_charges)){ ?>
                                            <?php foreach($meena_other_charges as $meena_other_charge){ ?>
                                                <tr>
                                                    <td><?php echo $meena_other_charge->charges_name; ?></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"><?php echo number_format($meena_other_charge->charges_amount, 2, '.', ''); ?></td>
                                                    <td>Meena Process Other charges</td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if(isset($chol_item_arr) && !empty($chol_item_arr)){ ?>
                                            <?php foreach($chol_item_arr as $chol_item_row){ ?>
                                                <tr>
                                                    <td><?php echo $chol_item_row->particular; ?></td>
                                                    <td class="text-right"><?php echo $chol_item_row->gross_total; ?></td>
                                                    <td class="text-right"><?php echo $chol_item_row->fine_total; ?></td>
                                                    <td class="text-right"></td>
                                                    <td>Receive Chol Gross and Fine</td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                        <tr>
                                            <td>Jadtar Kundan</td>
                                            <td class="text-right"><?php echo $jadtar_kundan_gross; ?></td>
                                            <td class="text-right"><?php echo $jadtar_kundan; ?></td>
                                            <td class="text-right"></td>
                                            <td>Jadrar Process Receive Finish 1st Line item Touch / Kundan Total * 100 && Kundan Total</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Jadtar Stone Charges
                                                <?php
                                                    if(!empty($jadtar_manufacture_ids)){
                                                        foreach($jadtar_manufacture_ids as $jadtar_manufacture_id){
                                                            echo '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'manufacture/add/'. $jadtar_manufacture_id.'" title="Edit Manufacture" target="_blank"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"><?php echo $jadtar_stone_charges; ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Jadtar Other Charges
                                                <?php
                                                    if(!empty($jadtar_manufacture_ids)){
                                                        foreach($jadtar_manufacture_ids as $jadtar_manufacture_id){
                                                            echo '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'manufacture/add/'. $jadtar_manufacture_id.'" title="Edit Manufacture" target="_blank"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"><?php echo $jadtar_other_charges; ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Vetran Fine</td>
                                            <td class="text-right"><?php echo $used_vetran; ?></td>
                                            <td class="text-right"><?php echo $vetran_fine; ?></td>
                                            <td class="text-right"></td>
                                            <td>Issue થયેલા Vetran Item ના Touch થી Used Vetran નો  Fine કાઢવો </td>
                                        </tr>
                                        <tr>
                                            <td>Polish Allowed Loss Costing</td>
                                            <td class="text-right"></td>
                                            <td class="text-right"><?php echo $polish_allowed_loss_costing; ?></td>
                                            <td class="text-right"></td>
                                            <td>Allowed Loss * Receive Finish Work 1st Line Item Touch / 100</td>
                                        </tr>
                                        <tr>
                                            <td>Patch Fine</td>
                                            <td class="text-right"><?php echo $patch_weight; ?></td>
                                            <td class="text-right"><?php echo $patch_fine; ?></td>
                                            <td class="text-right"></td>
                                            <td>Patch * ( Kaarigar Process Receive Finish 1st Line item Touch + Patch Wastage ) / 100</td>
                                        </tr>
                                        <tr>
                                            <td>Less</td>
                                            <td class="text-right"></td>
                                            <td class="text-right"><?php echo $real_minus_given_less; ?></td>
                                            <td class="text-right"></td>
                                            <td>Real Less(Setting Process Used AD Weight) - Given Less(In Tag) | <?php echo $real_less; ?> - <?php echo $given_less; ?> = <?php echo $real_minus_given_less; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <th class="text-right"><?php echo $reference_total; ?></th>
                                            <th class="text-right"><?php echo $total_costing_fine; ?></th>
                                            <th class="text-right"><?php echo $total_costing_amount; ?></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th>Profit/Loss</th>
                                            <td class="text-right"></td>
                                            <th class="text-right"><?php echo $profit_loss_fine; ?></th>
                                            <th class="text-right"><?php echo $profit_loss_amount; ?></th>
                                            <th></th>
                                        </tr>
                                    </tbody>
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
        $('#job_card_costing_table').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                text: 'Export to Excel',
                title: function () { return ('No_<?php echo $job_card_data->job_card_no; ?>_Item_<?php echo str_replace(' ', '_', $job_card_item_name); ?>_Job_Card_Costing_<?php echo date("Y_m_d_H_i_s"); ?>') },
            }],
            "ordering": false,
            "searching": false,
            "paging": false,
            "bInfo": false,
        });
    });
</script>
<?php
    $this->load->view('footer');
?>