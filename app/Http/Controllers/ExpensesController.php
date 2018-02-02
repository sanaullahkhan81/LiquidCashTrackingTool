<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use App\Http\Requests\StoreExpensesRequest;
use App\Http\Requests\UpdateExpensesRequest;
use App\Currencies;
use App\Cur_balance;
use App\Amount;
use DB;

class ExpensesController extends Controller
{

    /**
     * Display a listing of Expense.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$expenses = Expense::all();
        $expenses = DB::select('SELECT expenses.*,currencies.cur_name,expenses_categories.name FROM `expenses` 
               left join currencies on expenses.cur_id = currencies.id 
               inner join expenses_categories on expenses.expenses_category_id = expenses_categories.id');

        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating new Expense.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $relations = [
            'expenses_categories' => \App\ExpensesCategory::get()->pluck('name', 'id')->prepend('Please select', '')
        ];
        
        $currencies = Currencies::pluck('cur_name','id')->all();
        

        return view('expenses.create', $relations,compact('currencies'));
    }

    /**
     * Store a newly created Expense in storage.
     *
     * @param  \App\Http\Requests\StoreExpensesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpensesRequest $request)
    {
        // Adding expenses
        
        Expense::create($request->all());
        $cur_name = $request->get('cur_name');
        $cur_id =$request->get('cur_id');
        $cur_amount =$request->get('cur_amount');
        $entry_date =$request->get('entry_date');
        $amount =$request->get('amount');
        
        
        //Deducting from actual amount - expenses amount;
        
        $act_amount = Amount::find(21);
        $updatingAmount = $act_amount->amount - $amount;
        Amount::where('id',21)->update(['amount'=> $updatingAmount]);
        
        
        
        
        if($cur_id == ''){
           echo 'Adding Expenses...!!!';
           
           
            
        }else{
            // Incrementing to old value + new value as currency comes in            
            $result = Currencies::removingExpensesAmount($cur_id,$entry_date,$cur_name,$cur_amount);
        }
        

        return redirect()->route('expenses.index');
    }

    /**
     * Show the form for editing Expense.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $relations = [
            'expenses_categories' => \App\ExpensesCategory::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        $expense = Expense::findOrFail($id);

        return view('expenses.edit', compact('expense') + $relations);
    }

    /**
     * Update Expense in storage.
     *
     * @param  \App\Http\Requests\UpdateExpensesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpensesRequest $request, $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->update($request->all());

        return redirect()->route('expenses.index');
    }

    /**
     * Display Expense.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relations = [
            'expenses_categories' => \App\ExpensesCategory::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        $expense = Expense::findOrFail($id);

        return view('expenses.show', compact('expense') + $relations);
    }

    /**
     * Remove Expense from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $seprating =explode('-',$id);
       
        $id = $seprating[0];
        $amount = $seprating[1];
        $cur_id = $seprating[2];
        $cur_amount = $seprating[3];
        
        $expense = Expense::findOrFail($id);
        $expense->delete();
        
        $bal = Amount::find(21);
        $amount = $bal->amount + $amount;
        Amount::find(21)->update(['amount' =>$amount ]);
        
        //checking if this is currency transcation ,
        // if yes currency will be delted
        if($cur_id ==0){
            echo 'Adding Curreny Amount';
        }else{
           $currencies = Currencies::find($cur_id);
            $curenciesAmount = $currencies->amount + $cur_amount;
            Currencies::find($cur_id)->update(['amount' =>$curenciesAmount ]);
        }
        

        return redirect()->route('expenses.index');
    }

    /**
     * Delete all selected Expense at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Expense::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
