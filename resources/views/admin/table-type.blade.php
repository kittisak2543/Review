@extends('admin.layouts.Admin-master')


@section('content')
<div class="row">
    <div class="col-md-12">
       <h3> Type Manage</h3>
          
    </div>
</div>
  
<div class="row mt-4">
    <div class="col-md-8">
        
        @if (session("notdel"))
        <div class="alert alert-danger"> <b> {{session('notdel')}} </b></div>
        @endif
        @if (session("success"))
           <div class="alert alert-success"> <b> {{session('success')}} </b></div>
        @else
            @error('name')
                <div class="alert alert-danger"> <b> {{$message}} </b></div> 
             @enderror
             
            
        @endif
        <div class="card">
            <div class="card-header">
               
            </div>
            <div class="table-stats order-table ov-h">
                <table class="table ">
                    <thead>
                        <tr>
                            <th class="serial">#</th>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($type as $item=>$value)
                        <tr>
                            
                            <td class="serial">{{$type->firstItem()+$loop->index}}</td>
                            
                            <td>  <span class="name">{{$value['name']}}</span> </td>
                            
                            <td>
                                <span class="name">
                                    <a href="{{ url('type_edit/'.$value->id) }}" class="btn btn-success"> Edit</a>
                                </span>
                            </td>
                            <td>
                                <span class="name">
                                    <a href="{{ url('type_delete/'.$value->id) }}" class="btn btn-danger "> Delete</a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               
            
            </div> <!-- /.table-stats -->
           
        </div>
        <div class="card-footer">
            {{$type->links()}}
        </div>
        
            
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <strong>Add Movie Type</strong> Form
            </div>
            <div class="card-body card-block">
               
                <form action="{{route('Add-Type')}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="Name" class=" form-control-label">Name</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="tname" name="name" placeholder="Enter Type name..." class="form-control"></div>
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