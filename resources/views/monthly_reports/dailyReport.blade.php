    <div class="panel panel-default">
        <div class="panel-heading">
            Breakdown by Category
        </div>
        {!! Form::close() !!}
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Money In</th>
                            <td>{{ $incomeAmount }}</td>
                        </tr>
                        <tr>
                            <th>Money Out</th>
                            <td>{{ $expenseAmount }}</td>
                        </tr>
                        
                    </table>
                </div>
          <div class="col-md-4">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Money In Total</th>
                            <th>{{ number_format($inc_total, 2) }}</th>
                        </tr>
                    @foreach($inc_summary as $inc)
                        <tr>
                            <th>{{ $inc['name'] }}</th>
                            <td>{{ number_format($inc['amount'], 2) }}</td>
                        </tr>
                    @endforeach
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Money Out Total</th>
                            <th>{{ number_format($exp_total, 2) }}</th>
                        </tr>
                    @foreach($exp_summary as $inc)
                        <tr>
                            <th>{{ $inc['name'] }}</th>
                            <td>{{ number_format($inc['amount'], 2) }}</td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>