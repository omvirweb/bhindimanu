<?php
ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Job Card Print</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/bootstrap.min.css">
        <style>
            td,th{padding:5px;white-space:nowrap;}
            td{border-bottom-style: none;border-top-style:none;}
            .center {text-align: center;}
            .right {text-align: right;}
            h2{ font-family: "Impact", Charcoal, sans-serif;}
            .border1{border:1;}
            .divRight{text-align: right;}
            .text_bold{
                font-weight: bold;
            }
            .text_center{
                text-align: center;
            }
            .text_left{
                text-align: left;
            }
            .text_right{
                text-align: right;
            }
            .no-border-top{
                border-top:0;
            }
            .no-border-bottom{
                border-bottom:0 !important;
            }
            .no-border-left{
                border-left:0;
            }
            .no-border-right{
                border-right:0;
            }
            .no-border {
                border: 0;
            }
            .border-right {
                border-right: 1px solid black;
                border-left: 0;
                border-top: 0;
                border-bottom: 0;
            }
            .text-bold{
                font-weight: 800 !important;
            }
            .text-nowrap {
                white-space: nowrap !important;
            }
        </style>

    </head>
    <body>
        <table border="1" style="width: 100%; font-size: 13px">
            <tr align="center" class="border1">
                <td align="center" class="border1" ><h2><?php echo PACKAGE_NAME; ?></h2></td>
            </tr>
        </table>
        <table style="width: 100%; font-size: 13px">
            <tr align="center" class="border1">
                <td align="left"><span class="TEXT_BOLD">PARTY : </span><?php echo isset($name) ? $name : '';?></td>
                <td align="left"><span class="TEXT_BOLD">JOB NO : </span><?php echo isset($job_card_no) ? $job_card_no : '';?></td>
                <td align="left"><span class="TEXT_BOLD">MELTING : </span><?php echo isset($melting) ? $melting : '';?></td>
                <td align="left"><span class="TEXT_BOLD">ORDER DATE : </span><?php echo isset($order_date) ? $order_date : '';?></td>
                <td align="left"><span class="TEXT_BOLD">DELIVERY DATE : </span><?php echo isset($delivery_date) ? $delivery_date : '';?></td>
            </tr>
        </table>
        <table style="width: 100%; font-size: 13px">
            <tr align="center" class="border1">
                <td align="left" class="border1" style="height: 50px;vertical-align: top;width: 33.33%;max-width: 33.33%;">
                    <span class="TEXT_BOLD">PECH - TAR : </span><?php echo isset($peck_tar) ? nl2br($peck_tar) : '';?>
                </td>
                <td align="left" class="border1" style="height: 50px;vertical-align: top;width: 33.33%;max-width: 33.33%;">
                    <span class="TEXT_BOLD">LATKAN : </span><?php echo isset($latkan) ? nl2br($latkan) : '';?>
                </td>
                <td align="left" class="border1" style="height: 50px;vertical-align: top;width: 33.33%;max-width: 33.33%;">
                    <span class="TEXT_BOLD">REMARK : </span><?php echo isset($remark) ? nl2br($remark) : '';?>
                </td>
            </tr>
        </table>
        <table style="width: 100%; font-size: 13px">
            <tr align="center" class="border1">
                <td align="left" colspan="8"><h4 class="TEXT_BOLD">Order</h4></td>
            </tr>
            <thead>
                <tr align="center" class="border1">
                    <th align="right" class="border1">Sr. No</th>
                    <th align="left" class="border1">Item</th>
                    <th align="left" class="border1">Design No</th>
                    <th align="right" class="border1">Qty</th>
                    <th align="right" class="border1">Total Qty</th>
                    <th align="right" class="border1">Weight</th>
                    <th align="right" class="border1">Total Weight</th>
                    <th align="left" class="border1">Remark</th>
                </tr>
            </thead>
            <?php 
                $total_qty = 0;
                $total_weight = 0;
                    if(isset($card_items) && !empty($card_items)) { 
                ?>
                <?php foreach ($card_items as $cards) {
                        echo '<tr class="border1">';
                        $i = 0;
                        foreach ($cards as $key => $val) { 
                            $style = 'left';
                            $style2 = 'white-space: pre-wrap';
                            if(in_array($i, array(0,3,4,5,6))) {
                                $style = 'right';
                                $style2 = '';
                            }?>
                            <td align="<?php echo $style ?>" style="<?php echo $style2 ?>" class="border1"><b><?php echo nl2br($val) ?></b></td>
                        <?php 
                                if($i == 4){
                                    $total_qty += $val;
                                }
                                if($i == 6){
                                    $total_weight += $val;
                                }
                                $i++;
                            }
                        echo '</tr>';
                } ?>
                <tr align="center" class="border1">
                    <th align="right" colspan="4">Total</th>
                    <th align="right" class="border1"><?php echo $total_qty; ?></th>
                    <th align="right" class="border1"></th>
                    <th align="right" class="border1"><?php echo number_format($total_weight, 3, '.', ''); ?></th>
                    <th align="left" class="border1"></th>
                </tr>
            <?php } ?>
        </table>
        <?php 
            if($casting_table_html) {
                echo $casting_table_html;
            }
        ?>
    </body>
</html>
