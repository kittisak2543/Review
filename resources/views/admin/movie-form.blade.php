@extends('admin.layouts.Admin-master')


@section('content')
    <div class="row">
        <div class="col-md-12">
           <h3> Movie Edit Form</h3>
               
        </div>
       
            
       
    </div>
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>Edit Movie</strong> Form
                </div>
                <div class="card-body card-block">
                    <div class="row form-group">
                        <img id="output" src="{{asset('/storage/images/movie/'.$movie->image)}}" width="200" class="m-auto">
                    </div>
                    <form action=" {{route('Edit-Movie')}} " method="post"  enctype="multipart/form-data"  class="form-horizontal">
                        @csrf
                        <input type="hidden"  name="id" value=" {{$movie->id}} ">
                        <input type="hidden" name="image" value='{{$movie->image}} '>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="image" class=" form-control-label">Picture</label></div>
                            <div class="col-12 col-md-9"> <input type="file" id="file-input" name="image" class="form-control-file" value=" "  onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"></div>
                            
                        </div>
                        
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="Name" class=" form-control-label">Name</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="name" required name="name" placeholder="Enter Movie name..." class="form-control" value=" {{$movie->name}}"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="Type" class=" form-control-label">Type</label></div>
                            <div class="col-12 col-md-9">
                                <select name="type" id="selectSm" class="form-control">
                                    <option value="0">Please select Type</option>
                                    @foreach ($type as $item)
                                        @if ($item->id == $movie->type->id)
                                            <option selected value="{{$item->id}}">{{$item->name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endif
                                        
                                    @endforeach
                                </select>
                            </div>
                          
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="link" class=" form-control-label">Link Video</label></div>
                            <div class="col-12 col-md-9"><input required type="text" id="link" name="link" placeholder="Enter Movie Video Link..." class="form-control" value=" {{$movie->link_video}} "></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="Detail" class=" form-control-label">Detail</label></div>
                            <textarea name="detail" id="detail" cols="30" placeholder="Enter Movie Detail..." class="col-12 col-md-9 form-control" rows="10" required  >{{$movie->detail}}</textarea>
                            
                        </div>
                        @error('name')
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