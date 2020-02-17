<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class review extends Controller
{
    public function index()
    {
        $parkingslots = DB::table('parking_spaces')->get();
        $reviews = DB::table('reviews')
                    ->join('contacts', 'users.id', '=', 'contacts.user_id')
                    ->join('orders', 'users.id', '=', 'orders.user_id')
                    ->select('users.*', 'contacts.phone', 'orders.price')
                    ->get();
        return view('driver.review',['reviews' => $reviews,'parkingslots' => $parkingslots]);
    }


}
