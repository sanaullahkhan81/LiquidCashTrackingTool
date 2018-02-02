@extends('layouts.app')

@section('content')
    <h3 class="page-title">Custom Report</h3>

    
    
    
    <div class="panel panel-default">
        <div class="panel-heading">
            Balance Amount
        </div>
        
        <div class="panel-body">
            
            <div class="col-md-4">
                    <table class="table table-bordered table-striped">

                        <tr>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    @foreach($amount as $amt)
                        <tr>
                            <th>{{$amt->amount}}</th>
                            
           

<td>
    <button type="button" id='openModel' class="btn btn-danger btn-sm" data-toggle="modal" 
            data-amount='{{$amt->amount}}'
            data-date ='{{$today}}'
            data-target="#deleteConfirmation">
         Edit Amount
      </button>

</td>
                        </tr>
                    @endforeach
                 
                    </table>
                </div>
     
            
        </div>
        
     
  @include('amount.create')  
        
    </div>
    
    
    
      <div class="panel panel-default">
        <div class="panel-heading">
            Currencies Amount
        </div>
        
        <div class="panel-body">
            
            <div class="col-md-12">
                    <table class="table table-bordered table-striped">

                        <tr>
                            <th>Cur Name</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    @foreach($currencies as $cur)
                        <tr>
                            <th>{{$cur->cur_name}}</th>
                            <th>{{$cur->amount}}</th>
                            
           

<td>
<button type="button" id="openModelCurrencies" class="btn btn-primary btn-sm" data-toggle="modal" 
                                        data-amount='{{$cur->amount}}'
                                        data-date ='{{$today}}'
                                        data-curid =' {{$cur->id}}'
                                        data-target="#addContact">
         Edit Currencies
      </button>

</td>
                        </tr>
                    @endforeach
                 
                    </table>
                </div>
     
            
        </div>
        
             
        
    </div>
   @include('currencies.curamountedit') 
    <input type="hidden" id="token" value="{{csrf_token()}}">
    

   
@stop

@section('javascript')
    @parent
    <script>
         $(document).on("click", "#openModel", function () {
        
     var actual_amount = $(this).data('amount');
     var date = $(this).data('date');
     
     
     $("#deleteConfirmation #actual_amount").val( actual_amount );
     $("#deleteConfirmation #entry_date").val( date );
     
     
});

   $(document).on("click", "#openModelCurrencies", function () {
        
    var actual_amount = $(this).data('amount');
     var date = $(this).data('date');
      var cur_id = $(this).data('curid');
     
     $("#addContact #a_amount").val( actual_amount );
     $("#addContact #entry_date").val( date );
     $("#addContact #cur_id").val( cur_id );
   
     
});
    </script>

   @stop