<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Currencies;
use App\Cur_balance;
use App\Amount;
use Carbon\Carbon;



class CurrenciesController extends Controller
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
        
        $currencies = Currencies::all();
        return view('currencies.create',compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $currencies = new Currencies;
      $cur_name =   $request->get('cur_name');
      $currencies->cur_name = $cur_name;
      $currencies->save();
      $currencies = Currencies::all();
      return view('currencies.create',compact('currencies'));
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $currencies = Currencies::findOrFail($id);
       
         
         return view('currencies.edit',compact('currencies'));
        
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
        $cur_name = $request->get('cur_name');
        
        Currencies::find($id)->update(['cur_name' => $cur_name]);
        $currencies = Currencies::all();
      return view('currencies.create',compact('currencies'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Currencies::find($id)->delete(['id' => $id]);
        $currencies = Currencies::all();
      return view('currencies.create',compact('currencies'));
        
    }
    
    public function updatingCurrencies(Request $request){
       
        $actual_amount = $request->get('actual_amount');
        $entry_date =$request->get('entry_date');
        $cur_id =$request->get('cur_id');
        $e_amount =$request->get('e_amount');
        $variance =$request->get('variance');
        $reason =   $request->get('reason'); 
        
        Currencies::find($cur_id)->update(['amount' => $e_amount]);
        $cur_bal = new Cur_balance();
        $cur_bal->cur_id = $cur_id;
        $cur_bal->entry_date = $entry_date;
        $cur_bal->before_amount = $actual_amount;
        $cur_bal->entered_amount = $e_amount;
        $cur_bal->description = $reason;
        $cur_bal->variance = $variance;
        $cur_bal->save();
        
        $today = Carbon::now()->format('Y-m-d');
    
       $amount = Amount::all();
       $currencies =Currencies::all();
      
       
       return view('custom_reports.index', compact('amount','currencies'))
               ->with('today',$today);
        
        
        
    }
    
    
   
}
