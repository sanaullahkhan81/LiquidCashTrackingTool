<div class="modal fade" id="yourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Enter Closing for {{$date}}</h4>
      </div>
      <div class="modal-body">
       
       
       
          <div class="panel-body">
            
            {!!Form::open(['route' => 'curBalance.store'])!!}
            <div class="row">
                <div class="col-xs-4 col-md-4 form-group">
                    
                    
                    {!! Form::label('Description', 'Currencies Name', ['class' => 'control-label']) !!}
                     {!! Form::text('cur_name', old('cur_name'), ['class' => 'form-control date', 'placeholder' => '','readonly' ,'id'=> 'cur_bal_cur_name']) !!}
                     {!! Form::text('cur_bal_id', old('cur_bal_id'), ['class' => 'form-control date', 'placeholder' => '','readonly' ,'id'=> 'cur_bal_id']) !!}
          
                </div>
               

            </div> 
            
            <div class="row">
                <div class="col-xs-4 col-md-4 form-group">
                    
                    
                    {!! Form::label('cur_bal_entry_date', 'Date', ['class' => 'control-label']) !!}
                     {!! Form::text('cur_bal_entry_date', old('cur_bal_entry_date'), ['class' => 'form-control date', 'placeholder' => '',  'id'=>'cur_bal_entry_date','readonly']) !!}
          
                </div>
               

            </div>
            
            
              <div class="row">
                <div class="col-xs-4 col-md-4 form-group">
                    
                    
                    {!! Form::label('cur_bal_cur_amount', 'Amount', ['class' => 'control-label']) !!}
                     {!! Form::text('cur_bal_cur_amount', old('cur_bal_cur_amount'), ['class' => 'form-control date', 'placeholder' => '',  'id'=>'cur_bal_cur_amount','readonly']) !!}
          
                </div>
               

            </div>
            
              <div class="row">
                <div class="col-xs-4 col-md-4 form-group">
                    
                    
                    {!! Form::label('cur_bal_entry_act_amount', 'Enter Actual Amount', ['class' => 'control-label']) !!}
                     {!! Form::number('cur_bal_entry_act_amount', old('cur_bal_entry_act_amount'), ['class' => 'form-control date', 'placeholder' => '',  'id'=>'cur_bal_entry_act_amount','required','onkeyup'=>"variance()"]) !!}
          
                </div>
               

            </div>
            
             <div class="row">
                <div class="col-xs-4 col-md-4 form-group">
                    
                    
                    {!! Form::label('cur_bal_entry_act_var', 'Variance', ['class' => 'control-label']) !!}
                     {!! Form::number('cur_bal_entry_act_var', old('cur_bal_entry_act_var'), ['class' => 'form-control date', 'placeholder' => '',  'id'=>'cur_bal_entry_act_var','readonly']) !!}
          
                </div>
               

            </div>
            
            
            <input type="submit" class="btn btn-primary" value="Add Amount">
                    {!! Form::close() !!}
                 
            
            </div>
        
       
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<script>
    function variance(){
        
        var cur_amount = document.getElementById("cur_bal_cur_amount").value;
        var entering_amount = document.getElementById("cur_bal_entry_act_amount").value;
        
        
        var variance =    entering_amount - cur_amount ;
        console.log(variance);
        document.getElementById("cur_bal_entry_act_var").value = variance;
        
    }
    
</script>