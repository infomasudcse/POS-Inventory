<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    public $title = 'Configuration';    
    public $subtitle = "Config";

    function index(){
        $config = Config::where('id',1)->first();
        
        return view('admin.config',['cf' => $config,'title'=>$this->title,'subtitle'=>$this->subtitle]);
    }

    function changeState(){
        $status = DB::table('systemstatus')->first();
        if($status){
            $currentStatus = $status->status;
            if($currentStatus=='on'){
                 DB::table('users')->where('role','staff')->update(['status' => 0]);
                 DB::table('systemstatus')->where('id', 1)->update(['status' => 'off']);
            }else{
                 DB::table('users')->where('role','staff')->update(['status' => 1]);
                 DB::table('systemstatus')->where('id', 1)->update(['status' => 'on']);
            }
        }
        return redirect('dashboard');
    }

    public static function getSystemStatus(){
        return DB::table('systemstatus')->first();
    }

    function store(Request $request){
       // print_r( $request->input());
        $validatedData = $request->validate([
            'business_name' => 'required|max:30',
            'slogan' => 'required|max:50',
            'owner_name' => 'required|max:50',
            'address' => 'required|max:50',
            'contact' => 'required|max:50'
        ]);
        
        //validate
        $newConfig = [
            'business_name'=>$request->input('business_name'),
            'slogan'=>$request->input('slogan'),
            'owner_name'=>$request->input('owner_name'),
            'address'=>$request->input('address'),
            'contact'=>$request->input('contact'),
            'memo_header'=>$request->input('memo_header'),
            'return_policy'=>$request->input('return_policy'),
            'default_tax_name'=>$request->input('default_tax_name'),
            'default_tax'=>$request->input('default_tax'),
            'email'=>$request->input('email'),
            'autobarcode'=> $request->input('autobarcode')?: 0 ,
            'br_line'=> $request->input('br_line'),
            'logo'=> 'logo.png',
            'mono'=> 'mono.png',     
            ];
        
        $uploadedFile = $request->file('logo'); 
        if($uploadedFile) { 
            Storage::delete('logo.png');
            Storage::disk('local')->putFileAs( 'public/',  $uploadedFile, 'logo.png');           
            
        }

        $uploadedMono = $request->file('mono'); 
        if($uploadedMono)  {   
            Storage::delete('mono.png');
            Storage::disk('local')->putFileAs( 'public/',  $uploadedMono, 'mono.png');            
           
        }
        
        $res = Config::where('id', 1)->update($newConfig); 


        return redirect('configs')->with('status', 'Everything Updated!');


    }    

    //end
}

?>