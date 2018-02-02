<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cur_balance extends Model
{
    protected $table = 'cur_balance';
    protected $fillable = ['cur_id','entry_date','amount','entered_amount']; 
    
    static function store($cur_name,$cur_id,$cur_amount,$entry_date){
        
        Cur_balance::create(['cur_id' => $cur_id,'entry_date' => $entry_date,'cur_amount' =>$cur_amount]);
        
    }
    
    static function insertOrUpdateIncome($cur_id,$entry_date,$cur_name,$amount){
    
       $results = Cur_balance::where('cur_id', $cur_id)->where('entry_date', $entry_date)->first();
       
         if(count($results) == 0){
             return "Dont have currency to deduct";
            //Cur_balance::create(['cur_name'=>$cur_name,'cur_id'=>$cur_id,'amount'=>$amount,'entry_date'=>$entry_date]);
        }else{
            
            
            $oldAmount = $results->amount;
            $amount =  $oldAmount - $amount;
            Cur_balance::where('cur_id', $cur_id)->where('entry_date', $entry_date)
                    ->update(['amount'  => $amount]);
            
            return true;            
        }
       
    }
    
        
    static function insertOrUpdateExpenses($cur_id,$entry_date,$cur_name,$amount){
    
       $results = Cur_balance::where('cur_id', $cur_id)->where('entry_date', $entry_date)->first();
       
         if(count($results) == 0){
             
            Cur_balance::create(['cur_name'=>$cur_name,'cur_id'=>$cur_id,'amount'=>$amount,'entry_date'=>$entry_date]);
        }else{
            
            
            $oldAmount = $results->amount;
            $amount =  $oldAmount + $amount;
            Cur_balance::where('cur_id', $cur_id)->where('entry_date', $entry_date)
                    ->update(['amount'  => $amount]);
            
            return true;            
        }
       
    }
    
    
        
  }

    
