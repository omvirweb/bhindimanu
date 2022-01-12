<?php
    $this->load->view('header');
?>
<style>
    .table th{
        padding: 4px !important;
        font-size: 15px !important;
    }
    .table td{
        padding: 4px !important;
        font-size: 15px !important;
    }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                Tag: Add
                <?php $isView = $this->app_model->have_access_role(MANUFACTURE_MODULE_ID, "view"); ?>
                <?php if($isView) { ?>
                    <a href="<?= base_url('tag/tag_list') ?>" class="btn btn-primary btn-sm float-right" style="margin: 5px;">Tag List</a>
                <?php } ?>
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" id="body-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <form id="save_tag" class="form-horizontal" action=""  method="post"  novalidate enctype="multipart/form-data">
                        <input type="hidden" name="tag_id" id="tag_id" value="<?php echo isset($tag_row->tag_id) ? $tag_row->tag_id : ''; ?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="job_card_id"> Job No<span style="color:red"> *</span></label>
                                        <select name="job_card_id" id="job_card_id" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="party"> Party<span style="color:red"> *</span></label>
                                        <input type="text" class="form-control" name="party" id="party" disabled="disabled">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="melting"> Touch<span style="color:red"> *</span></label>
                                        <input type="text" class="form-control" name="melting" id="melting" disabled="disabled">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="tag_no"> Tag No</label>
                                        <input type="text" class="form-control" name="tag_no" id="tag_no" disabled="disabled">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0" style="">
                                    <div class="form-group">
                                        <label for="tag_date"> Date<span style="color:red"> *</span></label>
                                        <input type="text" class="form-control pl-2 pr-2" value="<?php echo isset($tag_row->tag_date) ? date("d-m-Y",strtotime($tag_row->tag_date)) : date('d-m-Y'); ?>" name="tag_date" id="tag_date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="remark"> Remark</label>
                                        <textarea name="remark" id="remark" class="form-control"><?php echo isset($tag_row->remark) ? $tag_row->remark : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="item_id"> Item<span style="color:red"> *</span></label>
                                        <select class="form-control" name="item_id" id="item_id"></select>
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="patch"> Patch</label>
                                        <input type="text" name="patch" id="patch" class="form-control num_only" value="<?php echo isset($tag_row->patch) ? $tag_row->patch : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="patch_wastage"> Patch Wstg</label>
                                        <input type="text" name="patch_wastage" id="patch_wastage" class="form-control num_only" value="<?php echo isset($tag_row->patch_wastage) ? $tag_row->patch_wastage : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="item_weight"> Item Weight</label>
                                        <input type="text" name="item_weight" id="item_weight" class="form-control num_only" value="<?php echo isset($tag_row->item_weight) ? $tag_row->item_weight : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="gross"> Gross<span style="color:red"> *</span></label>
                                        <input type="text" name="gross" id="gross" class="form-control num_only" value="<?php echo isset($tag_row->gross) ? $tag_row->gross : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="less"> Less</label>
                                        <input type="text" name="less" id="less" class="form-control num_only" value="<?php echo isset($tag_row->less) ? $tag_row->less : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="stone_wt"> Stone Wt.</label>
                                        <input type="text" name="stone_wt" id="stone_wt" class="form-control num_only" value="<?php echo isset($tag_row->stone_wt) ? $tag_row->stone_wt : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="moti"> Moti</label>
                                        <input type="text" name="moti" id="moti" class="form-control num_only" value="<?php echo isset($tag_row->moti) ? $tag_row->moti : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="net"> Net</label>
                                        <input type="text" name="net" id="net" class="form-control num_only" value="<?php echo isset($tag_row->net) ? $tag_row->net : ''; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="other_charges"><a href="javascript:void(0)" id="other_charges_details" class="" style="margin: 0; font-size: 14px;">Other Charges</a></label>
                                        <input type="text" name="other_charges" class="form-control" id="other_charges" placeholder="" value="<?php echo isset($tag_row->other_charges) ? $tag_row->other_charges : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <label for="file_upload">Image</label>
                                    <input type="file" name="file_upload" id="file_upload" class="from-control" onchange="upload_file_upload(this);" accept="image/*" value="" style="width: 90px;">
                                    <input type="hidden" name="image" id="image" class="from-control">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="module_submit_btn" class="btn btn-info float-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="moti_details_model" class="modal fade myModelClose" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color:#f1e8e1;">
                    <div class="modal-header">
                        <div class="col-md-6">
                            <h4 class="modal-title" id="myModalLabel">Moti Details</h4>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                    </div>
                    <div class="modal-body edit-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="moti_details_form">
                                    <input type="hidden" name="moti_details_index" id="moti_details_index" />
                                    <?php if(isset($moti_details_data) && !empty($moti_details_data)){ ?>
                                        <input type="hidden" name="moti_details_data[moti_details_id]" id="moti_details_id" />
                                    <?php } ?>
                                    <div class="col-md-4 pr-0">
                                        <label for="moti_id">Moti<span class="required-sign">&nbsp;*</span></label>
                                        <select name="moti_details_data[moti_id]" class="form-control moti_id" id="moti_id"></select>
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="moti_weight">Weight<span class="required-sign">&nbsp;*</span></label>
                                        <input type="text" name="moti_details_data[moti_weight]" class="form-control num_only" id="moti_weight" >
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="moti_rate">Rate Per Ct<span class="required-sign">&nbsp;*</span></label>
                                        <input type="text" name="moti_details_data[moti_rate]" class="form-control num_only" id="moti_rate" >
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="moti_detail_amount">Amount<span class="required-sign">&nbsp;*</span></label>
                                        <input type="text" name="moti_details_data[moti_detail_amount]" class="form-control num_only" id="moti_detail_amount" >
                                    </div>
                                    <div class="col-md-2">
                                        <label></label>
                                        <input type="button" id="add_moti_details" class="btn btn-info btn-sm" value="Add Line" style="margin-top: 21px;"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 table-responsive"><br>
                                <table style="" class="table custom-table item-table">
                                    <thead>
                                        <tr>
                                            <th width="80px">Action</th>
                                            <th>Moti</th>
                                            <th class="text-right">Weight</th>
                                            <th class="text-right">Rate Per Ct</th>
                                            <th class="text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="moti_details_list"></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total:</th>
                                            <th></th>
                                            <th class="text-right" id="total_moti_details_weight"></th>
                                            <th></th>
                                            <th class="text-right" id="total_moti_details_amount"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div><br />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="other_charges_details_model" class="modal fade myModelClose" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color:#f1e8e1;">
                    <div class="modal-header">
                        <div class="col-md-6">
                            <h4 class="modal-title" id="myModalLabel">Other Charges Details</h4>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                    </div>
                    <div class="modal-body edit-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="other_charges_details_form">
                                    <input type="hidden" name="other_charges_details_index" id="other_charges_details_index" />
                                    <?php if(isset($other_charges_details_data) && !empty($other_charges_details_data)){ ?>
                                        <input type="hidden" name="other_charges_details_data[other_charges_details_id]" id="other_charges_details_id" />
                                    <?php } ?>
                                    <div class="col-md-4 pr-0">
                                        <label for="charges_id">Charges For<span class="required-sign">&nbsp;*</span></label>
                                        <select name="other_charges_details_data[charges_id]" class="form-control charges_id" id="charges_id"></select>
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="charges_weight">Weight / Pcs<span class="required-sign">&nbsp;*</span></label>
                                        <input type="text" name="other_charges_details_data[charges_weight]" class="form-control num_only" id="charges_weight" >
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="charges_rate">Rate<span class="required-sign">&nbsp;*</span></label>
                                        <input type="text" name="other_charges_details_data[charges_rate]" class="form-control num_only" id="charges_rate" >
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="charges_amount">Amount<span class="required-sign">&nbsp;*</span></label>
                                        <input type="text" name="other_charges_details_data[charges_amount]" class="form-control num_only" id="charges_amount" >
                                    </div>
                                    <div class="col-md-2">
                                        <label></label>
                                        <input type="button" id="add_other_charges_details" class="btn btn-info btn-sm" value="Add Line" style="margin-top: 21px;"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 table-responsive"><br>
                                <table style="" class="table custom-table item-table">
                                    <thead>
                                        <tr>
                                            <th width="80px">Action</th>
                                            <th>Charges For</th>
                                            <th class="text-right">Weight / Pcs</th>
                                            <th class="text-right">Rate</th>
                                            <th class="text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="other_charges_details_list"></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total:</th>
                                            <th></th>
                                            <th class="text-right" id="total_other_charges_details_weight"></th>
                                            <th></th>
                                            <th class="text-right" id="total_other_charges_details_amount"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div><br />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
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
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
    $('#body-content').on('change keyup keydown click', 'input, textarea, select', function (e) {
        $(this).addClass('changed-input');
    });
    $(window).on('beforeunload', function () {
        if ($('.changed-input').length) {
            return 'Are you sure you want to leave?';
        }
    });

    var edit_moti_details_inc = 0;
    var edit_other_charges_details_inc = 0;
    var moti_details_objectdata = [];
    var other_charges_details_objectdata = [];
    var rate_on_ct = 1;
    
    $(document).ready(function(){
        <?php if (isset($tag_row->other_charges_details)) { ?>
        var li_other_charges_details_objectdata = <?php echo $tag_row->other_charges_details; ?>;
        if (li_other_charges_details_objectdata != '') {
            $.each(li_other_charges_details_objectdata, function (index, value) {
                other_charges_details_objectdata.push(value);
            });
        }
        <?php } ?>

        $('#tag_date').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: "linked",
            todayHighlight: true,
            autoclose: true
        });

        initAjaxSelect2($("#job_card_id"), "<?= base_url('app/job_card_select2_source') ?>");
        <?php if(isset($tag_row->job_card_id)){ ?>
            setSelect2Value($("#job_card_id"),"<?=base_url('app/set_job_card_select2_val_by_id/'.$tag_row->job_card_id)?>");
            set_jon_card_detail();
        <?php } else { ?>
            $('#job_card_id').select2('open');
        <?php }  ?>
        $(document).on('change','#job_card_id',function(){
            set_jon_card_detail();
        });

        $("#type_id").select2({width:'100%'});
        initAjaxSelect2($("#item_id"), "<?= base_url('app/item_select2_source') ?>");
        <?php if(isset($tag_row->item_id)){ ?>
            setSelect2Value($("#item_id"),"<?=base_url('app/set_item_select2_val_by_id/'.$tag_row->item_id)?>");
        <?php } ?>

        $(document).on('input','#item_weight, #patch',function () {
            var item_weight = parseFloat($("#item_weight").val()) || 0;
            var patch = parseFloat($("#patch").val()) || 0;
            var gross = parseFloat(item_weight) + parseFloat(patch);
            $("#gross").val(gross.toFixed(3));
        });

        $(document).on('input','#gross, #less, #stone_wt, #moti',function () {
            var gross = parseFloat($("#gross").val()) || 0;
            var less = parseFloat($("#less").val()) || 0;
            var stone_wt = parseFloat($("#stone_wt").val()) || 0;
            var moti = parseFloat($("#moti").val()) || 0;
            var net = parseFloat(gross) - parseFloat(less) - parseFloat(stone_wt) - parseFloat(moti);
            $("#net").val(net.toFixed(3));
        });

        $(document).on('click', '#moti_details', function () {
            initAjaxSelect2($("#moti_id"), "<?= base_url('app/moti_select2_source/') ?>");
            $('#moti_details_model').modal('show');
            display_moti_details_html(moti_details_objectdata);
        });
        $('#moti_details_model').on('hidden.bs.modal', function () {
            var total_moti_details_weight = $('#total_moti_details_weight').html() || 0;
            var total_moti_details_amount = $('#total_moti_details_amount').html() || 0;
            $('#moti').val(total_moti_details_weight).trigger("change");
            $('#moti_amount').val(total_moti_details_amount).trigger("change");
            $('#moti_detail_amount').val('');
        });
        $(document).on('keyup change', '#moti_weight, #moti_rate', function () {
            var moti_weight = $('#moti_weight').val() || 0;
            var moti_rate = $('#moti_rate').val() || 0;
            var moti_detail_amount = parseFloat(moti_weight) * parseFloat(moti_rate) * <?php echo MOTI_WT_TO_CT_TO_AMOUNT; ?>;
            $('#moti_detail_amount').val(moti_detail_amount);
        });
        $(document).on('click', '#add_moti_details', function () {
            var moti_id = $("#moti_id").val();
            if (moti_id == '' || moti_id == null) {
                $("#moti_id").select2('open');
                show_notify("Please select Charges For!", false);
                return false;
            }
            var moti_detail_amount = $("#moti_detail_amount").val();
            if (moti_detail_amount == '' || moti_detail_amount == null) {
                show_notify("Amount is required!", false);
                $("#moti_detail_amount").focus();
                return false;
            }

            $("#add_moti_details").attr('disabled', 'disabled');
            var key = '';
            var value = '';
            var moti_details = {};
            $('input[name^="moti_details_data"]').each(function () {
                key = $(this).attr('name');
                key = key.replace("moti_details_data[", "");
                key = key.replace("]", "");
                value = $(this).val();
                moti_details[key] = value;
            });
            moti_details['moti_id'] = moti_id;
            var moti_data = $('#moti_id option:selected').html();
            moti_details['moti_name'] = moti_data;
            moti_details['moti_detail_amount'] = moti_detail_amount;

            var new_moti_details = JSON.parse(JSON.stringify(moti_details));
            moti_details_index = $("#moti_details_index").val();
            if (moti_details_index != '') {
                moti_details_objectdata.splice(moti_details_index, 1, new_moti_details);
            } else {
                moti_details_objectdata.push(new_moti_details);
            }
            display_moti_details_html(moti_details_objectdata);
            $("#moti_details_index").val('');
            moti_details_index = '';
            $('#moti_details_id').val('');
            $("#moti_id").val(null).trigger("change");
            $('#moti_weight').val('');
            $('#moti_rate').val('');
            $('#moti_detail_amount').val('');
            edit_moti_details_inc = 0;
            $("#add_moti_details").removeAttr('disabled', 'disabled');
        });

        $(document).on('change',"#charges_id",function(){
            var charges_id = $(this).val();
            rate_on_ct = 1;
            if(charges_id != '') {
                $.ajax({
                    url: "<?= base_url('app/get_charges_detail/') ?>" + charges_id,
                    type: "GET",
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success') {
                            if(response.rate_on_ct == '1'){
                                rate_on_ct = '5';
                            }
                        }
                    }
                });
            }
        });
        $(document).on('click', '#other_charges_details', function () {
            initAjaxSelect2($("#charges_id"), "<?= base_url('app/charges_select2_source/') ?>");
            $('#other_charges_details_model').modal('show');
            setTimeout(function(){ $('#charges_id').select2('open'); }, 200);
            display_other_charges_details_html(other_charges_details_objectdata);
        });
        $('#other_charges_details_model').on('hidden.bs.modal', function () {
            var total_other_charges_details_amount = $('#total_other_charges_details_amount').html() || 0;
            $('#other_charges').val(total_other_charges_details_amount).trigger("change");
            $('#charges_amount').val('');
            setTimeout(function(){ $('#file_upload').focus(); }, 200);
        });
        $(document).on('keyup change', '#charges_weight, #charges_rate', function () {
            var charges_weight = $('#charges_weight').val() || 0;
            var charges_rate = $('#charges_rate').val() || 0;
            var charges_amount = parseFloat(charges_weight) * parseFloat(charges_rate) * rate_on_ct;
            $('#charges_amount').val(charges_amount);
        });
        $(document).on('click', '#add_other_charges_details', function () {
            var charges_id = $("#charges_id").val();
            if (charges_id == '' || charges_id == null) {
                $("#charges_id").select2('open');
                show_notify("Please select Charges For!", false);
                return false;
            }
            var charges_weight = $("#charges_weight").val();
            if (charges_weight == '' || charges_weight == null) {
                show_notify("Weight is required!", false);
                $("#charges_weight").focus();
                return false;
            }
            var charges_rate = $("#charges_rate").val();
            if (charges_rate == '' || charges_rate == null) {
                show_notify("Rate is required!", false);
                $("#charges_rate").focus();
                return false;
            }
            var charges_amount = $("#charges_amount").val();
            if (charges_amount == '' || charges_amount == null) {
                show_notify("Amount is required!", false);
                $("#charges_amount").focus();
                return false;
            }

            $("#add_other_charges_details").attr('disabled', 'disabled');
            var key = '';
            var value = '';
            var other_charges_details = {};
            $('input[name^="other_charges_details_data"]').each(function () {
                key = $(this).attr('name');
                key = key.replace("other_charges_details_data[", "");
                key = key.replace("]", "");
                value = $(this).val();
                other_charges_details[key] = value;
            });
            other_charges_details['charges_id'] = charges_id;
            var charges_data = $('#charges_id option:selected').html();
            other_charges_details['charges_name'] = charges_data;
            other_charges_details['charges_amount'] = charges_amount;

            var new_other_charges_details = JSON.parse(JSON.stringify(other_charges_details));
            other_charges_details_index = $("#other_charges_details_index").val();
            if (other_charges_details_index != '') {
                other_charges_details_objectdata.splice(other_charges_details_index, 1, new_other_charges_details);
            } else {
                other_charges_details_objectdata.push(new_other_charges_details);
            }
            display_other_charges_details_html(other_charges_details_objectdata);
            $("#other_charges_details_index").val('');
            other_charges_details_index = '';
            $('#other_charges_details_id').val('');
            $("#charges_id").val(null).trigger("change");
            $('#charges_weight').val('');
            $('#charges_rate').val('');
            $('#charges_amount').val('');
            edit_other_charges_details_inc = 0;
            $("#add_other_charges_details").removeAttr('disabled', 'disabled');
        });

        $(document).on('click', '.item_photo_modal', function () {
            var src = $(this).data("img_src");
            setTimeout(function () {
                $("#doc_img_src").attr('src', src);
            }, 0);
            $('#viewImageModal').modal('show');
        });

        $(document).on('submit', '#save_tag', function (e) {
            e.preventDefault();
            if ($.trim($("#job_card_id").val()) == '') {
                show_notify('Please select job no.', false);
                $("#job_card_id").select2('open');
                return false;
            }
            if ($.trim($("#item_id").val()) == '') {
                show_notify('Please select Item.', false);
                $("#item_id").select2('open');
                return false;
            }
            if ($.trim($("#gross").val()) == '') {
                show_notify('Please Add Gross.', false);
                $("#gross").focus();
                return false;
            }

            $('#module_submit_btn').prop('disabled',true);
            var post_data = new FormData(this);
            var other_charges_details_objectdata_stringify = JSON.stringify(other_charges_details_objectdata);
            post_data.append('other_charges_details', other_charges_details_objectdata_stringify);
            $.ajax({
                url: "<?= base_url('tag/save_tag') ?>",
                type: "POST",
                processData: false,
                contentType: false,
                cache: false,
                data: post_data,
                success: function (response) {
                    $('.changed-input').removeClass('changed-input');
                    
                    var json = $.parseJSON(response);
                    if (json['error'] == 'Exist') {
                        show_notify(json['error_exist'], false);
                    } else if (json['success'] == 'Added' || json['success'] == 'Updated') {
                        window.location.href = "<?php echo base_url('tag/tag_list') ?>";
                    }
                    $('.module_submit_btn').prop('disabled',false);
                    $('#add_lineitem').prop('disabled',false);
                    return false;
                }
            });
            return false;
        });

    });

    $('body').on('keydown', 'input,select,.select2-search__field, textarea', function(e) {
        var self = $(this)
          , form = self.parents('form:eq(0)')
          , focusable
          , next
          , prev
          ;

        var id = $(this).attr('id');
        if(id == 'add_lineitem'){
            $('#add_lineitem').click();
        } else if (e.shiftKey) {
            if (e.keyCode == 13 && $(this).is("textarea") == false) {
                focusable =   form.find('input,a,select,.select2-search__field,button,textarea').filter(':visible');
                prev = focusable.eq(focusable.index(this)-1);

                if (prev.length) {
                   prev.focus();
                } else {
                    form.submit();
                }
            }
        } else if (e.keyCode == 13 && $(this).is("textarea") == false) {
            id_name = $(this).attr("id");
            if(id_name == 'charges_weight'){
                $('#charges_rate').focus();
            }
            if(id_name == 'charges_rate'){
                $('#charges_amount').focus();
            }
            if(id_name == 'charges_amount'){
                $('#add_other_charges_details').click();
                $('#charges_id').select2('open');
            }
            if(id_name == 'moti_weight'){
                $('#moti_rate').focus();
            }
            if(id_name == 'moti_rate'){
                $('#moti_detail_amount').focus();
            }
            if(id_name == 'moti_detail_amount'){
                $('#add_moti_details').click();
                $('#moti_id').select2('open');
            }
            focusable = form.find('input,a,select,.select2-search__field,button,textarea').filter(':visible');
            next = focusable.eq(focusable.index(this)+1);
            if (next.length) {
                next.focus();
            } else {
                form.submit();
            }
            return false;
        }

    });

    /**
        * WARNING: untested using Select2's option ['selectOnClose'=>true]
        *
        * This code was written because the Select2 widget does not handle
        * tabbing from one form field to another.  The desired behavior is that
        * the user can use [Enter] to select a value from Select2 and [Tab] to move
        * to the next field on the form.
        *
        * The following code moves focus to the next form field when a Select2 'close'
        * event is triggered.  If the next form field is a Select2 widget, the widget
        * is opened automatically.
        *
        * Users that click elsewhere on the document will cause the active Select2
        * widget to close.  To prevent the code from overriding the user's focus choice
        * a flag is added to each element that the users clicks on.  If the flag is
        * active, then the automatic focus script does not happen.
        *
        * To prevent conflicts with multiple Select2 widgets opening at once, a second
        * flag is used to indicate the open status of a Select2 widget.  It was
        * necessary to use a flag instead of reading the class '--open' because using the
        * class '--open' as an indicator flag caused timing/bubbling issues.
        *
        * To simulate a Shift+Tab event, a flag is recorded every time the shift key
        * is pressed.
        */
        var docBody = $(document.body);
        var shiftPressed = false;
        var clickedOutside = false;
        //var keyPressed = 0;

        docBody.on('keydown', function(e) {
            var keyCaptured = (e.keyCode ? e.keyCode : e.which);
            //shiftPressed = keyCaptured == 16 ? true : false;
            if (keyCaptured == 16) { shiftPressed = true; }
        });
        docBody.on('keyup', function(e) {
            var keyCaptured = (e.keyCode ? e.keyCode : e.which);
            //shiftPressed = keyCaptured == 16 ? true : false;
            if (keyCaptured == 16) { shiftPressed = false; }
        });

        docBody.on('mousedown', function(e){
            // remove other focused references
            clickedOutside = false;
            // record focus
            if ($(e.target).is('[class*="select2"]')!=true) {
                clickedOutside = true;
            }
        });

        docBody.on('select2:opening', function(e) {
            // this element has focus, remove other flags
            clickedOutside = false;
            // flag this Select2 as open
            $(e.target).attr('data-s2open', 1);
        });
        docBody.on('select2:closing', function(e) {
            // remove flag as Select2 is now closed
            $(e.target).removeAttr('data-s2open');
        });

        docBody.on('select2:close', function(e) {
            current_select2_id = $(e.target).attr('id');
            var elSelect = $(e.target);
            elSelect.removeAttr('data-s2open');
            var currentForm = elSelect.closest('form');
            var othersOpen = currentForm.has('[data-s2open]').length;
            if (othersOpen == 0 && clickedOutside==false) {
                /* Find all inputs on the current form that would normally not be focus`able:
                 *  - includes hidden <select> elements whose parents are visible (Select2)
                 *  - EXCLUDES hidden <input>, hidden <button>, and hidden <textarea> elements
                 *  - EXCLUDES disabled inputs
                 *  - EXCLUDES read-only inputs
                 */
                var inputs = currentForm.find(':input:enabled:not([readonly], input:hidden, button:hidden, textarea:hidden)')
                    .not(function () {   // do not include inputs with hidden parents
                        return $(this).parent().is(':hidden');
                    });
                var elFocus = null;
                var elFocus_old = null;
                $.each(inputs, function (index) {
                    var elInput = $(this);
                    if (elInput.attr('id') == elSelect.attr('id')) {
                        if ( shiftPressed) { // Shift+Tab
                            elFocus = inputs.eq(index - 1);
                            elFocus_old = inputs.eq(index);
                        } else {
                            elFocus = inputs.eq(index + 1);
                            elFocus_old = inputs.eq(index);
                        }
                        return false;
                    }
                });
                if (elFocus !== null) {
                    // automatically move focus to the next field on the form
                    var isSelect2 = elFocus.siblings('.select2').length > 0;
                    if (isSelect2) {
                        elFocus.select2('open');
                    } else {
                        if(elFocus_old.attr('id') == 'item_id'){
                        } else {
                            elFocus.focus();
                        }
                    }
                }
                if(current_select2_id == 'item_id'){
                    $('#patch').focus();
                }
                if(current_select2_id == 'charges_id'){
                    $('#charges_weight').focus();
                }
            }
        });

        /**
         * Capture event where the user entered a Select2 control using the keyboard.
         * http://stackoverflow.com/questions/20989458
         * http://stackoverflow.com/questions/1318076
         */
        docBody.on('focus', '.select2', function(e) {
            var elSelect = $(this).siblings('select');
            var test1 = elSelect.is('[disabled]');
            var test2 = elSelect.is('[data-s2open]');
            var test3 = $(this).has('.select2-selection--single').length;
            if (elSelect.is('[disabled]')==false && elSelect.is('[data-s2open]')==false
                && $(this).has('.select2-selection--single').length>0) {
                elSelect.attr('data-s2open', 1);
                elSelect.select2('open');
            }
        });

    function display_moti_details_html(moti_details_objectdata) {
        $('#ajax-loader').show();
        var moti_details_html = '';
        var total_moti_details_weight = 0;
        var total_moti_details_amount = 0;

        $.each(moti_details_objectdata, function (index, value) {

            var moti_details_edit_btn = '';
            var moti_details_delete_btn = '';
            var moti_weight = parseFloat(value.moti_weight) || 0;
            var moti_rate = parseFloat(value.moti_rate) || 0;
            var moti_detail_amount = parseFloat(value.moti_detail_amount) || 0;
            moti_details_edit_btn = '<a class="btn btn-xs btn-primary btn-edit-item edit_moti_item edit_moti_details_' + index + '" href="javascript:void(0);" onclick="edit_moti_details(' + index + ')"><i class="fa fa-edit"></i></a> ';
            moti_details_delete_btn = '<a class="btn btn-xs btn-danger btn-delete-item delete_moti_item" href="javascript:void(0);" onclick="remove_moti_details(' + index + ')"><i class="fa fa-trash"></i></a>';
            var row_html = '<tr class="lineitem_index_' + index + '"><td class="">' +
                    moti_details_edit_btn +
                    moti_details_delete_btn +
                    '</td>' +
                    '<td>' + value.moti_name + '</td>' +
                    '<td class="text-right">' + moti_weight.toFixed(3) + '</td>' +
                    '<td class="text-right">' + moti_rate.toFixed(2) + '</td>' +
                    '<td class="text-right">' + moti_detail_amount.toFixed(2) + '</td>';
            total_moti_details_weight = parseFloat(total_moti_details_weight) + parseFloat(moti_weight);
            total_moti_details_amount = parseFloat(total_moti_details_amount) + parseFloat(moti_detail_amount);
            moti_details_html += row_html;
        });
        $('#moti_details_list').html(moti_details_html);
        $('#total_moti_details_weight').html(total_moti_details_weight.toFixed(3));
        $('#total_moti_details_amount').html(total_moti_details_amount.toFixed(2));
        $('#ajax-loader').hide();
    }
    function edit_moti_details(index) {
        $("html, body").animate({scrollTop: 0}, "slow");
        $('#ajax-loader').show();
        $(".delete_moti_item").addClass('hide');
        moti_details_index = index;
        if (edit_moti_details_inc == 0) {
            edit_moti_details_inc = 1;
            $(".add_moti_details").removeAttr("disabled");
        }
        var value = moti_details_objectdata[index];
        $("#moti_details_index").val(index);
        $("#moti_details_delete").val(value.moti_details_delete);
        if(typeof(value.moti_details_id) !== "undefined" && value.moti_details_id !== null) {
            $("#moti_details_id").val(value.moti_details_id);
        }
        $("#moti_id").val(null).trigger("change");
        setSelect2Value($("#moti_id"), "<?= base_url('app/set_moti_select2_val_by_id/') ?>" + value.moti_id);
        $("#moti_weight").val(value.moti_weight);
        $("#moti_rate").val(value.moti_rate);
        $("#moti_detail_amount").val(value.moti_detail_amount);
        $('#ajax-loader').hide();
    }
    function remove_moti_details(index) {
        value = moti_details_objectdata[index];
        if (confirm('Are you sure ?')) {
            moti_details_objectdata.splice(index, 1);
            display_moti_details_html(moti_details_objectdata);
        }
    }

    function display_other_charges_details_html(other_charges_details_objectdata) {
        $('#ajax-loader').show();
        var other_charges_details_html = '';
        var total_other_charges_details_weight = 0;
        var total_other_charges_details_amount = 0;

        $.each(other_charges_details_objectdata, function (index, value) {

            var other_charges_details_edit_btn = '';
            var other_charges_details_delete_btn = '';
            var charges_weight = parseFloat(value.charges_weight) || 0;
            var charges_rate = parseFloat(value.charges_rate) || 0;
            var charges_amount = parseFloat(value.charges_amount) || 0;
            other_charges_details_edit_btn = '<a class="btn btn-xs btn-primary btn-edit-item edit_charges_item edit_other_charges_details_' + index + '" href="javascript:void(0);" onclick="edit_other_charges_details(' + index + ')"><i class="fa fa-edit"></i></a> ';
            other_charges_details_delete_btn = '<a class="btn btn-xs btn-danger btn-delete-item delete_charges_item" href="javascript:void(0);" onclick="remove_other_charges_details(' + index + ')"><i class="fa fa-trash"></i></a>';
            var row_html = '<tr class="lineitem_index_' + index + '"><td class="">' +
                    other_charges_details_edit_btn +
                    other_charges_details_delete_btn +
                    '</td>' +
                    '<td>' + value.charges_name + '</td>' +
                    '<td class="text-right">' + charges_weight.toFixed(3) + '</td>' +
                    '<td class="text-right">' + charges_rate.toFixed(2) + '</td>' +
                    '<td class="text-right">' + charges_amount.toFixed(2) + '</td>';
            total_other_charges_details_weight = parseFloat(total_other_charges_details_weight) + parseFloat(charges_weight);
            total_other_charges_details_amount = parseFloat(total_other_charges_details_amount) + parseFloat(charges_amount);
            other_charges_details_html += row_html;
        });
        $('#other_charges_details_list').html(other_charges_details_html);
        $('#total_other_charges_details_weight').html(total_other_charges_details_weight.toFixed(3));
        $('#total_other_charges_details_amount').html(total_other_charges_details_amount.toFixed(2));
        $('#ajax-loader').hide();
    }
    function edit_other_charges_details(index) {
        $("html, body").animate({scrollTop: 0}, "slow");
        $('#ajax-loader').show();
        $(".delete_charges_item").addClass('hide');
        other_charges_details_index = index;
        if (edit_other_charges_details_inc == 0) {
            edit_other_charges_details_inc = 1;
            $(".add_other_charges_details").removeAttr("disabled");
        }
        var value = other_charges_details_objectdata[index];
        $("#other_charges_details_index").val(index);
        $("#other_charges_details_delete").val(value.other_charges_details_delete);
        if(typeof(value.other_charges_details_id) !== "undefined" && value.other_charges_details_id !== null) {
            $("#other_charges_details_id").val(value.other_charges_details_id);
        }
        $("#charges_id").val(null).trigger("change");
        setSelect2Value($("#charges_id"), "<?= base_url('app/set_charges_select2_val_by_id/') ?>" + value.charges_id);
        $("#charges_weight").val(value.charges_weight);
        $("#charges_rate").val(value.charges_rate);
        $("#charges_amount").val(value.charges_amount);
        $('#ajax-loader').hide();
    }
    function remove_other_charges_details(index) {
        value = other_charges_details_objectdata[index];
        if (confirm('Are you sure ?')) {
            other_charges_details_objectdata.splice(index, 1);
            display_other_charges_details_html(other_charges_details_objectdata);
        }
    }

    function set_jon_card_detail() {
        var job_card_id = $("#job_card_id").val();
        $("#party").val('');
        $("#melting").val('');
        $("#tag_no").val('');

        if(job_card_id != '') {
            $.ajax({
                url: "<?= base_url('app/get_job_card_detail/') ?>" + job_card_id,
                type: "GET",
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                success: function (response) {
                    if(response.status == 'success') {
                        $("#party").val(response.party_name);
                        $("#melting").val(response.melting);        
                        $("#touch").val($("#melting").val()).trigger("change");
                        if(response.design_text != '' && response.design_text != null){
                            $("#tag_no").val(response.design_text + '' + response.design_no);
                        } else {
                            $("#tag_no").val('');
                        }
                        setSelect2Value($("#item_id"),"<?=base_url('app/set_item_select2_val_by_id/')?>" + response.item_id);
                    } 
                }
            });
        }
    }

    function upload_file_upload(input) {
        if (input.files && input.files[0]) {
//            console.log(input.files);
            $("#ajax-loader").show();
            var form = new FormData();
            var myFormData = document.getElementById('file_upload').files[0];
            form.append('file_upload', myFormData);
            form.append('action', 'get_temp_path');
            $.ajax({
                type: 'POST',
                processData: false,
                contentType: false,
                data: form,
                url: "<?= base_url('tag/get_temp_path_image') ?>",
                success: function (html) {
                    $('#image').val(html);
                    $("#ajax-loader").hide();
                }
            });
        }
    }
</script>
<?php
    $this->load->view('footer');
?>