@extends('layouts.app')

@section('content')
    <h3 class="page-title">Daily Report</h3>


    <div class="panel panel-default">
        <div class="panel-heading">
            Report
        </div>
        
        <div class="panel-body">
            
            <div class="row">
            <div class="col-xs-4 col-md-4 form-group">
                <label for="year" class="control-label">Select Date</label>
                {!! Form::text('entry_date', old('date_created', 
                Carbon\Carbon::today()->format('Y-m-d')), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    </div>

                    <div class="col-xs-4">
                        <label class="control-label">&nbsp;</label><br>
                        <input class="btn btn-primary" id="getreportBtn" type="submit" value="Get Report">
                    </div>
        </div>
            
                 
            
        </div>
        
        <div id="showresults">
     
    </div>
        
   
        
    </div>
    <input type="hidden" id="token" value="{{csrf_token()}}"
    

   
@stop

@section('javascript')
    @parent
     <script>
        $('.date').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}",
            maxDate: new Date
        });
    
        
        
    
 
  
    
   
        
        $("#getreportBtn").click(function() {

            //  alert($(".date").datepicker("getDate"));
            // alert($('#token').val())
            var date = $(".date").datepicker("getDate");
            var date = ($.datepicker.formatDate("yy-mm-dd", date));
            
            $.ajax({
                    url: 'getreport/'+date,
                    type: "POST",
                    data: {_token:$('#token').val()},
                    success: function(data)
                        {
                           $('#showresults').html(data);
                        }
                });

                });
    
        
    </script>
 

   @stop