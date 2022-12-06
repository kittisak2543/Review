@extends('admin.layouts.Admin-master')


@section('content')
    <div class="row">
        <div class="col-md-12">
           <h3>View Comment</h3>
               {{-- <a href="{{route('MovieForm')}}" class="btn btn-primary flex">+ Add Movie</a> --}}
        </div>
       
            
       
    </div>
    
    <div class="row mt-4">
        <div class="col-md-12">
            @if (session("success"))
               <div class="alert alert-success"> <b> {{session('success')}} </b></div>
               
                    
         
            @endif
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        
                    </div>
                    <div class="table order-table ov-h">
                        <table class="table " >
                            <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Movie name</th>
                                    <th>User name</th>
                                    <th>Comment detail</th>
                                    <th>rating</th>
                                    <th>Date</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comment as $item=>$value)
                                <tr role="row" class="odd">
                                    <td class="serial">{{$item+1}}</td>
                                  
                                    <td>{{$value->movie->name}}</td>
                                    <td>{{$value->user->name}}</td>
                                    <td >{{$value->detail}}</td>
                                    <td style="text-align: center;">{{$value->rating}}</td>
                                    <td>{{$value->created_at->diffForHumans()}}</td>
                                    
                                    
                                   
                                    <td  style="text-align: center;">
                                       
                                            <a href="{{  url('CommentDelete/'.$value->id)  }}" class="btn btn-danger "> <i class="fa fa-trash"></i></a>
                                      
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                          
                        </table>
                    </div> <!-- /.table-stats -->
                </div>
            </div>
            <div class="card-footer">
                {{-- {{$comment->links()}} --}}
            </div>

            
            
                
        </div>
        
       
  
@endsection