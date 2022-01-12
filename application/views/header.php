<?php
if (isset($this->session->userdata()['bansijew_is_logged_in']) && !empty($this->session->userdata()['bansijew_is_logged_in'])) {
    $logged_in_name = $this->session->userdata()['bansijew_is_logged_in']['user_name'];
}
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
$segment3 = $this->uri->segment(3);
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo PACKAGE_NAME; ?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/adminlte.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/datepicker/datepicker3.css">
  <!-------- /Parsleyjs --------->
  <link href="<?= base_url('assets/plugins/parsleyjs/src/parsley.css'); ?>" rel="stylesheet" type="text/css" />
  <!-- Toastr -->
  <link href="<?= base_url('assets/plugins/toastr/toastr.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('assets/plugins/s2/select2.css');?>">
  <!-- notify -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins/notify/jquery.growl.css');?>">
  <!-- Package Custom CSS -->
  <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/custom.css?v=2">
  
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/media/css/jquery.dataTables.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/extensions/Scroller/css/scroller.dataTables.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css">

  <!-- jQuery -->
  <script src="<?= base_url();?>assets/plugins/jquery/jquery.min.js?v=1"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url();?>assets/dist/js/adminlte.min.js"></script>
  <!-- datepicker -->
  <script src="<?= base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="<?=base_url()?>assets/plugins/s2/select2.full.js"></script>
  <!-- notify -->
  <script src="<?=base_url('assets/plugins/notify/jquery.growl.js');?>"></script>

  <!-- REQUIRED SCRIPTS -->
<!-------- /Parsleyjs --------->
<script src="<?= base_url('assets/plugins/parsleyjs/dist/parsley.min.js');?>"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/plugins/toastr/toastr.min.js');?>"></script>
<!-- DataTables -->
<script src="<?=base_url('assets/plugins/datatables/media/js/jquery.dataTables.min.js');?>"></script>
<script src="<?=base_url('assets/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js');?>"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.colVis.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/jszip.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/pdfmake.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/vfs_fonts.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('input', ".num_only", function () {
            this.value = this.value.replace(/[^\d\.\-]/g, '');
        });
        
        $(":input").attr('autocomplete','off');

        $(document).on('input', ".positive_num_only", function () {
            this.value = this.value.replace(/[^\d\.]/g, '');
        });

        $("input").attr("autocomplete", "off");        
        $("textarea").attr("autocomplete", "off");

        $('.input-datepicker').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: "linked",
            todayHighlight: true,
            autoclose: true
        });
    });
    /**
        * @param $selector
        * @constructor
    */
    function initAjaxSelect2($selector,$source_url)
    {
        $selector.select2({
            placeholder: " --Select-- ",
            allowClear: true,
            width:"100%",
            ajax: {
                url: $source_url,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data,params) {
                    params.page = params.page || 1;
                    return {
                        results: data.results,
                        pagination: {
                            more: (params.page * 5) < data.total_count
                        }
                    };
                },
                cache: true
            }
        });
    }

    function initAjaxSelect3($selector,$source_url,$container_type,$new_edit)
    {
        $selector.select2({
            placeholder: " --Select-- ",
            allowClear: true,
            width:"100%",
            ajax: {
                url: $source_url,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page,
                        container_type: $container_type,
                        new_edit: $new_edit
                    };
                },
                processResults: function (data,params) {
                    params.page = params.page || 1;
                    return {
                        results: data.results,
                        pagination: {
                            more: (params.page * 5) < data.total_count
                        }
                    };
                },
                cache: true
            }
        });
    }

    function setSelect2Value($selector,$source_url)
    {
        if($source_url != '') {
            $.ajax({
                url: $source_url,
                type: "GET",
                data: null,
                contentType: false,
                cache: false,
                async: false,
                processData: false,
                dataType: 'json',
                success: function (data) {
                    if (data.success == true) {
                        $selector.empty().append($('<option/>').val(data.id).text(data.text)).val(data.id).trigger("change");
                    }
                }
            });
        } else {
            $selector.empty().append($('<option/>').val('').text('--select--')).val('').trigger("change");
        }
    }
    function setSelect2MultiValue($selector,$source_url)
    {
        if($source_url != '') {
            $.ajax({
                url: $source_url,
                type: "GET",
                data: null,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function (data) {
                    if (data.success == true) {
                                                var selectValues = data[0];
                                                $.each(selectValues, function(key, value) {   
                                                        $selector.select2("trigger", "select", {
                                                                data: value
                                                        });
                                                });
                    }
                }
            });
        } else {
            $selector.empty().append($('<option/>').val('').text('--select--')).val('').trigger("change");
        }
    }
    //Tags
    function initAjaxSelect2Tags($selector,$source_url)
    {
        $selector.select2({
            placeholder: " --Select-- ",
            allowClear: true,
            width:"100%",
            tags: true,
            multiple: true,
            maximumSelectionLength: 1,
            ajax: {
                url: $source_url,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data,params) {
                    params.page = params.page || 1;
                    return {
                        results: data.results,
                        pagination: {
                            more: (params.page * 5) < data.total_count
                        }
                    };
                },
                cache: true
            }
        });
    }
    function show_notify(notify_msg,notify_type)
    {
        if(notify_type == true){
            $.growl.notice({ title:"Success!",message:notify_msg});
        } else {
            $.growl.error({ title:"False!",message:notify_msg});
        }
    }
