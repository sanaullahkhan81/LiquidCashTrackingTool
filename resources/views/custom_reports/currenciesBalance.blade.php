            <div class="col-md-8">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Currencies</th>
                            <th>Amount</th>
                            
                            <th>Action</th>
                            
                        </tr>
                 @foreach($currencies as $cur)  
                        <tr>
                            <th>{{$cur->cur_name}}</th>
                            <td>{{$cur->amount}}</td>
                            
                   
                            <td><button type="button" id="openModel" class="btn btn-primary" data-toggle="modal" 
                                        data-entry_date="{{$cur->entry_date}}" 
                                        data-cur_name="{{$cur->cur_name}}" 
                                        data-cur_amount="{{$cur->amount}}"
                                        data-cur_id="{{$cur->id}}"
                                        data-target="#yourModal">Enter Closing</button></td>
                             
                        </tr>
                @endforeach        
             
                    </table>
            </div>


   
@include('curBalance.create')

<script>
    $(document).on("click", "#openModel", function () {
        
     var entry_date = $(this).data('entry_date');
     var cur_bal_cur_name = $(this).data('cur_name');
     var cur_bal_cur_amount = $(this).data('cur_amount');
     var cur_bal_cur_id = $(this).data('cur_id');
     $("#yourModal #cur_bal_entry_date").val( entry_date );
     $("#yourModal #cur_bal_cur_name").val( cur_bal_cur_name );
     $("#yourModal #cur_bal_cur_amount").val( cur_bal_cur_amount );
     $("#yourModal #cur_bal_id").val( cur_bal_cur_id );
     
     
});

</script>