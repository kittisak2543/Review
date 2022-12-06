@extends('admin.layouts.Admin-master')


@section('content')
    <div class="row">
        <div class="col-md-12">
           <h3> Movie Manage</h3>
               {{-- <a href="{{route('MovieForm')}}" class="btn btn-primary flex">+ Add Movie</a> --}}
        </div>
       
            
       
    </div>
    
    <div class="row mt-4">
        <div class="col-md-12">
            @if (session("success"))
               <div class="alert alert-success"> <b> {{session('success')}} </b></div>
            @else
                @error('name')
                <div class="alert alert-danger"> <b> {{$message}} </b></div> 
                @enderror
                @error('detail')
                <div class="alert alert-danger"> <b> {{$message}} </b></div> 
                @enderror
                @error('type')
                <div class="alert alert-danger"> <b> {{$message}} </b></div> 
                @enderror
                @error('link')
                <div class="alert alert-danger"> <b> {{$message}} </b></div> 
                @enderror
                @error('image')
                <div class="alert alert-danger"> <b> {{$message}} </b></div> 
                @enderror
            @endif
            <div class="col-lg-12">
                <div class="card">
                    
                    <div class="card-header">
                        <div class="d-flex flex-row-reverse bd-highlight">
                            <div class="p-2 bd-highlight">
                              
                            </div>
                            
                        </div>
                       
                      
                       
                    </div>
                    <div class="table order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($message as $item=>$value)
                                <tr role="row" class="odd">
                                    <td class="serial">{{$message->firstItem()+$loop->index}}</td>
                                   
                                    <td>{{$value->name}}</td>
                                   
                                    <td class="sorting_1">{{$value->email}}</td>
                                    <td class="sorting_1">{{$value->subject}}</td>
                                    <td class="sorting_1">{{$value->message}}</td>
                                    <td>{{$value->created_at->diffForHumans()}}</td>
                                   
                                    <td >
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="{{ url('delete/message/'.$value->id) }}" class="btn btn-danger dropdown-item" style=" text-align: left;"><i class="fa fa-trash" style="color:#dc143c"></i> Delete</a>
                                                
                                                

                                            </div>
                                          </div>
                                    </td> 
                                     
                                   
                                </tr>
                                @endforeach
                            </tbody>
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                </div>
            </div>
            <div class="card-footer">
                {{$message->links()}}
            </div>

            
            
                
        </div>
       
    </div>
  
@endsection