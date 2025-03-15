<?php

namespace App\Http\Controllers;
use App\Helper\Helper;
use App\Models\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class SmsController extends Controller
{
    const mode_live = false;
    const masking = false;
    const customer_id = 0;
    const api_key = "0";
    const single_message_url = 'https://www.24bulksmsbd.com/api/smsSendApi';
    const single_masking_message_url = 'https://www.24bulksmsbd.com/api/sendMaskingApi';
    const dynamic_message_url = 'https://www.24bulksmsbd.com/api/DynamicSMSApi';
    const balance_url = 'https://www.24bulksmsbd.com/api/balance';

    public static function sendSaleReceipt($total_paid, $customer, $business_name)
    {
        if ($customer && $customer['mobile']){
            $sms = 'Thanks for your payment of ' . Helper::toCurrency($total_paid) . ' @ '. $business_name . '.See you again soon.';
            self::send($sms, $customer['mobile']);
        }
    }

    function index() {        
        $data['title'] = 'SMS';
    	$data['sms_balance'] = SmsController::getBalance();       
    	return view('admin.sms', $data);
    }

    public static function sendSmsBulk($ids) {
        $data['title'] = 'SMS';
        $data['ids'] = $ids;
    	$data['sms_balance'] = SmsController::getBalance();       
    	return view('admin.sms', $data);
    }

    public static function updateBalance()
    {
        self::checkBalance();
        return redirect('sms')->with('status', 'Updated!');
    }

    public static function saveBalance($nonmasking, $masking)
    {
        $nnmask = $nonmasking ? $nonmasking : 0 ;
        $msk = $masking ? $masking : 0;
        Sms::where('id', 1)->update(['nonmasking'=> $nnmask, 'masking'=> $msk]);
        DB::table('sms_report')->insert(['masking' => $msk, 'nonmasking' => $nnmask]);
    }

    public static function getBalance()
    {   
        if(!self::mode_live) return false;

        $today = Carbon::today();
        $sms_balance = Sms::select("*")
            ->where('id', 1)
            ->first();   

       return $sms_balance;
    }

    public static function checkBalance()
    {
        if(!self::mode_live) return false;
        
        $data = array(
            'customer_id' => self::customer_id,
            'api_key' => self::api_key
        );
        $curl = curl_init(self::balance_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);     
        $output = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($output);
        
        if($result->status == 'ok') {
            self::saveBalance($result->balance, $result->masking_sms_balance);
        }

    }

    public static function sendSms(Request $request)
    {

        $validatedData = $request->validate([ 
            'message' =>'required',            
            'mobile_no' => 'required|digits_between:8,20|numeric'            
        ]);

        $result = self::send($request->message, $request->mobile_no);

        return redirect('sms')->with('status', 'ok');        
    }

    public static function send($sms, $mobile_no)
    {
        if(!self::mode_live) return false;

        $url = self::single_message_url;
        if(self::masking) {
            $url = self::single_masking_message_url;
        }

        $data = array(
            'customer_id' => self::customer_id,
            'api_key' => self::api_key,
            'message' =>$sms,	
            'mobile_no' => $mobile_no
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);     
        $output = curl_exec($curl);
        curl_close($curl);

        return json_decode($output);
    }

    
//end     
}

?>