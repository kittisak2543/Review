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
                                    <th>picture</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Detail</th>
                                    <th>Link</th>
                                    <th>Rating</th>
                                    <th>Created</th>
                                    <th style="min-width: 200px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movie as $item=>$value)
                                <tr role="row" class="odd">
                                    <td class="serial">{{$movie->firstItem()+$loop->index}}</td>
                                    <td class="avatar">
                                        <div class="round-img">
                                            <img class="" src="{{asset('/storage/images/movie/'.$value->image)}}" style="width: 500px" alt="">
                                        </div>
                                    </td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->type->name}}</td>
                                    <td class="sorting_1">{{$value->detail}}</td>
                                    <td><a href="{{$value->link_video}}" class="btn btn-dark"> link</a></td>
                                    @php  
                                        
                                        $sub =0 ;
    
                                        $sub = ($value->likemovie * 100);

                                        $total_rating = 0;
                                        if($value->likeuser > 0){
                                            $total_rating =   $sub /  $value->likeuser;
                                            if($total_rating == 50){
                                            $icon = "fa fa-smile-o"  ;
                                            $color = "gray";
                                            }
                                            else if($total_rating > 50){
                                                $icon = "fa fa-smile-o"  ;
                                                $color = "green";
                                            }
                                            else{
                                                $icon = 'fa fa-frown-o';
                                                $color = "red";
                                            }
                                        }else{
                                            $color = "black";
                                        }
                                    @endphp
                                    
                                    <td style="text-align: center; color:{{$color}}" >{{number_format($total_rating,2)}}%</td>
                                    <td>{{$value->created_at->diffForHumans()}}</td>
                                   
                                    <td >
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="{{ url('ViewComment/'.$value->id) }}" class="btn btn-primary dropdown-item" style=" text-align: left;" ><i class="fa fa-comment " style="color:#3c99dc"></i> Comment</a>
                                                <a href="{{ url('edit/'.$value->id) }}" class="btn btn-success dropdown-item" style=" text-align: left;"><i class="fa fa-edit" style="color:#43a047"></i> Edit</a>
                                                <a href="{{ url('delete/'.$value->id) }}" class="btn btn-danger dropdown-item" style=" text-align: left;"><i class="fa fa-trash" style="color:#dc143c"></i> Delete</a>
                                                
                                                

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
                {{$movie->links()}}
            </div>

            
            
                
        </div>
        
        <div class="col-md-12 mt-4">
            <div class="card">
              
                <div class="card-body card-block">
                    <div class="row form-group">
                        <img id="output" src="img/picture.png" width="200" class="m-auto">
                    </div>
                    <form action="{{route('Add-Movie')}}" method="post"  enctype="multipart/form-data"  class="form-horizontal">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="image" class=" form-control-label">Picture</label></div>
                            <div class="col-12 col-md-9"> <input type="file" id="file-input" name="image" class="form-control-file" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"></div>
                            
                        </div>
                        
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="Name" class=" form-control-label">Name</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="Name" name="name" placeholder="Enter Movie name..." class="form-control"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="Type" class=" form-control-label">Type</label></div>
                            <div class="col-12 col-md-9">
                                <select name="type" id="selectSm" class="form-control">
                                   
                                    @foreach ($type as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                          
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="link" class=" form-control-label">Link Video</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="link" name="link" placeholder="Enter Movie Video Link..." class="form-control"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="Detail" class=" form-control-label">Detail</label></div>
                            <textarea name="detail" id="Detail" cols="30" placeholder="Enter Movie Detail..." class="col-12 col-md-9 form-control" rows="10"></textarea>
                            
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