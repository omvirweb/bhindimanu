<!DOCTYPE html>
<html>
    <head>
        <title>Tag Print | <?= PACKAGE_NAME; ?></title>
<style>
    @font-face {
        font-family: roboto;
        src: url(assets/fonts/Roboto-Regular.ttf);
    }
    .w-100{width: 700px;}
    .w-90{width: 90%;}
    .w-80{width: 80%;}
    .w-70{width: 70%;}
    .w-60{width: 60%;}
    .w-50{width: 50%;}
    .w-40{width: 40%;}
    .w-30{width: 30%;}
    .w-20{width: 20%;}
    .w-10{width: 10%;}
    /*.border{border: 1px solid #dedede;}*/
    table {font-family: "Times New Roman"; font-size: 8.4px;}
    tr {line-height: 10px;}
    .main_table tr td {border: none;}
    .main_table{
        /*border-collapse: collapse;*/
        border: none;
    }
    .main_table, .main_table td, .main_table th {
        border: none;

    }
    .main_table td, .main_table th {
        padding: 0px;

    }
    .main_table{
        padding-bottom: 0px;
    }
</style>
    </head>
    <body>
        
    <table width="100%" class="main_table">
        <tr class=""><td class="" align="left">G.W : <?php echo $tag_row->gross; ?></td></tr>
        <tr class=""><td class="" align="left">K.Wt : <?php echo $tag_row->item_weight; ?></td></tr>
        <tr class=""><td class="" align="left">S.Wt : <?php echo $tag_row->stone_wt; ?></td></tr>
        <tr class=""><td class="" align="left">L.Wt : <?php echo $tag_row->less; ?></td></tr>
        <tr class=""><td class="" align="left">D.Wt : <?php echo $tag_row->item_weight; ?></td></tr>
        <tr class=""><td class="" align="left">N.Wt : <?php echo $tag_row->net; ?></td></tr>
    </table>
        
      
    </body>
</html>
