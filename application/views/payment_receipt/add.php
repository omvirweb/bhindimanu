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
                Add Payment / Receipt
                <?php $isView = $this->app_model->have_access_role(PAYMENT_RECEIPT_MODULE_ID, "view"); ?>
                <?php if($isView) { ?>
                    <a href="<?= base_url('payment_receipt/payment_receipt_list') ?>" class="btn btn-primary btn-sm float-right" style="margin: 5px;">Payment Receipt List</a>
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
                    <form id="save_payment_receipt" class="form-horizontal" action=""  method="post"  novalidate enctype="multipart/form-data">
                        <input type="hidden" name="payment_receipt_id" id="payment_receipt_id" value="<?php echo isset($payment_receipt_row->payment_receipt_id) ? $payment_receipt_row->payment_receipt_id : ''; ?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 pr-0">
                                    <div class="form-group">
                                        <label for="job_worker_id"> Person<span style="color:red"> *</span></label>
                                        <select class="form-control" name="job_worker_id" id="job_worker_id"></select>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="payment_receipt_date"> Date<span style="color:red"> *</span></label>
                                        <input type="text" name="payment_receipt_date" id="payment_receipt_date" class="form-control" value="<?php echo isset($payment_receipt_row->payment_receipt_date) ? date('d-m-Y', strtotime($payment_receipt_row->payment_receipt_date)) : date('d-m-Y'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="remark"> Remark</label>
                                        <textarea name="remark" id="remark" class="form-control"><?php echo isset($payment_receipt_row->remark) ? $payment_receipt_row->remark : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group"><br>
                                        <label for=""> For Weight</label>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="item_id"> Item</label>
                                        <select class="form-control" name="item_id" id="item_id"></select>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="weight_jama_udhar"> Jama/Udhar</label>
                                        <select name="weight_jama_udhar" id="weight_jama_udhar" class="form-control">
                                            <option value="1" <?php echo (isset($payment_receipt_row->weight_jama_udhar) && $payment_receipt_row->weight_jama_udhar == '1') ? 'Selected' : ''; ?>>Jama</option>
                                            <option value="2" <?php echo (isset($payment_receipt_row->weight_jama_udhar) && $payment_receipt_row->weight_jama_udhar == '2') ? 'Selected' : ''; ?>>Udhar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="weight"> Weight</label>
                                        <input type="text" name="weight" id="weight" class="form-control num_only" value="<?php echo isset($payment_receipt_row->weight) ? $payment_receipt_row->weight : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="touch"> Touch</label>
                                        <input type="text" name="touch" id="touch" class="form-control num_only" value="<?php echo isset($payment_receipt_row->touch) ? $payment_receipt_row->touch : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="fine"> Fine</label>
                                        <input type="text" name="fine" id="fine" class="form-control num_only" readonly="" value="<?php echo isset($payment_receipt_row->fine) ? $payment_receipt_row->fine : ''; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group"><br>
                                        <label for=""> For Amount</label>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="amount_jama_udhar"> Jama/Udhar</label>
                                        <select name="amount_jama_udhar" id="amount_jama_udhar" class="form-control">
                                            <option value="1" <?php echo (isset($payment_receipt_row->amount_jama_udhar) && $payment_receipt_row->amount_jama_udhar == '1') ? 'Selected' : ''; ?>>Jama</option>
                                            <option value="2" <?php echo (isset($payment_receipt_row->amount_jama_udhar) && $payment_receipt_row->amount_jama_udhar == '2') ? 'Selected' : ''; ?>>Udhar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="amount"> Amount</label>
                                        <input type="text" name="amount" id="amount" class="form-control num_only" value="<?php echo isset($payment_receipt_row->amount) ? $payment_receipt_row->amount : ''; ?>">
                                    </div>
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

    $(document).ready(function(){
        $('#payment_receipt_date').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: "linked",
            todayHighlight: true,
            autoclose: true
        });

        initAjaxSelect2($("#job_worker_id"), "<?= base_url('app/job_worker_select2_source') ?>");
        <?php  if(isset($payment_receipt_row->job_worker_id)){ ?>
            setSelect2Value($("#job_worker_id"),"<?=base_url('app/set_job_worker_select2_val_by_id/'.$payment_receipt_row->job_worker_id)?>");
        <?php } else { ?>
            $('#job_worker_id').select2('open');
        <?php } ?>
        initAjaxSelect2($("#item_id"), "<?= base_url('app/item_select2_source') ?>");
        <?php if(isset($payment_receipt_row->item_id)){ ?>
            setSelect2Value($("#item_id"),"<?=base_url('app/set_item_select2_val_by_id/'.$payment_receipt_row->item_id)?>");
        <?php } ?>
        
        $(document).on('input','#weight,#touch',function () {
            var weight = parseFloat($("#weight").val()) || 0;
            var touch = parseFloat($("#touch").val()) || 0;
            var fine = (weight * touch) / 100;
            $("#fine").val(fine.toFixed(3));
        });

        $(document).on('submit', '#save_payment_receipt', function (e) {
            e.preventDefault();

            if ($.trim($("#job_worker_id").val()) == '') {
                show_notify('Please Select Person', false);
                $("#job_worker_id").select2('open');
                return false;
            }

            $('#module_submit_btn').prop('disabled',true);
            var post_data = new FormData(this);
            $.ajax({
                url: "<?= base_url('payment_receipt/save_payment_receipt') ?>",
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
                        window.location.href = "<?php echo base_url('payment_receipt/payment_receipt_list') ?>";
                    }
                    $('.module_submit_btn').prop('disabled',false);
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
                    $('#weight_jama_udhar').focus();
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

</script>
<?php
    $this->load->view('footer');
?>