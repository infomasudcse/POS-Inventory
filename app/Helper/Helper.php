<?php 

namespace App\Helper;



class Helper{

	public static function printLogo(){
		echo '<img src="'.asset('images/logo.png').'" alt="logo" style="width:300px;height:80px;"  />';
	} 

	public static function printMono(){
		echo '<img src="'.asset('images/mono.png').'" alt="logo" style="width:60px;height:60px;" class="brand-image img-circle elevation-3" />';
	} 


	public static function toCurrency($value){

	 		$number =  number_format((float)$value, 2, '.', '');

			return 'TK.'.$number;

	}

	public static function getUserStatus($id){

	 		if($id=='1'){

	 			return 'Active';

	 		}else{

	 			return 'Unactive';

	 		}

	}

	public static function canTransfer($id){

	 		if($id=='1'){

	 			return 'Yes';

	 		}else{

	 			return 'No';

	 		}

	}

	

	public static function getCurrency(){

			return 'TK';

	}

		

	public static function viewSaleId($id){

			return 'POS-'.$id;

	}

		

	public static function cleanStr($str){		

	   		$newStr =  preg_replace('/[^A-Za-z0-9\-]/', '', $str); // Removes special chars.

	   		return strtolower($newStr);    	

	}

	

}