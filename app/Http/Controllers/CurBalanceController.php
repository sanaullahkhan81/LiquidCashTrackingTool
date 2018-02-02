<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cur_balance;

class CurBalanceController extends Controller
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
        
        return view('curBalance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
       $cur_act_amount = $request->get('cur_bal_cur_amount');
       $cur_bal_entry_act_amount = $request->get('cur_bal_entry_act_amount');
       $cur_bal_entry_date = $request->get('cur_bal_entry_date');
       $cur_id = $request->get('cur_bal_id');
       $variance = $cur_act_amount - $cur_bal_entry_act_amount;
       
//       Cur_balance::where('cur_id',$cur_id)
//                    ->where('entry_date',$cur_bal_entry_date)
//                    ->update(['entered_amount' => $cur_bal_entry_act_amount,
//                          'variance' => $variance  
//                       ]);
       $data = null;
       
       return view('custom_reports.index', compact(
            
            'data'
        ));
       
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
    
    
    
}
