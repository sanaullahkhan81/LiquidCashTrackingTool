<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    protected $fillable = ['cur_name','amount'];
    
    static function updateAmount($cur_id,$cur_amount,$entry_date){
       
        Currencies::where('cur_id',$cur_id)                    
               ->increment(['amount' => $cur_amount]);
        
        return ture;
                
        
    }
    
    static function removingExpensesAmount($cur_id,$entry_date,$cur_name,$amount){
    
    $plucked = Currencies::find($cur_id);
            $Actamount = $plucked->amount;
            $addingCurrenciesAmount = $Actamount + $amount;
            Currencies::find($cur_id)->update(['amount'=> $addingCurrenciesAmount]);
            
            return true;
    }
    // currencies been sold, so currency is out from the business
    static function addingIncomeAmount($cur_id,$entry_date,$cur_name,$amount){
    
    $plucked = Currencies::find($cur_id);
            $Actamount = $plucked->amount;
            $addingCurrenciesAmount = $Actamount - $amount;
            Currencies::find($cur_id)->update(['amount'=> $addingCurrenciesAmount]);
            
            return true;
    }
    
}
