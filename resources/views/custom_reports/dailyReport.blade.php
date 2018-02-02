     
<div class="panel panel-default">
        <div class="panel-heading">
            Report for : {{$date}}
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <table class="table table-bordered table-striped">
                         <tr>
                            <th>Opening Balance</th>
                            <th>{{$openingBalance->closing}}</th>
                        </tr>
                        <tr>
                            <th>Income</th>
                            <td>{{$incomeAmount}}</td>
                        </tr>
                        <tr>
                            <th>Expenses</th>
                            <td>{{$expenseAmount}}</td>
                        </tr>
                        <tr>
                            <th>Profit</th>
                            <td>{{$incomeAmount-$expenseAmount}}</td>
                        </tr>
                         <tr>
                            <th>Today Closing Amount</th>
                            <td><input type="text" class="form-control" id='closingAmount' onkeyup="calVariance()" value="{{$todayClosingBalance}}"></td>
                        </tr>
                        <tr>
                            <th>Variance</th>
                            <td><input type="textbox" id="variance" readonly="readonly" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Cash Available</th>
                            <td><input type="text"  class="form-control" readonly='readonly' value="{{$cashNow}}"> </td>
                        </tr>
                        
                        <tr>
                            
                            <td colspan="2">
                                
                                <button id="submitClosing" class="btn btn-primary"> Submit Closing Amount</button>
                            </td>
                        </tr>
                        
                    </table>
                </div>
     
             @include('custom_reports/currenciesBalance')
            </div>
            
            
        </div>
    <input type="hidden" id="token" value="{{csrf_token()}}"
    </div>

</div>
    
<script>
    
    $( document ).ready(function() {
         var cashNow = "{{$cashNow}}";
        
        var amount = document.getElementById("closingAmount").value;
        var variance = amount-cashNow ;
        document.getElementById("variance").value = variance;
    
    });
    
    function calVariance(){
   
        var cashNow = "{{$cashNow}}";
        
        var amount = document.getElementById("closingAmount").value;
        var variance = amount-cashNow ;
        document.getElementById("variance").value = variance;
        
    }
    
  $('#submitClosing').click(function(){
    var entry_date = "{{$date}}";     
    var variance = document.getElementById("variance").value;
    var closing = document.getElementById("closingAmount").value;
    console.log(entry_date,variance,closing);
  
    $.ajax({
                    url: 'storeClosing',
                    type: "POST",
                    data: {_token:$('#token').val(),
                            entry_date:entry_date,
                            variance:variance,
                            closing:closing
                          },
                    
                });
  
});




</script>