</script>
  <style type="text/css">
      .header-container {
        margin: 0;
      }
  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-lg navbar-light navbar-white">
    <div class="container" style="display: contents !important;">
      <a href="<?= base_url();?>" class="navbar-brand">
        <span class="brand-text"><?=PACKAGE_NAME?></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
              <a href="<?= base_url();?>" class="nav-link">Dashboard</a>
            </li>
            <?php if($this->applib->have_access_role(MASTER_MODULE_ID,"view")) { ?>
                <li class="nav-item dropdown <?= ($segment1 == 'master') ? 'active' : '' ?>">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Master</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow <?= ($segment1 == 'master') ? 'active' : '' ?>">
                        <?php if ($this->applib->have_access_role(PARTY_MODULE_ID, "edit") || $this->applib->have_access_role(PARTY_MODULE_ID, "view") || $this->applib->have_access_role(PARTY_MODULE_ID, "add") || $this->applib->have_access_role(PARTY_MODULE_ID, "delete")) { ?>
                            <li><a href="<?= base_url(); ?>master/party/" class="dropdown-item <?= ($segment1 == 'master' && $segment2 == 'party') ? 'active' : '' ?>">Party</a></li>
                        <?php } ?>
                        <?php if ($this->applib->have_access_role(ITEM_MODULE_ID, "edit") || $this->applib->have_access_role(ITEM_MODULE_ID, "add") || $this->applib->have_access_role(ITEM_MODULE_ID, "view") || $this->applib->have_access_role(ITEM_MODULE_ID, "delete")) { ?>
                            <li><a href="<?= base_url(); ?>master/item/" class="dropdown-item <?= ($segment1 == 'master' && $segment2 == 'item') ? 'active' : '' ?>">Item</a></li>
                        <?php } ?>
                        <?php if ($this->applib->have_access_role(PROCESS_MASTER_MODULE_ID, "edit") || $this->applib->have_access_role(PROCESS_MASTER_MODULE_ID, "add") || $this->applib->have_access_role(PROCESS_MASTER_MODULE_ID, "view") || $this->applib->have_access_role(PROCESS_MASTER_MODULE_ID, "delete")) { ?>
                            <li><a href="<?= base_url(); ?>master/process_master/" class="dropdown-item <?= ($segment1 == 'master' && $segment2 == 'process_master') ? 'active' : '' ?>">Process Master</a></li>
                        <?php } ?>
                        <?php if ($this->applib->have_access_role(JOB_WORKER_MODULE_ID, "edit") || $this->applib->have_access_role(JOB_WORKER_MODULE_ID, "add") || $this->applib->have_access_role(JOB_WORKER_MODULE_ID, "view") || $this->applib->have_access_role(JOB_WORKER_MODULE_ID, "delete")) {?>
                            <li><a href="<?= base_url(); ?>master/job_worker/" class="dropdown-item <?= ($segment1 == 'master' && $segment2 == 'job_worker') ? 'active' : '' ?>">Person</a></li>
                        <?php } ?>
                        <?php if ($this->applib->have_access_role(MOTI_MODULE_ID, "edit") || $this->applib->have_access_role(MOTI_MODULE_ID, "add") || $this->applib->have_access_role(MOTI_MODULE_ID, "view") || $this->applib->have_access_role(MOTI_MODULE_ID, "delete")) { ?>
                            <li><a href="<?= base_url(); ?>master/moti/" class="dropdown-item <?= ($segment1 == 'master' && $segment2 == 'moti') ? 'active' : '' ?>">Moti</a></li>
                        <?php } ?>
                        <?php if ($this->applib->have_access_role(CHARGES_MODULE_ID, "edit") || $this->applib->have_access_role(CHARGES_MODULE_ID, "add") || $this->applib->have_access_role(CHARGES_MODULE_ID, "view") || $this->applib->have_access_role(CHARGES_MODULE_ID, "delete")) { ?>
                            <li><a href="<?= base_url(); ?>master/charges/" class="dropdown-item <?= ($segment1 == 'master' && $segment2 == 'charges') ? 'active' : '' ?>">Charges</a></li>
                        <?php } ?>
                        <?php if ($this->applib->have_access_role(USER_MODULE_ID, "edit") || $this->applib->have_access_role(USER_MODULE_ID, "add") || $this->applib->have_access_role(USER_MODULE_ID, "view") || $this->applib->have_access_role(USER_MODULE_ID, "delete")) { ?>
                            <li><a href="<?= base_url(); ?>master/user/" class="dropdown-item <?= ($segment1 == 'master' && $segment2 == 'user') ? 'active' : '' ?>">User</a></li>
                        <?php } ?>
                        <?php if ($this->app_model->have_access_role(USER_RIGHTS_MODULE_ID, "allow")) { ?>
                            <li><a href="<?= base_url(); ?>master/user_rights/" class="dropdown-item <?= ($segment1 == 'master' && $segment2 == 'user_rights') ? 'active' : '' ?>">User Rights</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if($this->applib->have_access_role(JOB_CARD_ENTRY_MODULE_ID,"view")) { ?>
                <li class="nav-item dropdown <?= ($segment1 == 'job_card') ? 'active' : '' ?>">
                    <a id="dropdownSubMenuJobCard" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Job Card</a>
                    <ul aria-labelledby="dropdownSubMenuJobCard" class="dropdown-menu border-0 shadow <?= ($segment1 == 'job_card') ? 'active' : '' ?>">
                        <?php if($this->applib->have_access_role(JOB_CARD_ENTRY_MODULE_ID,"add") || $this->applib->have_access_role(JOB_CARD_ENTRY_MODULE_ID,"edit")) { ?>
                            <li><a href="<?php echo base_url() ?>job_card/add/" class="dropdown-item <?= ($segment1 == 'job_card' && $segment2 == 'add') ? 'active' : '' ?>"><i class="fa fa-plus"></i> Add Job Card</a></li>
                        <?php } ?>
                        <?php if($this->applib->have_access_role(JOB_CARD_ENTRY_MODULE_ID,"view")) { ?>
                            <li><a href="<?php echo base_url() ?>job_card/job_card_list/" class="dropdown-item <?= ($segment1 == 'job_card' && $segment2 == 'job_card_list') ? 'active' : '' ?>"><i class="fa fa-list"></i> Job Card List</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if($this->applib->have_access_role(MANUFACTURE_MODULE_ID,"view")) { ?>
                <li class="nav-item dropdown <?= ($segment1 == 'manufacture' || $segment1 == 'tag' || $segment1 == 'sell') ? 'active' : '' ?>">
                    <a id="dropdownSubMenuMabufacture" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Manufacture</a>
                    <ul aria-labelledby="dropdownSubMenuMabufacture" class="dropdown-menu border-0 shadow <?= ($segment1 == 'manufacture') ? 'active' : '' ?>">
                        <?php if($this->applib->have_access_role(MANUFACTURE_MODULE_ID,"add") || $this->applib->have_access_role(MANUFACTURE_MODULE_ID,"edit")) { ?>
                            <li><a href="<?php echo base_url() ?>manufacture/add/" class="dropdown-item <?= ($segment1 == 'manufacture' && $segment2 == 'add') ? 'active' : '' ?>"><i class="fa fa-plus"></i> Add Manufacture</a></li>
                        <?php } ?>
                        <?php if($this->applib->have_access_role(MANUFACTURE_MODULE_ID,"view")) { ?>
                            <li><a href="<?php echo base_url() ?>manufacture/manufacture_list/" class="dropdown-item <?= ($segment1 == 'manufacture' && $segment2 == 'manufacture_list') ? 'active' : '' ?>"><i class="fa fa-list"></i> Manufacture List</a></li>
                        <?php } ?>
                        <?php if($this->applib->have_access_role(MANUFACTURE_MODULE_ID,"add") || $this->applib->have_access_role(MANUFACTURE_MODULE_ID,"edit")) { ?>
                            <li><a href="<?php echo base_url() ?>tag/add/" class="dropdown-item <?= ($segment1 == 'tag' && $segment2 == 'add') ? 'active' : '' ?>"><i class="fa fa-plus"></i> Add Tag</a></li>
                        <?php } ?>
                        <?php if($this->applib->have_access_role(MANUFACTURE_MODULE_ID,"view")) { ?>
                            <li><a href="<?php echo base_url() ?>tag/tag_list/" class="dropdown-item <?= ($segment1 == 'tag' && $segment2 == 'tag_list') ? 'active' : '' ?>"><i class="fa fa-list"></i> Tag List</a></li>
                        <?php } ?>
                        <?php if($this->applib->have_access_role(MANUFACTURE_MODULE_ID,"add") || $this->applib->have_access_role(MANUFACTURE_MODULE_ID,"edit")) { ?>
                            <li><a href="<?php echo base_url() ?>sell/add/" class="dropdown-item <?= ($segment1 == 'sell' && $segment2 == 'add') ? 'active' : '' ?>"><i class="fa fa-plus"></i> Add Sell</a></li>
                        <?php } ?>
                        <?php if($this->applib->have_access_role(MANUFACTURE_MODULE_ID,"view")) { ?>
                            <li><a href="<?php echo base_url() ?>sell/sell_list/" class="dropdown-item <?= ($segment1 == 'sell' && $segment2 == 'sell_list') ? 'active' : '' ?>"><i class="fa fa-list"></i> Sell List</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if($this->applib->have_access_role(PAYMENT_RECEIPT_MODULE_ID,"view")) { ?>
                <li class="nav-item dropdown <?= ($segment1 == 'payment_receipt') ? 'active' : '' ?>">
                    <a id="dropdownSubMenuPR" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Payment / Receipt</a>
                    <ul aria-labelledby="dropdownSubMenuPR" class="dropdown-menu border-0 shadow <?= ($segment1 == 'payment_receipt') ? 'active' : '' ?>">
                        <?php if($this->applib->have_access_role(PAYMENT_RECEIPT_MODULE_ID,"add") || $this->applib->have_access_role(PAYMENT_RECEIPT_MODULE_ID,"edit")) { ?>
                            <li><a href="<?php echo base_url() ?>payment_receipt/add/" class="dropdown-item <?= ($segment1 == 'payment_receipt' && $segment2 == 'add') ? 'active' : '' ?>"><i class="fa fa-plus"></i> Add Payment / Receipt</a></li>
                        <?php } ?>
                        <?php if($this->applib->have_access_role(PAYMENT_RECEIPT_MODULE_ID,"view")) { ?>
                            <li><a href="<?php echo base_url() ?>payment_receipt/payment_receipt_list/" class="dropdown-item <?= ($segment1 == 'payment_receipt' && $segment2 == 'payment_receipt_list') ? 'active' : '' ?>"><i class="fa fa-list"></i> Payment / Receipt List</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if($this->applib->have_access_role(REPORT_MODULE_ID,"view")) { ?>
                <li class="nav-item dropdown <?= ($segment1 == 'report') ? 'active' : '' ?>">
                    <a id="dropdownSubMenuReport" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Report</a>
                    <ul aria-labelledby="dropdownSubMenuReport" class="dropdown-menu border-0 shadow <?= ($segment1 == 'report') ? 'active' : '' ?>">
                        <?php if ($this->applib->have_access_role(AD_PCS_REPORT_MODULE_ID, "view")) { ?>
                            <li><a href="<?= base_url(); ?>report/ad_pcs_report/" class="dropdown-item <?= ($segment1 == 'report' && $segment2 == 'ad_pcs_report') ? 'active' : '' ?>">Ad Pcs Report</a></li>
                        <?php } ?>
                        <?php if ($this->applib->have_access_role(ITEM_STOCK_STATUS_REPORT_MODULE_ID, "view")) { ?>
                            <li><a href="<?= base_url(); ?>report/item_stock_status/" class="dropdown-item <?= ($segment1 == 'report' && $segment2 == 'item_stock_status') ? 'active' : '' ?>">Item Stock Status</a></li>
                        <?php } ?>
                        <?php if ($this->applib->have_access_role(PERSON_LEDGER_REPORT_MODULE_ID, "view")) { ?>
                            <li><a href="<?= base_url(); ?>report/person_ledger/" class="dropdown-item <?= ($segment1 == 'report' && $segment2 == 'person_ledger') ? 'active' : '' ?>">Person Ledger</a></li>
                            <li><a href="<?= base_url(); ?>report/person_new_ledger/" class="dropdown-item <?= ($segment1 == 'report' && $segment2 == 'person_new_ledger') ? 'active' : '' ?>">Person Ledger New</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($this->applib->have_access_role(BACKUP_MODULE_ID, "allow")) { ?>
                <li class="nav-item dropdown <?= ($segment1 == 'backup') ? 'active' : '' ?>">
                    <a id="dropdownSubMenuBackup" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Backup</a>
                    <ul aria-labelledby="dropdownSubMenuBackup" class="dropdown-menu border-0 shadow <?= ($segment1 == 'backup') ? 'active' : '' ?>">
                        <li><a href="<?= base_url('backup');?>" class="nav-link">Backup</a></li>
                    </ul>
                </li>
            <?php } ?>
            <?php /*<li class="nav-item">
              <a href="<?= base_url('order_dispatch/order_dispatch_list');?>" class="nav-link">Order & Dispatch</a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('welcome/weight_detail');?>" class="nav-link">Weight Detail</a>
            </li>*/ ?>
          </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-user"></i>
              <span class="badge badge-warning navbar-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header"><?= isset($logged_in_name) ? ucwords($logged_in_name) : 'Admin'; ?> Is Logged In</span>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url() ?>auth/logout" class="dropdown-item btn btn-default btn-flat">
                Sign out
              </a>
            </div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  