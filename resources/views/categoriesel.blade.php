@extends('layouts.master')


@section('content')
    
<!-- Product Section Begin -->
<section class="product-page spad" style="min-height: 800px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @foreach ($typea as $itemType)
                    <div class="product__page__content">
                        @if ($itemType->movie != null && $itemType->id == $typeid)
                            <div class="product__page__title">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-6">
                                        <div class="section-title">
                                            <h4>{{$itemType->name}}</h4>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="product__page__filter">
                                           
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <h1 style="color: white; text-align: center;">{{"Don't has movie"}}</h1>
                        @endif
                        <div class="row">
                            @foreach ($movie as $item)  
                                @if ($item->type->id == $itemType->id)
                                    <a href="{{ url('detail/'.$item->id) }}">
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg" data-setbg="{{asset('/storage/images/movie/'.$item->image)}}">
                                                    @php  
                                        
                                                        $sub =0 ;

                                                        $sub = ($item->likemovie * 100);

                                                        $total_rating = 0;
                                                        if($item->likeuser > 0){
                                                            $total_rating =   $sub /  $item->likeuser;
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
                                                    <div class="ep" style="background-color: {{$color}}">{{number_format($total_rating,2) }}  % </div>
                                                    <div class="comment"><i class="fa fa-comments"></i> {{$item->comments->count()}}</div>
                                                    <div class="view"><i class="fa fa-smile-o" style="color:lightgreen"> {{$item->likes->where('rating',1)->count()}} </i>  <i class="fa fa-frown-o" style="color: lightcoral"> {{$item->likes->where('rating',2)->count()}} </i>  </div>
                                                    {{-- <div class="view"><i class="fa fa-eye"> --}}
                                                </div>
                                                <div class="product__item__text">
                                                    <ul>
                                                        <li>{{$item->type->name}}</li>
                                                        
                                                    </ul>
                                                    <h5><a href="#">{{$item->name}}</a></h5>
                                                </div>
                                            </div>
                                        </div>   
                                    </a>                             
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach       
</section>
<!-- Product Section End -->

    
    
  
@endsection


