<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class Balance extends Model
{
    use SoftDeletes;
    
    protected $table = 'balance';
    protected $fillable = ['entry_date', 'opening', 'closing'];
    
    
    public static function boot()
    {
        parent::boot();

        Balance::observe(new \App\Observers\UserActionsObserver);
    }
    
    static function CheckForYesterdayClosingEnter($date){
        
        $yesterdayClosingAmount = Balance::where('entry_date',$date)->first();
     
        return $yesterdayClosingAmount;
        
    }
    static function store($entry_date,$amount){
        $balance =  Balance::firstOrNew(['entry_date' => $entry_date]);
              
        $balance->closing = $amount;
        

        $balance->save();
  
         
       return true;
         
    }
    
    static function getLastdayClosingBalance($date){
        
         $yesterdayClosingAmount = Balance::where('entry_date',$date)
                 ->select('closing')
                 ->first();
     return $yesterdayClosingAmount;
    }
    
    
    static function todayClosingBalance($date){
        
         $todayClosingAmount = Balance::where('entry_date',$date)
                 ->select('closing')
                 ->first();
     return $todayClosingAmount;
    }
    
    static function storeClosing($entry_date,$variance,$closing){
        
        
        $balance = Balance::firstOrNew(               
                    ['entry_date' => $entry_date]                 
                    
                    );
        $balance->variance = $variance;
        $balance->closing = $closing;
        $balance->save();  
        
       return true;
        
        
    }
        
}
