<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Currencies;
use App\Amount;
use Carbon\Carbon;
use App\Balance;

class AmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $inputs =  $request->all();
     dd($inputs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatingAmount(Request $request)
    {
     $actual_amount =  $request->get('actual_amount');
     $entry_date =  $request->get('entry_date');
     $entered_amount =  $request->get('entered_amount');
     $variance =  $request->get('variance');
     $reason =  $request->get('reason');
     
     Amount::where('id',21)
             ->update(['amount' => $entered_amount]);
     
     $balance = new Balance;
     $balance->before_amount = $actual_amount;
     $balance->entered_amount = $entered_amount;
     $balance->description = $reason;
     $balance->variance = $variance;
     $balance->entry_date = $entry_date;
     $balance->save();
     
     
     $today = Carbon::now()->format('Y-m-d');
    
       $amount = Amount::all();
       $currencies =Currencies::all();
      
       
       return view('custom_reports.index', compact('amount','currencies'))
               ->with('today',$today);
     
    }
}
