<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ReportTrait;
use Carbon\Carbon;


class DashboardController extends Controller
{
     
    use ReportTrait;

    function home(){
    	$data['title'] = 'Index';
    	$data['sale'] = $this->getSale();
        $data['tax'] = $this->getTax();
    	$data['attendence'] = $this->getAttendence();
    	$data['expense'] = $this->getExpense();
        $data['status'] = $this->getSystemStatus();
    	return view('admin.home',$data);
    }

    function getChartData($type=''){
        if($type==='month'){
            $sales = $this->getMonthSale();
            //dd($sales);
            $data = [];
            if($sales){
                foreach($sales as $sale){
                    $day = Carbon::create($sale->created_at)->day;
                    if(isset($data[$day])){
                        $data[$day] = $data[$day] + floatval($sale->total);
                    }else{
                        $data[$day] = floatval($sale->total);
                    }                      
                }
            }
            $chart_data = [];
            if($data){
                foreach($data as $key => $total){
                    $chart_data[] = [$key, $total]; 
                }

                return json_encode($chart_data);
            }           
           
        }

        if($type==='week') {
            $sales = $this->getWeekSale();
          
            $data = [];
            $chart_data = [];
            if($sales){
                foreach($sales as $sale){
                    $day = Carbon::create($sale->created_at)->weekday();
                    if(isset($data[$day])){
                        $data[$day] = $data[$day] + floatval($sale->total);
                    }else{
                        $data[$day] = floatval($sale->total);
                    }                                          
                }
            }

            $chart_data = [];
            if($data){
                foreach($data as $key => $total){
                    $chart_data[] = [$key, $total];                    
                }

                return json_encode($chart_data);
            }

            return json_encode($chart_data);

        }      
       
        return json_encode([]);
    }
}
