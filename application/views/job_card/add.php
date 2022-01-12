<?php
    $this->load->view('header');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Job Card Entry</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" id="body-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <form id="module_form" class="form-horizontal" action=""  method="post"  novalidate enctype="multipart/form-data">
                        <input type="hidden" name="job_card_id" id="job_card_id" value="<?=isset($job_card_row->job_card_id)?$job_card_row->job_card_id:0?>">
                        <div class="card-body">
                        
                            <div class="row">
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="party_id"> Party<span style="color:red"> *</span></label>
                                        <select name="party_id" id="party_id" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="job_card_no"> Job No<span style="color:red"> *</span></label>
                                        <input type="text" class="form-control" name="job_card_no" id="job_card_no" value="<?php echo isset($job_card_row->job_card_no) ? $job_card_row->job_card_no : $job_card_no; ?>">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="melting"> Melting<span style="color:red"> *</span></label>
                                        <input type="text" class="form-control num_only" name="melting" id="melting" value="<?=isset($job_card_row->melting)?$job_card_row->melting:'92'?>">
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="order_date"> Order Date<span style="color:red"> *</span></label>
                                        <input type="text" class="form-control input-datepicker" name="order_date" id="order_date" value="<?=isset($job_card_row->order_date)?date("d-m-Y",strtotime($job_card_row->order_date)):date('d-m-Y')?>">
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="delivery_date"> Delivery Date</label>
                                        <input type="text" class="form-control input-datepicker" name="delivery_date" id="delivery_date" value="<?=isset($job_card_row->delivery_date) && strtotime($job_card_row->delivery_date) > 0?date("d-m-Y",strtotime($job_card_row->delivery_date)):''?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="remark"> Remark</label>
                                        <textarea name="remark" id="remark" class="form-control"><?=isset($job_card_row->remark)?$job_card_row->remark:''?></textarea>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row line_item_form item_fields_div">
                                <input type="hidden" name="line_items_data[job_card_item_id]" id="job_card_item_id" value="0">
                                <input type="hidden" name="line_items_index" id="line_items_index" />
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="item_id"> Item<span style="color:red"> *</span></label>
                                        <select class="form-control" name="line_items_data[item_id]" id="item_id"></select>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="design_no"> Design No</label><br>
                                        <span id="design_textno"></span>
                                        <input type="hidden" name="line_items_data[design_text]" id="design_text" value="">
                                        <input type="hidden" name="line_items_data[design_no]" id="design_no" value="">
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="qty"> Qty<span style="color:red"> *</span></label>
                                        <input type="text" name="line_items_data[qty]" id="qty" class="form-control num_only">
                                        <label class="d-none">Total Qty : <span id="total_qty"></span></label>
                                        <input type="hidden" id="total_design" value="0">
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="weight"> Weight</label>
                                        <input type="text" name="line_items_data[weight]" id="weight" class="form-control num_only">
                                        <label class="d-none">Weight Qty : <span id="total_weight"></span></label>
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <label for="file_upload">Image</label>
                                    <input type="file" name="line_items_data[file_upload]" id="file_upload" class="from-control" onchange="upload_file_upload(this);" accept="image/*" value="" style="width: 90px;">
                                    <input type="hidden" name="line_items_data[item_photo]" id="image" class="from-control">
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="item_remark"> Remark</label>
                                        <textarea name="line_items_data[item_remark]" id="item_remark" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" id="add_lineitem" class="btn btn-info add_lineitem" style="margin-top: 33px;">Add</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th class="text-right">Sr. No</th>
                                                    <th>Item</th>
                                                    <th>Design No</th>
                                                    <th class="text-right">Qty</th>
                                                    <th class="text-right d-none">Total Qty</th>
                                                    <th class="text-right">Weight</th>
                                                    <th class="text-right d-none">Total Weight</th>
                                                    <th>Remark</th>
                                                    <th>Image</th>
                                                </tr>
                                            </thead>
                                            <tbody id="lineitem_list"></tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Total:</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th id="total_quantity" class="text-right d-none"></th>
                                                    <th></th>
                                                    <th id="table_total_weight" class="text-right d-none"></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="module_submit_btn" class="btn btn-info float-right">Save</button>
                        </div>
                    </form>
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

    var lineitem_objectdata = [];

    $(document).ready(function(){
        <?php if (isset($lineitem_objectdata)) { ?>
        var li_lineitem_objectdata = <?php echo $lineitem_objectdata; ?>;
        if (li_lineitem_objectdata != '') {
            $.each(li_lineitem_objectdata, function (index, value) {
                lineitem_objectdata.push(value);
            });
        }
        <?php } ?>
        display_lineitem_html(lineitem_objectdata);

        initAjaxSelect2($("#party_id"), "<?= base_url('app/party_select2_source') ?>");
        initAjaxSelect2($("#item_id"), "<?= base_url('app/item_select2_source') ?>");
        
        <?php if(isset($job_card_row->party_id)){ ?>
            setSelect2Value($("#party_id"),"<?=base_url('app/set_party_select2_val_by_id/'.$job_card_row->party_id)?>");
        <?php } else { ?>
            $('#party_id').select2('open');
        <?php }  ?>

        $(document).on('change',"#item_id",function(){
            var item_id = $(this).val();
//            var line_items_index = $("#line_items_index").val();
            var job_card_item_id = $("#job_card_item_id").val();
//            if(line_items_index != '' && job_card_item_id != '0'){
//            if(line_items_index == ''){
//            if(lineitem_objectdata[0].item_id != item_id){
                $("#design_textno").val('');
                $("#design_text").val('');
                $("#design_no").val('');
                if(item_id != '') {
                    $.ajax({
                        url: "<?= base_url('app/get_item_and_max_design_no/') ?>" + item_id + '/' + job_card_item_id,
                        type: "GET",
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: 'json',
                        success: function (response) {
                            if(response.status == 'success') {
                                $("#design_text").val(response.short_name);
                                $("#design_no").val(response.design_no);
                                $("#design_textno").html(response.short_name + '' + response.design_no);
                            }
                            return false;
                        }
                    });
                }
//            }
        });

        $(document).on('change',"#design_ids",function(){
            var select_data = $(this).select2('data');
            var j = 0;
            $(select_data).each(function(index,value){
                j++;
            });
            $('#total_design').val(j);
            var qty = $("#qty").val() || 0;
            var total_qty = parseInt(qty) * parseInt(j);
            $('#total_qty').html(total_qty);

            var weight = $("#weight").val() || 0;
            var total_weight = parseFloat(weight) * parseInt(total_qty);
            $('#total_weight').html(total_weight.toFixed(3));    
        });

        $(document).on('input',"#qty",function(){
            var qty = $(this).val() || 0;
            var total_design = $('#total_design').val() || 0;
            var total_qty = parseInt(qty) * parseInt(total_design);
            $('#total_qty').html(total_qty);

            var weight = $("#weight").val() || 0;
            var total_weight = parseFloat(weight) * parseInt(total_qty);
            $('#total_weight').html(total_weight.toFixed(3));
        });

        $(document).on('input',"#weight",function(){
            var weight = $("#weight").val() || 0;
            var total_qty = $("#total_qty").text() || 0;
            var total_weight = parseFloat(weight) * parseInt(total_qty);
            $('#total_weight').html(total_weight.toFixed(3));
        });

        $(document).on('click', '.item_photo_modal', function () {
            var src = $(this).data("img_src");
            setTimeout(function () {
                $("#doc_img_src").attr('src', src);
            }, 0);
            $('#viewImageModal').modal('show');
        });

        $(document).on('click','#add_lineitem',function () {

            var line_items_index = $("#line_items_index").val();
            if(line_items_index == '' && lineitem_objectdata.length >= 1) {
                show_notify('Allow Only One Item to Add.', false);
                return false;
            }

            var key = '';
            var keys = '';
            var value = '';
            var lineitem = {};
            var is_validate = '0';
            var qty = 0;
            var weight = 0.0;
            
            $('[name^="line_items_data"]').each(function (index) {
                key = $(this).attr('name');
                key = key.replace("line_items_data[", "");
                key = key.replace("]", "");
                
                if(key == 'item_id'){
                    if($.trim($(this).val()) == '' || $.trim($(this).val()) == null){
                        is_validate = '1';
                        show_notify('Please select item.', false);
                        return false;
                    }
                }
//                if(key == 'design_ids'){
//                    if($.trim($(this).val()) == '' || $.trim($(this).val()) == null){
//                        is_validate = '1';
//                        show_notify('Please select design no.', false);
//                        return false;
//                    }
//                }

                if(key == 'qty'){
                    if($.trim($(this).val()) == ''){
                        is_validate = '1';
                        show_notify('Please enter qty.', false);
                        return false;
                    } else {
                        qty = $(this).val();
                    }
                }

                if(key == 'weight'){
                    if($.trim($(this).val()) == ''){
                    } else {
                        weight = $(this).val();
                    }
                }
            });

            if(is_validate == '1'){
                return false;
            } 

            lineitem["total_qty"] = 0;
            $('select[name^="line_items_data"]').each(function (e) {
                key = $(this).attr('name');
                key = key.replace("line_items_data[", "");
                key = key.replace("]", "");
                value = $(this).val();
                lineitem[key] = value;
                var select_data = $(this).select2('data');
                if(key == "item_id") {
                    lineitem[key + "_text"] = select_data[0].text;
                }

                if(key == "design_ids") {
                    var design_ids_text = '';
                    var j = 0;
                    $(select_data).each(function(index,value){
                        if(index != 0) {
                            design_ids_text += ',';
                        }
                        design_ids_text += value.text;
                        j++;
                    });
                    lineitem[key + "_text"] = design_ids_text;
                    lineitem["total_qty"] = parseInt(qty) * parseInt(j);
                    lineitem["total_weight"] = parseFloat(weight) * parseInt(qty) * parseInt(j);
                }
            });
            
            $('input[name^="line_items_data"]').each(function () {
                key = $(this).attr('name');
                key = key.replace("line_items_data[", "");
                key = key.replace("]", "");
                value = $(this).val();
                lineitem[key] = value;
            });
            
            $('textarea[name^="line_items_data"]').each(function () {
                key = $(this).attr('name');
                key = key.replace("line_items_data[", "");
                key = key.replace("]", "");
                value = $(this).val();
                lineitem[key] = value;
            });

            if (line_items_index != '') {
                if(lineitem['item_photo'] == '' || lineitem['item_photo'] == null){
                    lineitem['item_photo'] = lineitem_objectdata[line_items_index].item_photo;
                }
            }
            var new_lineitem = JSON.parse(JSON.stringify(lineitem));
            if (line_items_index != '') {
                lineitem_objectdata.splice(line_items_index, 1, new_lineitem);
            } else {
                lineitem_objectdata.push(new_lineitem);
            }

            display_lineitem_html(lineitem_objectdata);
            $("#item_id").val(null).trigger("change");
            $("#design_textno").html('');
            $("#design_text").val('');
            $("#design_no").val('');
            $("#qty").val(null).trigger("change");
            $("#weight").val(null).trigger("change");
            $("#item_remark").val(null).trigger("change");
            $("#file_upload").val('');
            $("#image").val('');
            $("#job_card_item_id").val(0);
            $("#line_items_index").val('');
        });

        $(document).on('submit', '#module_form', function (e) {
            e.preventDefault();

            if ($.trim($("#job_card_no").val()) == '') {
                show_notify('Please Enter Job No.', false);
                $("#job_card_no").focus();
                return false;
            }

            if ($.trim($("#party_id").val()) == '') {
                show_notify('Please Enter Party.', false);
                $("#party_id").select2('open');
                return false;
            }

            if ($.trim($("#melting").val()) == '') {
                show_notify('Please Enter Melting.', false);
                $("#melting").focus();
                return false;
            }

            if ($.trim($("#order_date").val()) == '') {
                show_notify('Please Select Order Date.', false);
                $("#order_date").focus();
                return false;
            }

            if(lineitem_objectdata.length == 0) {
                show_notify('Please Add Item.', false);
                $("#item_id").select2('open');
                return false;
            }

            $('#module_submit_btn').prop('disabled',true);
            $('#add_lineitem').prop('disabled',true);

            var post_data = new FormData(this);
            var lineitem_object_data_stringify = JSON.stringify(lineitem_objectdata);
            post_data.append('job_card_items', lineitem_object_data_stringify);
            $.ajax({
                url: "<?= base_url('job_card/save_job_card') ?>",
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
                        window.location.href = "<?php echo base_url('job-card/job-card-list') ?>";
                    }
                    $('#module_submit_btn').prop('disabled',false);
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
                    $('#qty').focus();
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

    function display_lineitem_html(lineitem_objectdata) {
        var new_lineitem_html = '';
//        console.log(lineitem_objectdata);
        var total_qty = 0;
        var total_weight = 0;
        $.each(lineitem_objectdata, function (index, value) {
            var lineitem_edit_btn = '';
            var lineitem_delete_btn = '';

            var total_qtyy = parseFloat(value.total_qty) || 0;
            var total_weightt = parseFloat(value.total_weight) || 0;

            lineitem_edit_btn = '<a class="btn btn-xs btn-primary btn-edit-item edit_lineitem_' + index + '" href="javascript:void(0);" onclick="edit_lineitem(' + index + ')"><i class="fa fa-edit"></i></a> ';
            lineitem_delete_btn = '<a class="btn btn-xs btn-danger btn-delete-item" href="javascript:void(0);" onclick="remove_lineitem(' + index + ')"><i class="fa fa-trash"></i></a>';
            var sr_no = +index + 1;
            var weight = parseFloat(value.weight) || 0;
            var row_html = '<tr class="lineitem_index_' + index + '">';
            row_html += '<td>' + lineitem_edit_btn + lineitem_delete_btn + '</td>' +
                    '<td class="text-right">' + sr_no + '</td>' +
                    '<td>' + value.item_id_text + '</td>' +
                    '<td>' + value.design_text + '' + value.design_no + '</td>' +
                    '<td class="text-right">' + value.qty + '</td>'+
                    '<td class="text-right d-none">' + total_qtyy + '</td>'+
                    '<td class="text-right">' + weight.toFixed(3) + '</td>'+
                    '<td class="text-right d-none">' + total_weightt.toFixed(3) + '</td>'+
                    '<td>' + value.item_remark + '</td>';
            row_html += '<td>';
            if (value.item_photo !== null && value.item_photo !== '') {
                var value_item_photo = value.item_photo;
                var img_url = '<?php echo base_url(); ?>' + 'uploads/job_card_item_photo/' + value.item_photo;
                row_html += '<a href="javascript:void(0)" class="btn btn-xs btn-primary item_photo_modal" data-img_src="' + img_url + '" ><i class="fa fa-image"></i></a>';
            } else {
                row_html += '-';
            }
            row_html += '</td>';
            row_html += '</tr>';
            new_lineitem_html += row_html;
            total_qty = parseFloat(total_qty) + parseFloat(total_qtyy)
            total_weight = parseFloat(total_weight) + parseFloat(total_weightt)
        });
        $('tbody#lineitem_list').html(new_lineitem_html);
        $('#total_quantity').html(total_qty);
        $('#table_total_weight').html(total_weight.toFixed(3));
    }

    function edit_lineitem(index) {
        var value = lineitem_objectdata[index];
        $("#line_items_index").val(index);
        $("#job_card_item_id").val(value.job_card_item_id).trigger("change");
        if (typeof (value.id) != "undefined" && value.id !== null) {
            $("#id").val(value.id);
        }
        //console.log(value);

        var newOption = new Option(value.item_id_text, value.item_id, true, true);
        $('#item_id').append(newOption).trigger('change');
        $('#design_textno').html(value.design_textno);
        $('#design_text').val(value.design_text);
        $('#design_no').val(value.design_no);

//        var design_ids = value.design_ids;
//        var design_ids_text = value.design_ids_text;
//        design_ids_text = design_ids_text.split(',');
//
//        $('#design_ids').html('');
//        $.each(design_ids,function(ind,element){
//            var newOption = new Option(design_ids_text[ind], design_ids[ind], true, true);
//            $('#design_ids').append(newOption); 
//        });
//        $('#design_ids').trigger('change');
        

        $("#qty").val(value.qty).trigger("change");
        $("#weight").val(value.weight).trigger("change");
        $("#item_remark").val(value.item_remark).trigger("change");

        var qty = $("#qty").val() || 0;
        var total_design = $('#total_design').val() || 0;
        var total_qty = parseInt(qty) * parseInt(total_design);
        $('#total_qty').html(total_qty);
        var weight = $("#weight").val() || 0;
        var total_weight = parseFloat(weight) * parseInt(qty) * parseInt(total_design);
        $('#total_weight').html(total_weight.toFixed(3));
    }

    function remove_lineitem(index) {
        if (confirm('Are you sure ?')) {
            value = lineitem_objectdata[index];
            if (typeof (value.lineitem_id) != "undefined" && value.lineitem_id !== null) {
                $('.line_item_form').append('<input type="hidden" name="deleted_lineitem_id[]" id="deleted_lineitem_id" value="' + value.lineitem_id + '" />');
            }
            lineitem_objectdata.splice(index, 1);
            display_lineitem_html(lineitem_objectdata);
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
                url: "<?= base_url('job_card/get_temp_path_image') ?>",
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