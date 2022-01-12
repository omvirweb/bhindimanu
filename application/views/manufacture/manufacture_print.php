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
        <?php
        if(isset($table_html)) {
            echo $table_html;
        }
        ?>
</body>
</html>