@extends('admin.layouts.Admin-master')


@section('content')
  
<div class="row">
  
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <strong>Add Movie Type</strong> Form
            </div>
            <div class="card-body card-block">
               
                <form action="{{route('Edit-Type')}}" method="post" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="id" value=" {{$type->id}} ">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="Name" class=" form-control-label">Name</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="name" required value=" {{$type->name}} " name="name" placeholder="Enter Movie name..." class="form-control"></div>
                    </div>
                 
                    @error('Name')
                        <span class="text-danger my-2">{{$message}}</span>
                    @enderror
                   
                
            </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
    
                    </div>
                </form>
                
            
        </div>
    </div>
</div>

    
    
  
@endsection