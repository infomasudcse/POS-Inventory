
<?php
           
            $img =  '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($idnumber,'C128',1,20) . '" alt="barcode"   />'; 
            $str = '';            
            ?>
            <div class="" id="" style="position:relative;width:40%; text-align:center;border:1px dotted white;">
              <div style="margin-top:-65px;disply:flex;justify-content:center;align-itmes:center;position:absolute;">
                <?php                
                  
				echo "<div style='text-align:center;height:121px;margin:10px;'>"; 
					echo "<table  style='text-align:center;width:100%;' cellpadding='0' border='0' >
						<tr><td  style='font-family: sans-serif;padding-bottom:1px;'><b style='font-size:13px;line-height:12px;'>".ucwords($name)."</b></td></tr>
						<tr><td>".$img."</td></tr>
						<tr><td class='' style='padding:0;margin:0;font-size:10px;line-height:10px;'><b style='font-size:10px;line-height:10px;'>".$idnumber."</b></td></tr>
						<tr><td class='' style='font-family: sans-serif;padding:0;margin:0;font-size:9px;line-height:9px;'><b style='font-size:9px;line-height:9px;' >". $configs->business_name."</b></td></tr>
						</table>";                    
				echo "</div>";                            
                    
                ?>
              </div>             
            </div>