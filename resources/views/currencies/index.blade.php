@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add Currencies</h3>


    <div class="col-xs-6 panel panel-default">
        <div class="panel-heading">
            Add Currencies
        </div>
        
        <div class="panel-body">
            
            <div class="row">
            <div class="col-xs-4 col-md-4 form-group">
                <label for="year" class="control-label">Enter Currency Name:</label>
                <form method="POST" action="{{ action('currencies@create') }}">
                    <input type="text" name='curName' class="form-control" required="">
<input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
             </div>
                <div class="col-xs-4">
                        <label class="control-label">&nbsp;</label><br>
                        <input class="btn btn-primary" id="getreportBtn" type="submit" value="Add Currencies">
                </div>
                  
            </div>
            
             </form>     
            
        </div>
        
        <div id="showresults">
     
    </div>
        
   
        
    </div>
    
    
        <div class="col-xs-6 panel panel-default">
        <div class="panel-heading">
            Currencies List
        </div>
        
        <div class="panel-body">
            
            <div class="row">
            <div class="col-xs-4 col-md-4 form-group">
                Testing
            </div>
            
                 
            
        </div>
        
        <div id="showresults">
     
        </div>
        
  
        
    </div>
            
    

   
@stop

@section('javascript')
    @parent
     <script>
       
    
        
        
    
 
  
    
   
        
       
        
    </script>
 

   @stop