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
    
//     Converting date into carbon parse
       $Carbondate = Carbon::parse($date);   
       
//     converting selected date, to yesterday date to check weather closing amount has been enter or not
       $yesterdayDate = $Carbondate->subDay(1); 
       
//     Converting Date in dd-mm-YY format to send to view purpose
       $yesterdayDateInDDMMYY = $yesterdayDate->format('d-m-Y');
              
       
       $yesterdayDate= $yesterdayDate->toDateString();
       
       
       

//     Checking weather closing amount available for yesterday or not 
       
       $yesterdayClosingAmount = Balance::CheckForYesterdayClosingEnter($yesterdayDate);
       
     
       if(empty($yesterdayClosingAmount)){
           
       return view('custom_reports.enterClosingAmount',compact('yesterdayDate','yesterdayDateInDDMMYY'));    

        
       }else{
          
//       Getting all income for that date 
       $incomeAmount = Income::accumulateIncomeWithDate($date);
       
       
//     Getting all expenses for that date
       $expenseAmount = Expense::accumulateExpenseWithDate($date);
       
//       Getting last day closing balance
       $openingBalance = Balance::getLastdayClosingBalance($yesterdayDate);
       $todayClosingBalance = Balance::todayClosingBalance($date);
       if($todayClosingBalance){
           $todayClosingBalance = $todayClosingBalance->closing;
       }else{
           $todayClosingBalance = 0;
       }
       
       $cashNow = $openingBalance->closing+$incomeAmount;
       $cashNow = $cashNow - $expenseAmount;
       $currencies = Currencies::all();
       
      
   
        return view("custom_reports.dailyReport",compact('date','incomeAmount','expenseAmount','openingBalance','todayClosingBalance','currencies'))->with('cashNow',$cashNow);
        
        
       }
        
        
       
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
