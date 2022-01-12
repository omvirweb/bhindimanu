<?php if($this->session->flashdata('success') === true  && $this->session->flashdata('message') != '') { ?>
<script type="text/javascript">
    $(document).ready(function(){
        toastr.success('<?= $this->session->flashdata('message') ?>');
        //show_notify("<?= $this->session->flashdata('message') ?>", true);
    });
</script>
<?php }
if($this->session->flashdata('success') === false  && $this->session->flashdata('message') != '') { ?>
<script type="text/javascript">
    $(document).ready(function(){
        toastr.error('<?= $this->session->flashdata('message') ?>');
        //show_notify("<?= $this->session->flashdata('message') ?>", false);
    });
</script>
<?php }
if($this->session->flashdata('error_message')) { ?>
<script type="text/javascript">
    $(document).ready(function(){
        toastr.error('<?= $this->session->flashdata('error_message') ?>');
        //show_notify("<?= $this->session->flashdata('error_message') ?>", false);
    });
</script>
<?php } ?>