

<style type="text/css">

.bar_co{
float:left; 
/*overflow:hidden;*/
}
.laabel{
   background-color:#ffffff;height:94px;
}
.label_text{margin-left:50px;}
.bb{background-color:#ffffff;}
.cc{background-color:#ffffff;}
.box_barcode{border:1px solid #ffffff;float:left;text-align:center;width:175px;padding:10px 10px;}
</style>
<?php

    $json = json_decode($inv->variation);

    $img =  '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($inv->sku,'C128',1,20) . '" alt="barcode"   />'; 

    $str = '';
    if($json){
        for($j = 0; $j < count($json); $j++){

            $str .= $json[$j]->value.', ';
        }
    }else{
        $str = '.';
    }
?>


<div style="width:90%;border:1px solid #ffffff;opacity:.1;" id="receiptDiv">
    <div style="width:480px;margin-left:-30px;margin-top:-28px;border:1px solid #ffffff;height:720px;opacity:0;" align="center">
    <?php
        $price = Helper::toCurrency($inv->unit_price);

        for($i=1;$i<=$qty;$i++){
    ?>
    
        <div class="box_barcode">
          <?php   
          echo "<div><b style='font-size:16px;'>".ucwords($inv->name)."</b></div>
          <div><span style=''>".$img."</span></div>
          <div><span style='letter-spacing:2px;font-size:11px;'>*".$inv->sku."* </span></div>
          <div style='line-height:1;'><span style='font-size:9px;line-height:1;'>".$str."</span></div>
          <div style=''> <b style='font-size:12px;'>".$price."</b> <span style='font-size:10px;'>+".$configs->default_tax_name."</span> </div>
          <div style=''><span style='font-size:14px;'>".ucwords($configs->business_name)."</span></div>";
        ?>
        </div>
     <?php }   ?>

    </div>
</div>    

