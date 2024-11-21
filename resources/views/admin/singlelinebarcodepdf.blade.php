


            <?php
            $json = json_decode($inv->variation);
            $img =  '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($inv->sku,'C128',1,20) . '" alt="barcode"   />'; 
            $str = '';
            for($j = 0; $j < count($json); $j++){
                $str .= $json[$j]->value.', ';             
            }
            ?>

            <div class="" id="" style="position:relative;width:40%; text-align:center;border:1px dotted white;">
              <div style="margin-top:-65px;disply:flex;justify-content:center;align-itmes:center;position:absolute;">
                <?php
                $price = Helper::toCurrency($inv->unit_price);

                for($i=1;$i<=$qty;$i++){

                  
                    echo "<div style='text-align:center;height:121px;margin:10px;'>"; 
                        echo "<table  style='text-align:center;width:100%;' cellpadding='0' border='0' >
                            <tr><td  style='font-family: sans-serif;padding-bottom:1px;'><b style='font-size:13px;line-height:12px;'>".ucwords($inv->name)."</b></td></tr>
                            <tr><td>".$img."</td></tr>
                            <tr><td class='' style='padding:0;margin:0;font-size:10px;line-height:10px;'><b style='font-size:10px;line-height:10px;'>".$inv->sku."</b></td></tr>
                            <tr><td style='padding:0;margin:0;font-size:10px;line-height:10px;'><b style='font-size:10px;line-height:10px;'>".$str."</b></td></tr>
                            <tr><td style='font-family: sans-serif;padding:0;margin:0;font-size:12px;line-height:12px;'><b style='font-size:12px;line-height:12px;'>".$price." </b>+ ".$configs->default_tax_name." </td></tr>                          
                            <tr><td class='' style='font-family: sans-serif;padding:0;margin:0;font-size:9px;line-height:9px;'><b style='font-size:9px;line-height:9px;' >". $configs->business_name."</b></td></tr>
                          </table>";                    
                    echo "</div>";
                              
                    }
                ?>
              </div>
             
            </div>