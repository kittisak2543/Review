@extends('admin.layouts.Admin-master')


@section('content')
<div class="row">
    <div class="col-md-12">
       <h3> Account Manage</h3>
          
    </div>
</div>
  
<div class="row mt-4">
    <div class="col-md-12">
        
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
                            <th>Email</th>
                            <th>role</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($user as $item=>$value)
                          
                        <tr>
                            
                            <td class="serial">{{$user->firstItem()+$loop->index}}</td>
                            
                            <td>  <span class="name">{{$value->name}}</span> </td>
                            <td>  <span class="email">{{$value->email}}</span> </td>
                            <td>  <span class="role">{{$value->role == 1 ? "Admin" : "Users"}}</span> </td>
                            <td>  <span class="created">{{$value->created_at->diffForHumans()}}</span> </td>
                            
                            
                            <td>
                                @if($value->id != Auth::user()->id)
                                <span class="action">
                                    <a href="{{ url('account_delete/'.$value->id) }}" class="btn btn-danger "> Delete</a>
                                </span>
                                @else
                                <span class="action">
                                    <a href="#" class="btn btn-secondary "> Delete</a>
                                </span>
                                @endif
                            </td>
                            
                        </tr>
                            
                        @endforeach
                    </tbody>
                </table>
               
            
            </div> <!-- /.table-stats -->
           
        </div>
        <div class="card-footer">
            {{$user->links()}}
        </div>
        
            
    </div>
    
  
</div>

    
    
  
@endsection