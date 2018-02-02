@extends('layouts.app')

@section('content')
    <h3 class="page-title">Money In - Income</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['incomes.store']]) !!}

    <div class="col-xs-7 panel panel-default">
        <div class="panel-heading">
            Create
        </div>
       
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('income_category_id', 'Income Category*', ['class' => 'control-label']) !!}
                    {!! Form::select('income_category_id', $income_categories, old('income_category_id'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('income_category_id'))
                        <p class="help-block">
                            {{ $errors->first('income_category_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('entry_date', 'Entry date*', ['class' => 'control-label']) !!}
                    {!! Form::text('entry_date', old('entry_date'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('entry_date'))
                        <p class="help-block">
                            {{ $errors->first('entry_date') }}
                        </p>
                    @endif
                </div>
            </div>
              <div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('cur_id', 'Currency Name', ['class' => 'control-label']) !!}
                    
                    {!! Form::text('cur_id', old('cur_id'), ['class' => 'form-control','id'=>'cur_id', 'placeholder' => '' , 'readonly']) !!}
                    {!! Form::text('cur_name', old('cur_name'), ['class' => 'form-control', 'id'=>'cur_name', 'placeholder' => '' , 'readonly']) !!}
                    
                    <p class="help-block"></p>
                    @if($errors->has('entry_date'))
                        <p class="help-block">
                            {{ $errors->first('entry_date') }}
                        </p>
                    @endif
                </div>
                
            </div>
            
               <div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('cur_amount', 'Currency amount', ['class' => 'control-label']) !!}
                    {!! Form::text('cur_amount', old('cur_amount'), ['class' => 'form-control', 'placeholder' => '' , 'readonly']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('entry_date'))
                        <p class="help-block">
                            {{ $errors->first('entry_date') }}
                        </p>
                    @endif
                </div>
                
            </div>
            
            <div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('amount', 'Amount*', ['class' => 'control-label']) !!}
                    {!! Form::text('amount', old('amount'), ['class' => 'form-control', 'id'=> 'finalAmount', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('amount'))
                        <p class="help-block">
                            {{ $errors->first('amount') }}
                        </p>
                    @endif
                </div>
            </div>
            
             <div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control','id' => 'description', 'placeholder' => '', 'rows' => 4]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('amount'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
        
     {!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}   
        
    </div>

    
    
    <div class="col-xs-5 panel panel-default" id='moneyin'>
        <div class="panel-heading">
            Selling Currency - Money In
        </div>
       <div class="panel-body">
                <div class="row">
           <div class="col-xs-7 form-group">
                    
                    
                    
                    {!! Form::label('Description', 'Select Which Currency*?', ['class' => 'control-label']) !!}
                    {!! Form::select('currencies',[null=>'Please Select']+ $currencies,old('id'),['class' => 'form-control','id' => 'selected_cur_name']) !!}
                    <br>
                  <div class="alert alert-warning">
                      <strong>Note!</strong> If currencies not available. <br><b>Goto: Setting->Add Currencies</b>
                  </div>
                    
                    {!! Form::label('Description', 'How much?', ['class' => 'control-label']) !!}
                    <input type="number" id="currencySold" class="form-control">
                    
                    {!! Form::label('Description', 'At What rate', ['class' => 'control-label']) !!}
                    <input type="number" id="rateReceived" class="form-control">
                    <p class="help-block"></p>
                   
                </div>
                </div>
               <p></p>
           <input type="button" class="btn btn-primary" value="Calculate" onclick="currencyBought()">
            
        </div>
        
        
       
        
        
        
    </div>
        
@stop

@section('javascript')
    @parent
    <script>
        $('.date').datepicker({
            autoclose: true,
            maxDate: new Date,
            dateFormat: "{{ config('app.date_format_js') }}"
        });
        
        function currencyBought(){
             
            var e = document.getElementById("selected_cur_name");
            var cur_value = e.options[e.selectedIndex].value;
            var cur_text = e.options[e.selectedIndex].text;
                      
             console.log(cur_value,cur_text);
             var currencySold = document.getElementById("currencySold").value;
             var rateReceived = document.getElementById("rateReceived").value;
             
             
            
             var curReceviedTot = currencySold * rateReceived;
          
             
             
             document.getElementById("finalAmount").value = curReceviedTot;
             document.getElementById("cur_id").value = cur_value;
             document.getElementById("cur_name").value = cur_text;
             document.getElementById("cur_amount").value = currencySold;
             
             var description2 = "Currency: "+ cur_text + "\n" + currencySold + "X" + rateReceived + "=" + curReceviedTot  + "\n" ;
            
            
             
             
             
         document.getElementById("description").value = description2 ; 
        }
        
         document.getElementById("moneyin").style.display = "none";
        document.getElementById("cur_id").style.display = "none";
        document.getElementById("cur_name").style.display = "none";
        document.getElementById("cur_amount").style.display = "none";
        
        $('#income_category_id').on('change', function() {
            
       
      if ( this.value === '1')
      
      {
        document.getElementById("moneyin").style.display = "block";
        
        document.getElementById("cur_id").style.display = "block";
        document.getElementById("cur_name").style.display = "block";
        document.getElementById("cur_amount").style.display = "block";
      }
      else
      {
        document.getElementById("moneyin").style.display = "none";
         
        document.getElementById("cur_id").style.display = "none";
        document.getElementById("cur_name").style.display = "none";
        document.getElementById("cur_amount").style.display = "none";
      }
    });
    </script>
 

@stop