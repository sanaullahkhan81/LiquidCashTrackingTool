<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Income;
use App\Expense;
use Carbon\Carbon;
use App\Amount;
use App\Currencies;

use DB;






class custom_reports extends Controller
{
   public function index(Request $r)
    {
      $today = Carbon::now()->format('Y-m-d');
    
       $amount = Amount::all();
       $currencies =Currencies::all();
      
       
       return view('custom_reports.index', compact('amount','currencies'))
               ->with('today',$today);
   }
   
    public function getreport($date)
    {
       
    
//       Getting all income for that date 
       $incomeAmount = Income::accumulateIncomeWithDate($date);
       
       
//     Getting all expenses for that date
       $expenseAmount = Expense::accumulateExpenseWithDate($date);
      
       
       //$expensesByCat = Expenses::getBycategory($date);
       
       $exp_q = Expense::with('expenses_category')
            ->where('entry_date', $date);

        $inc_q = Income::with('income_category')
           ->where('entry_date', $date);

        $exp_group = $exp_q->orderBy('amount', 'desc')->get()->groupBy('expenses_category_id');
        $inc_group = $inc_q->orderBy('amount', 'desc')->get()->groupBy('income_category_id');
        $exp_total = $exp_q->sum('amount');
        $inc_total = $inc_q->sum('amount');
        $profit    = $inc_total - $exp_total;

        $exp_summary = [];
        foreach ($exp_group as $exp) {
            foreach ($exp as $line) {
                if (!isset($exp_summary[$line->expenses_category->name])) {
                    $exp_summary[$line->expenses_category->name] = [
                        'name'   => $line->expenses_category->name,
                        'amount' => 0,
                    ];
                }
                $exp_summary[$line->expenses_category->name]['amount'] += $line->amount;
            }
        }

        $inc_summary = [];
        foreach ($inc_group as $inc) {
            foreach ($inc as $line) {
                if (!isset($inc_summary[$line->income_category->name])) {
                    $inc_summary[$line->income_category->name] = [
                        'name'   => $line->income_category->name,
                        'amount' => 0,
                    ];
                }
                $inc_summary[$line->income_category->name]['amount'] += $line->amount;
            }
        }
   
       return view("monthly_reports.dailyReport",compact('incomeAmount','expenseAmount',
                                'exp_summary',
                             'inc_summary',
                             'exp_total',
                             'inc_total',
                             'profit'));

        

        
        
       
   }
   
   
   public function store(Request $request){
       
        $entry_date = $request->yesterdayDate;
        $closingAmount = $request->amount;
      
        Balance::store($entry_date,$closingAmount);
        $data = null;
        return view('custom_reports.index', compact(  
            'data'
        ));
        
      
       
   }
   
   public function storeClosing(){
    $entry_date = $_POST['entry_date'];
    $variance = $_POST['variance'];
    $closing = $_POST['closing'];
    
    $check = Balance::storeClosing($entry_date,$variance,$closing);
    
    $data = null;
        return view('custom_reports.index', compact(  
            'data'
        ));
                          
                            
   }
   
   
   
   
}
