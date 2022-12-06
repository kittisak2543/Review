@extends('layouts.master')


@section('content')
    
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <h1 class="text-light">{{$moviesel->name}}</h1>
                    <h5 class="text-light">{{$moviesel->type->name}}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Anime Section Begin -->
<section class="anime-details spad">
   
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="product__item__pic set-bg" data-setbg="{{asset('/storage/images/movie/'.$moviesel->image)}}">
                </div>
            </div>
            <div class="col-lg-8 m-auto">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{$moviesel->link_video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mt-4">
                @auth
                <div class="box_of_button" style="margin-bottom: 60px">
                    <?php 
                        $good = 0;
                        $bad =0;     
                        $colorlike = "btn btn-secondary" ;
                        $colordis = "btn btn-secondary";     
                    ?>
                   
                    @foreach ($moviesel->likes as $item)
                        
                        @if($item->rating == 0)
                            <?php 
                                $colorlike = "btn btn-secondary" ;
                                $colordis = "btn btn-secondary";
                            ?>
                        @endif
                        @if($item->rating == 1)
                            <?php 
                               
                                $good++;
                            ?>
                        @endif
                        @if($item->rating == 2)
                            <?php 
                                
                                $bad++;
                            ?>
                        @endif
                        @if (Auth::user()->id == $item->user->id)
                            @if ($item->rating == 1)
                                @php
                                    $colorlike = "btn btn-success" ;
                                @endphp
                            
                            @elseif($item->rating == 2)
                                @php
                                  $colordis = "btn btn-danger";
                                @endphp
                            @else
                                @php
                                    $colorlike = "btn btn-secondary" ;
                                    $colordis = "btn btn-secondary";
                                @endphp
                            @endif
                        @endif
                        
                    @endforeach
                    @php
                        
                    @endphp
                    <form action="{{route('addLikes')}}" method="post" style="width: 80px;margin: 0px;float:left" {{$status}} >
                        @csrf
                        
                        @auth
                        <input type="hidden" name="uid" value="{{Auth::user()->id}} ">
                        
                        
                        @endauth
                        <input type="hidden" name="rating" value="1">
                        <input type="hidden" name="mid" value="{{$moviesel->id}}">
                    
        
                        <button type="submit" {{$status}} class="{{$colorlike}}"><i class="fa fa-smile-o" style=color:lightgreen> {{$good}} </i></button>
                       
                    </form>
                    <form   action="{{route('addLikes')}}" method="post" {{$status}}  style="width: 80px ;margin: 0px;float:left" >
                        @csrf
                       
                        @auth
                        <input type="hidden" name="uid" value="{{Auth::user()->id}}">
                        
                        
                        @endauth
                        <input type="hidden" name="rating" value="2">
                        <input type="hidden" name="mid" value="{{$moviesel->id}}">
                    
        
                    
                         <button type="submit" {{$status}} class="{{$colordis}}"><i class="fa fa-frown-o"  style=color:lightcoral> {{$bad}} </i></button>
                    </form>
                </div>
                @endauth
                <div class="anime__details__episodes">
                    <div class="section-title">
                        <h5>Detail</h5>
                    </div>
                    <div class="text-light">
                        {{$moviesel->detail}}
                    </div>
                </div>
                <div class="trending__product ">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="section-title">
                                <h4>Recommend</h4>
                            </div>
                        </div>
                
                    </div>
                    <div class="row col-lg-12 col-md-12 col-sm-12">
                      
                        @if($rec != null)
                            @foreach($rec as $items)
                                @foreach($items as $item)
                                
                                    <a href="{{ url('detail/'.$item->id) }}">
                                            <img src="{{asset('/storage/images/movie/'.$item->image)}}" alt="" style=" height:250px; margin:20px;">
                                            
                                        
                                    </a>
                                @endforeach
                            @endforeach
                            
                      
                        @endif
                    </div>
                </div>
                <div class="anime__details__review">
                    <div class="section-title">
                        <h5>Reviews</h5>
                    </div>
                    @if (session("success"))
                        {{-- อันนี้ใช้ได้ เป็น สคริปที่เอาไว้โชว์ alert --}}
                        {{-- <script>
                            var msg = '{{Session::get('success')}}';
                            var exist = '{{Session::has('success')}}';
                            if(exist){
                            alert(msg);
                            }
                        </script> --}}
                        <div class="alert alert-success"> <b> {{session('success')}} </b></div>
                    @else
                    @error('name')
                        <div class="alert alert-danger"> <b> {{$message}} </b></div> 
                    @enderror
                    @endif
                    @foreach ($moviesel->comments as $item)
                    <div class="anime__review__item col-lg-8 ">
                      
                        <div class="anime__review__item__pic">
                            <img src="{{asset('img/anime/review-1.jpg')}} " alt="">
                        </div>
                        @auth
                        @php
                            $icon = "";
                            $color = "";
                        @endphp
                        
                        @if (Auth::user()->id != $item->user->id)
                        
                            @if ($item->rating == 1)
                                @php
                                    $icon = "fa fa-smile-o"  ;
                                    $color = "color: rgb(134, 241, 120)";
                                @endphp
                            
                            @else
                                @php
                                    $icon = 'fa fa-frown-o';
                                    $color = "color: red";
                                @endphp
                            @endif
                            <div class="anime__review__item__text">
                                <h6>{{$item->user->name}} - <span>{{$item->created_at->diffForHumans()}}</span> <i class="{{$icon}}"  aria-hidden="true" style="{{$color}}" ></i></h6>
                                <p>{{$item->detail}}</p>
                            </div>
                        @endif
                        
                        @if (Auth::user()->id == $item->user->id)
                            @if ($item->rating == 1)
                                @php
                                    $icon = "fa fa-smile-o"  ;
                                    $color = "color: rgb(134, 241, 120)";
                                @endphp
                            
                            @else
                                @php
                                    $icon = 'fa fa-frown-o';
                                    $color = "color: red";
                                @endphp
                            @endif
                            <div class="anime__review__item__text">
                               
                                <h6>{{$item->user->name}} - <span>{{$item->created_at->diffForHumans()}}</span>  <i class="{{$icon}}"  aria-hidden="true" style="{{$color}}" ></i></h6>
                                <p>{{$item->detail}}    </p>
                                <a href="{{ url('CommentDelete/'.$item->id) }}" class="btn btn-danger mt-2 "> Delete</a>
                            </div>
                        
                        @endif
                        @else
                         @if ($item->rating == 1)
                                @php
                                    $icon = "fa fa-smile-o"  ;
                                    $color = "color: rgb(134, 241, 120)";
                                @endphp
                            
                            @else
                                @php
                                    $icon = 'fa fa-frown-o';
                                    $color = "color: red";
                                @endphp
                            @endif
                            <div class="anime__review__item__text">
                                <h6>{{$item->user->name}} - <span>{{$item->created_at->diffForHumans()}}</span>  <i class="{{$icon}}"  aria-hidden="true" style="{{$color}}" ></i></h6>
                                <p>{{$item->detail}}</p>
                            </div>
                        @endif
                        
                    </div>
                    @endforeach
                    
                </div>
                <div class="anime__details__form">
                    <div class="section-title">
                        <h5>Your Comment</h5>
                    </div>
                   
                    
                    @if (!Auth::check())
                        <a href="{{ route('logint') }}" class="btn-danger btn"><i class="fa fa-location-arrow"></i> Login</a>
                    @else
                        <form   action="{{route('AddComment')}}" method="post" >
                            @csrf
                            <textarea placeholder="Your Comment" name="comment" required></textarea>
                            @auth
                            <input type="hidden" name="uid" value="{{Auth::user()->id}}">
                            
                            
                            @endauth
                            <input type="hidden" name="ddd" value="">
                            <input type="hidden" name="mid" value="{{$moviesel->id}}">
                        
                                <button type="submit"><i class="fa fa-location-arrow"></i> Review</button>     
                        
                            
                        </form>
                       
                    @endif
                  
                       
               
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Anime Section End -->

    
    
  
@endsection