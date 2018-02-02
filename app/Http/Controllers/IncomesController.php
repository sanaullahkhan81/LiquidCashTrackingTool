<?php

namespace App\Http\Controllers;

use App\Income;
use Illuminate\Http\Request;
use App\Http\Requests\StoreIncomesRequest;
use App\Http\Requests\UpdateIncomesRequest;
use App\Currencies;
use App\Cur_balance;
use App\Amount;

class IncomesController extends Controller
{

    /**
     * Display a listing of Income.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomes = Income::all();
      

        return view('incomes.index', compact('incomes'));
    }

    /**
     * Show the form for creating new Income.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $relations = [
            'income_categories' => \App\IncomesCategory::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];
          $currencies = Currencies::pluck('cur_name','id')->all();

        return view('incomes.create', $relations,compact('currencies'));
    }

    /**
     * Store a newly created Income in storage.
     *
     * @param  \App\Http\Requests\StoreIncomesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomesRequest $request)
    {
        
        Income::create($request->all());
        $cur_name = $request->get('cur_name');
        $cur_id =$request->get('cur_id');
        $cur_amount =$request->get('cur_amount');
        $entry_date =$request->get('entry_date');
        $amount =$request->get('amount');
        
        //Adding money from actual amount + Income amount;
        
         $act_amount = Amount::find(21);
        $updatingAmount = $act_amount->amount + $amount;
        Amount::where('id',21)->update(['amount'=> $updatingAmount]);
        
       
         if($cur_id == ''){
           echo 'Adding Income...!!!';
           
           
            
        }else{
            // Incrementing to old value + new value as currency comes in            
            $result = Currencies::addingIncomeAmount($cur_id,$entry_date,$cur_name,$cur_amount,$amount);
        }
       
       
        return redirect()->route('incomes.index');
    }

    /**
     * Show the form for editing Income.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $relations = [
            'income_categories' => \App\IncomesCategory::get()->pluck('name', 'id')->prepend('Please select', ''),

        ];

        $income = Income::findOrFail($id);
        
        return view('incomes.edit', compact('income') + $relations);
    }

    /**
     * Update Income in storage.
     *
     * @param  \App\Http\Requests\UpdateIncomesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomesRequest $request, $id)
    {
        $income = Income::findOrFail($id);
        $income->update($request->all());

        return redirect()->route('incomes.index');
    }

    /**
     * Display Income.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relations = [
            'income_categories' => \App\IncomesCategory::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        $income = Income::findOrFail($id);

        return view('incomes.show', compact('income') + $relations);
    }

    /**
     * Remove Income from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();

        return redirect()->route('incomes.index');
    }

    /**
     * Delete all selected Income at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Income::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
    
    
}
