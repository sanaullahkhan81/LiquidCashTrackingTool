<!-- Modal 2 -->
<div class="modal fade" id="addContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Currencies Amount</h4>
      </div>
      <div class="modal-body">
          <div class="panel-body">
            
            {!!Form::open(['method'=>'post','action' => 'CurrenciesController@updatingCurrencies'])!!}
            <div class="row">
                <div class="col-xs-12 col-md-12 form-group">
                    
                    
                    {!! Form::label('actual Amount', 'Actual Amount', ['class' => 'control-label']) !!}
                     {!! Form::number('actual_amount', old('actual_amount'), ['class' => 'form-control date', 'placeholder' => '','readonly' ,'id'=> 'a_amount']) !!}
                     {!! Form::text('entry_date', old('entry_date'), ['class' => 'form-control date', 'placeholder' => '','readonly' ,'id'=> 'entry_date']) !!}
               {!! Form::text('cur_id', old('cur_id'), ['class' => 'form-control date', 'placeholder' => '','readonly' ,'id'=> 'cur_id']) !!}
                </div>
               

            </div> 
            
            <div class="row">
                <div class="col-xs-12 col-md-12 form-group">
                    
                    
                    {!! Form::label('entered_amount', 'Enter Available Amount', ['class' => 'control-label']) !!}
                     {!! Form::number('e_amount', old('entered_amount'), ['class' => 'form-control date', 'placeholder' => '',  'onkeyup'=>'addvariances()' ,'id'=>'e_amount']) !!}
          
                </div>
               

            </div>
            
            <div class="row">
                <div class="col-xs-12 col-md-12 form-group">
                    
                    
                    {!! Form::label('variance', 'Variance Amount', ['class' => 'control-label']) !!}
                     {!! Form::number('variance', old('variance'), ['class' => 'form-control date', 'placeholder' => '' ,'id'=>'cur_variance', 'readonly']) !!}
          
                </div>
               

            </div>
              <div class="row">
                <div class="col-xs-12 col-md-12 form-group">
                    
                    
                    {!! Form::label('reason', 'Reason for Changing Amount', ['class' => 'control-label']) !!}
                     {!! Form::textarea('reason', old('reason'), ['class' => 'form-control date','rows' => 3, 'placeholder' => '',  'id'=>'reason']) !!}
          
                </div>
               

            </div>
            
           
            
            <input type="submit" class="btn btn-primary" value="Add Amount">
                    {!! Form::close() !!}
                 
            
            </div>
      </div>
      
    </div>
  </div>
</div>
  

 <script>
    function addvariances(){
        
        var actual_amount = document.getElementById("a_amount").value;
        var entered_amount = document.getElementById("e_amount").value;
        
        console.log('actual_amount'+actual_amount);
        var variance =    entered_amount - actual_amount ;
    
        document.getElementById("cur_variance").value = variance;
        
    }
    
    
    
</script>   