@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add Currencies</h3>


    <div class="panel panel-default">
        <div class="panel-heading">
            Add Currencies
        </div>
        
        <div class="panel-body">
            
            <div class="row">
                <div class="col-xs-4 col-md-4 form-group">
                    {!! Form::model($currencies, ['action' => 'CurrenciesController@store']) !!}
                    
                    {!! Form::label('Description', 'Currencies Name', ['class' => 'control-label']) !!}
                     {!! Form::text('cur_name', old('cur_name'), ['class' => 'form-control date', 'placeholder' => '','required']) !!}
          
                </div>
               

                </div>  
            <input type="submit" class="btn btn-primary" value="Add Currency">
                    {!! Form::close() !!}
                 
            
            </div>
        
        <div id="showresults">
     
    </div>
        
   
        
    </div>
    
    
    
    <div class="panel panel-default">
        <div class="panel-heading">
            List
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($currencies) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>Currencies Name</th>
                       
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($currencies) > 0)
                        @foreach ($currencies as $cur)
                            <tr data-entry-id="{{ $cur->id }}">
                                <td></td>
                                <td>{{ $cur->cur_name or '' }}</td>
                               
                                <td>
                                    
                                    <a href="{{ route('currencies.edit',[$cur->id]) }}" class="btn btn-xs btn-info">Edit</a>
                                    Delete not allowed
<!--                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Are you sure?")."');",
                                        'route' => ['currencies.destroy', $cur->id])) !!}
                                    {!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}-->
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">No entries in table</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
    
 
    
    <input type="hidden" id="token" value="{{csrf_token()}}">
    

   
@stop

@section('javascript')
    @parent
 
 

   @stop

