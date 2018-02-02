


   


<div class="panel panel-default">
       
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-danger alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Note!</strong> No Closing Amount has been entered for Dated: {{ $yesterdayDateInDDMMYY }}
                </div>
            </div>    

        </div>
    </div>
    
    
      
    {!! Form::open(['method' => 'POST', 'action' => ['custom_reports@store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Enter {{ $yesterdayDateInDDMMYY }} Closing Amount
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('entry_date', 'Enter Date*', ['class' => 'control-label']) !!}
                   
                    <input name="yesterdayDate" type="text" value="{{$yesterdayDate}}" readonly="readonly" class="form-control">
                    <p class="help-block"></p>
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('amount', 'Amount*', ['class' => 'control-label']) !!}
                   
                    <input name="amount" type="text" value="" class="form-control" required="">
                    
                </div>
           
            </div>
            
            
            <button id="storeAmount" class="col-xs-2 btn btn-primary">Submit</button>
        </div>
        
        
    </div>
    
</div>
    
    
    