@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add Currencies</h3>


    <div class="panel panel-default">
        <div class="panel-heading">
            Add Currencies
        </div>
        
        <div class="panel-body">
                             {!! Form::model($currencies, ['method' => 'PUT', 'route' => ['currencies.update', $currencies->id]]) !!}

            <div class="row">
                <div class="col-xs-4 col-md-4 form-group">
                   
                   
                    
                    {!! Form::label('Description', 'Currencies Name', ['class' => 'control-label']) !!}
                    {!! Form::text('cur_name',old('cur_name'),array('class' => 'form-control')) !!}
               
          
                </div>
               

                </div> 
    
            <input type="submit" class="btn btn-primary" value="Edit Currency">
            
                    {!! Form::close() !!}
                 
            
            </div>
        
        <div id="showresults">
     
    </div>
        
   
        
    </div>
    
    @stop
    @section('javascript')
    @parent
 
 

   @stop
