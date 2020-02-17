<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class parkingRequest extends Controller
{
    public function store(Request $request){

        $request->validate([
            'parkingspace' => 'required',
            'vehicles' => 'required',
            'fromdate' => 'required',
            'todate' => 'required'
        ]);

        $parkingspace = $request->input('parkingspace');
        $vehicles = $request->input('vehicles');
        $fdate = $request->input('fdate');
        $ftime = $request->input('fdate');
        $tdate = $request->input('tdate');
        $ttime = $request->input('tdate');
        $email = 'abc@gmail.com';
        $marked = 'f';
        $confirmed = 'f';
        $data=array('parkingId'=>$parkingspace,"vehicleNumber"=>$vehicles,"bookingfDate"=>$fdate,"bookingtDate"=>$tdate,"bookingfTime"=>$ftime,"bookingtTime"=>$ttime,'email'=>$email,'marked'=>$marked,'confirmed'=>$confirmed);
        DB::table('notification')->insert($data);

        return redirect('notification');
    }
}
