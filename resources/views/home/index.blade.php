@extends('frontend.master', ['activePage' => 'home'])
@section('title', __('Home'))
@section('content')
<style>
    .btn-white{
        background-color: #fff;
        border-radius: 4px;
        color: #000;
    }
.type_cat{
    padding: 9px !important;   
    background: #ffd700;
    color: #000;
}
.location{
    background: #db207b;
    color: #fff;
    border-radius: 20px;
    padding: 4px 10px;
    font-size: 11px !important;
    position: absolute;
    top: -12px;
    right: 10px;
}
.category{
    background: #ffd700;
    color: #000000;
    border-radius: 20px;
    padding: 4px 10px;
    font-size: 11px !important;
    position: absolute;
    top: 10px;
    left: 7px;
}
</style>
<div class="pt-3 pb-3 shadow-sm home-slider">
    <div class="osahan-slider">
        @if (isset($tournament) && count($tournament['banner_img']))
            @foreach ($tournament['banner_img'] as $item)
                <div class="osahan-slider-item">
                    {{-- <a @if($item->redirect_link != null) href="{{$item->redirect_link}}" @endisset > --}}
                        <img src="{{env('BACKEND_BASE_URL')}}/{{$item}}" class="img-fluid rounded" alt="...">
                    {{-- </a> --}}
                </div>
            @endforeach
        @endif
    </div>
</div>
<div class="container mt-5">
    {{-- @if(count($coachingsData))
        @foreach ($coachingsData as $category)
            <div class="hawan_section">
                <div class="d-sm-flex align-items-center justify-content-between mt-5 mb-3 overflow-hidden">
                    <h1 class="h4 mb-0 float-left">{{$category->name}}</h1>
                    <a href="{{url('coachings/'.Str::slug($category->name).'/'.$category->id)}}" class="d-sm-inline-block text-xs float-right "> Explore All </a>
                </div>
                <div class="event-block-slider">
                    @foreach ($category->coachings as $coaching)
                        <div class="card m-card shadow-sm border-0 listcard">
                            <div>
                                <div class="m-card-cover">
                                    <img src="{{asset('uploads/'.$coaching->poster_image)}}" class="card-img-top" alt="{{$coaching->coaching_title}}">
                                </div>
                                <div class="card-body">
                                    <div class="rating-star mb-1">
                                        {!!Common::randomRatings()!!}
                                    </div>
                                    <h5 class="card-title mb-2"><u>{{$coaching->coaching_title}}</u></h5>
                                    <p class="card-text mb-0">
                                        <small class="text-dark" title="{{ $coaching->venue_name }}"><i class="fas fa-map-marker-alt pr-1"></i>
                                        {{ strlen($coaching->venue_name) > 50 ? substr($coaching->venue_name, 0, 50) . '...' : $coaching->venue_name }}
                                        </small>
                                    </p>

                                    @php
                                        // $sessionDays = isset($coaching->coachingPackage->session_days) ? json_decode($coaching->coachingPackage->session_days, true) : [];
                                    @endphp
                                    @if(isset($coaching->coachingPackage) && $coaching->coachingPackage!=null)
                                        <p class="my-1 text-light"><small> 
                                            {{ $coaching->venue_area.', '.$coaching->venue_address.', '.$coaching->venue_city }}    
                                        </small></p>

                                        <div class="mt-2 d-flex justify-content-between align-items-center">
                                        {!!Common::showDiscountLabel($coaching->coachingPackage->package_price, $coaching->coachingPackage->discount_percent )!!}  
                                        
                                            <a href="{{url('coaching-book/'.$coaching->id.'/'.Str::slug($coaching->coaching_title))}}" class="mt-1 btn btn-success btn-sm mb-1 ">Book Now</a>
                                        </div>
                                    @endif
                                
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        
    @endif --}}

    @if (isset($tournament) && count($tournament['latest_event']))
        <div class="hawan_section">
            <div class="d-sm-flex align-items-center justify-content-between mt-5 mb-3 overflow-hidden">
                <h1 class="h4 mb-0 float-left">Latest Tournament</h1>
                <a href="{{url('tournament-type',['type'=>'latest'])}}" class="d-sm-inline-block text-xs float-right "> See All </a>
            </div>
            <div class="event-block-slider">
                @foreach ($tournament['latest_event'] as $tour)
                    <div class="card m-card shadow-sm border-0 listcard">
                        <div>
                            <div class="m-card-cover  position-relative">
                                <img src="{{env('BACKEND_BASE_URL')}}/{{$tour['event_img']}}" class="card-img-top" alt="{{$tour['event_title']}}">
                                @isset($tour['cid'])
                                    <a href="{{route('tournament',['category'=>$tour['category'],'id'=>$tour['cid']])}}" class="my-2"><small class="category">{{$tour['category']}}</small></a>
                                @endisset
                            </div>
                            <div class="card-body position-relative">
                                <h5 class="card-title mb-2"><u>{{$tour['event_title']}}</u></h5>
                                <small>{{$tour['event_sdate']}}</small>
                                <p class="my-2"><small class="location"><i class="fas fa-map-marker-alt pr-1"></i>{{$tour['event_place_name']}}</small></p>
                                <p class="card-text mb-0">
                                    <small class="text-dark" title="{{$tour['event_place_address']}}"><i class="fas fa-map pr-1"></i>
                                    {{ strlen($tour['event_place_address']) > 50 ? substr($tour['event_place_address'], 0, 50) . '...' : $tour['event_place_address'] }}
                                    </small>
                                </p>
                                @isset($tour['ticket_types'])
                                    @foreach ($tour['ticket_types'] as $key => $item)
                                        <span class="badge badge-primary m-1 type_cat" data-toggle="tooltip" data-placement="top" title="{{ $key }}">{{ $item }}</span>
                                    @endforeach
                                @endisset
                                <div class="mt-2 d-flex justify-content-between align-items-center">
                                    <a href="{{route('tournament-detail', [$tour['event_id'], Str::slug($tour['event_title'])])}}" class="mt-1 btn btn-success btn-sm mb-1">Book Now</a>

                                    <button class="mt-1 btn btn-white btn-sm mb-1">{{$tour['event_ticket_price']}}</button>
                                </div>
                                @php
                                    // $sessionDays = isset($coaching->coachingPackage->session_days) ? json_decode($coaching->coachingPackage->session_days, true) : [];
                                @endphp
                                {{-- @if(isset($coaching->coachingPackage) && $coaching->coachingPackage!=null)
                                    <p class="my-1 text-light"><small> 
                                        {{ $coaching->venue_area.', '.$coaching->venue_address.', '.$coaching->venue_city }}    
                                    </small></p>

                                    <div class="mt-2 d-flex justify-content-between align-items-center">
                                    {!!Common::showDiscountLabel($coaching->coachingPackage->package_price, $coaching->coachingPackage->discount_percent )!!}  
                                        <a href="{{url('coaching-book/'.$coaching->id.'/'.Str::slug($coaching->coaching_title))}}" class="mt-1 btn btn-success btn-sm mb-1 ">Book Now</>
                                    </div>
                                @endif --}}
                            
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if (isset($tournament) && count($tournament['nearby_event']))
        <div class="hawan_section">
            <div class="d-sm-flex align-items-center justify-content-between mt-5 mb-3 overflow-hidden">
                <h1 class="h4 mb-0 float-left">Nearby Tournament</h1>
                <a href="{{url('tournament-type',['type'=>'nearby'])}}" class="d-sm-inline-block text-xs float-right "> See All </a>
            </div>
            <div class="event-block-slider">
                @foreach ($tournament['nearby_event'] as $tour)
                    <div class="card m-card shadow-sm border-0 listcard">
                        <div>
                            <div class="m-card-cover position-relative">
                                <img src="{{env('BACKEND_BASE_URL')}}/{{$tour['event_img']}}" class="card-img-top" alt="{{$tour['event_title']}}">
                                @isset($tour['cid'])
                                    <a href="{{route('tournament',['category'=>$tour['category'],'id'=>$tour['cid']])}}" class="my-2"><small class="category">{{$tour['category']}}</small></a>
                                @endisset
                            </div>
                            <div class="card-body  position-relative">
                                <h5 class="card-title mb-2"><u>{{$tour['event_title']}}</u></h5>
                                <small>{{$tour['event_sdate']}}</small>
                                <p class="my-2"><small class="location"><i class="fas fa-map-marker-alt pr-1"></i>{{$tour['event_place_name']}}</small></p>
                                <p class="card-text mb-0">
                                    <small class="text-dark" title="{{$tour['event_place_address']}}"><i class="fas fa-map-marker-alt pr-1"></i>
                                    {{ strlen($tour['event_place_address']) > 50 ? substr($tour['event_place_address'], 0, 50) . '...' : $tour['event_place_address'] }}
                                    </small>
                                </p>
                                @isset($tour['ticket_types'])
                                    @foreach ($tour['ticket_types'] as $key =>  $item)
                                        <span class="badge badge-primary m-1 type_cat" data-toggle="tooltip" data-placement="top" title="{{ $key }}">{{ $item }}</span>
                                    @endforeach
                                @endisset
                                <div class="mt-2 d-flex justify-content-between align-items-center"> 
                                    <a href="{{route('tournament-detail', [$tour['event_id'], Str::slug($tour['event_title'])])}}" class="mt-1 btn btn-success btn-sm mb-1 ">Book Now</a>
                                    <button class="mt-1 btn btn-white btn-sm mb-1">{{$tour['event_ticket_price']}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


    @if (isset($tournament) && count($tournament['this_month_event']))
        <div class="hawan_section">
            <div class="d-sm-flex align-items-center justify-content-between mt-5 mb-3 overflow-hidden">
                <h1 class="h4 mb-0 float-left">Monthly Tournament</h1>
                <a href="{{url('tournament-type',['type'=>'monthly'])}}" class="d-sm-inline-block text-xs float-right "> See All </a>
            </div>
            <div class="event-block-slider">
                @foreach ($tournament['this_month_event'] as $tour)
                    <div class="card m-card shadow-sm border-0 listcard">
                        <div>
                            <div class="m-card-cover position-relative">
                                <img src="{{env('BACKEND_BASE_URL')}}/{{$tour['event_img']}}" class="card-img-top" alt="{{$tour['event_title']}}">
                                @isset($tour['cid'])
                                    <a href="{{route('tournament',['category'=>$tour['category'],'id'=>$tour['cid']])}}" class="my-2"><small class="category">{{$tour['category']}}</small></a>
                                @endisset
                            </div>
                            <div class="card-body position-relative">
                                <h5 class="card-title mb-2"><u>{{$tour['event_title']}}</u></h5>
                                <small>{{$tour['event_sdate']}}</small>
                                <p class="my-2"><small class="location"><i class="fas fa-map-marker-alt pr-1"></i>{{$tour['event_place_name']}}</small></p>
                                <p class="card-text mb-0">
                                    <small class="text-dark" title="{{$tour['event_place_address']}}"><i class="fas fa-map-marker-alt pr-1"></i>
                                    {{ strlen($tour['event_place_address']) > 50 ? substr($tour['event_place_address'], 0, 50) . '...' : $tour['event_place_address'] }}
                                    </small>
                                </p>
                                @isset($tour['ticket_types'])
                                    @foreach ($tour['ticket_types'] as $key =>  $item)
                                        <span class="badge badge-primary m-1 type_cat" data-toggle="tooltip" data-placement="top" title="{{ $key }}">{{ $item }}</span>
                                    @endforeach
                                @endisset
                                <div class="mt-2 d-flex justify-content-between align-items-center"> 
                                    <a href="{{route('tournament-detail', [$tour['event_id'], Str::slug($tour['event_title'])])}}" class="mt-1 btn btn-success btn-sm mb-1 ">Book Now</a>
                                    <button class="mt-1 btn btn-white btn-sm mb-1">{{$tour['event_ticket_price']}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    
    @if (isset($tournament) && count($tournament['upcoming_event']))
        <div class="hawan_section">
            <div class="d-sm-flex align-items-center justify-content-between mt-5 mb-3 overflow-hidden">
                <h1 class="h4 mb-0 float-left">Upcoming Tournament</h1>
                <a href="{{url('tournament-type',['type'=>'upcoming'])}}" class="d-sm-inline-block text-xs float-right "> See All </a>
            </div>
            <div class="event-block-slider">
                @foreach ($tournament['upcoming_event'] as $tour)
                    <div class="card m-card shadow-sm border-0 listcard ">
                        <div>
                            <div class="m-card-cover position-relative">
                                <img src="{{env('BACKEND_BASE_URL')}}/{{$tour['event_img']}}" class="card-img-top" alt="{{$tour['event_title']}}">
                                @isset($tour['cid'])
                                    <a href="{{route('tournament',['category'=>$tour['category'],'id'=>$tour['cid']])}}" class="my-2"><small class="category">{{$tour['category']}}</small></a>
                                @endisset
                            </div>
                            <div class="card-body position-relative">
                                <h5 class="card-title mb-2"><u>{{$tour['event_title']}}</u></h5>
                                <small>{{$tour['event_sdate']}}</small>
                                <p class="my-2"><small class="location"><i class="fas fa-map-marker-alt pr-1"></i>{{$tour['event_place_name']}}</small></p>
                                <p class="card-text mb-0">
                                    <small class="text-dark" title="{{$tour['event_place_address']}}"><i class="fas fa-map-marker-alt pr-1"></i>
                                    {{ strlen($tour['event_place_address']) > 50 ? substr($tour['event_place_address'], 0, 50) . '...' : $tour['event_place_address'] }}
                                    </small>
                                </p>
                                @isset($tour['ticket_types'])
                                    @foreach ($tour['ticket_types'] as $key => $item)
                                        <span class="badge badge-primary m-1 type_cat" data-toggle="tooltip" data-placement="top" title="{{ $key }}">{{ $item }}</span>
                                    @endforeach
                                @endisset
                                <div class="mt-2 d-flex justify-content-between align-items-center"> 
                                    <a href="{{route('tournament-detail', [$tour['event_id'], Str::slug($tour['event_title'])])}}" class="mt-1 btn btn-success btn-sm mb-1 ">Book Now</a>
                                    <button class="mt-1 btn btn-white btn-sm mb-1">{{$tour['event_ticket_price']}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    

    <div class="d-sm-flex align-items-center justify-content-between mt-5 mb-3 overflow-hidden">
        <h1 class="h4 mb-0 float-left">Categories</h1>
    </div>
    <div class="all-category mb-5">
        @foreach (Common::allEventCategoriesByApi() as $cat)
        <div class="category-card">
            <a href="{{ route('tournament', [Str::slug($cat['title']), $cat['id']]) }}">
                <img src="{{env('BACKEND_BASE_URL')}}/{{$cat['cover_img']}}" class="category-img" alt="...">
                <div class="cat-content">
                    <p class="cat-title text-truncate">{{$cat['title']}}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    

    <!-- @if(count($products))
        <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-3 overflow-hidden">
            <h1 class="h4 mb-0 float-left">Sports Products</h1>
            <a href="{{url('all-products')}}" class="d-sm-inline-block text-xs float-right"><i class="fas fa-eye fa-sm"></i>
                View All </a>
        </div>
        <div class="product-slider mb-5">
            @foreach ($products as $item)
                <div class="px-2">
                    <div class="single-products-card">
                        <div class="products-image">
                            <a href="{{url('product/'.$item->product_slug)}}"><img
                                    src="{{asset('images/upload/'.$item->image)}}" class="img-fluid" alt="image"></a>
                        </div>
                        <div class="products-content">
                            <p>
                                <a
                                    href="{{url('product/'.$item->product_slug)}}">{{ucwords(strtolower($item->product_name))}}</a>
                            </p>
                            <div class="d-flex justify-content-between mb-1">
                                <span>₹{{$item->product_price}}</span>
                                <div class="rating-star">
                                    @for($i=1;$i<=5;$i++) @if($i<=$item->rating)
                                        <i class="fas fa-star active"></i>
                                        @else
                                        <i class="fas fa-star"></i>
                                        @endif
                                        @endfor
                                </div>
                            </div>
                            <div class="add-to-cart-btn">
                                @if($item->quantity > 0)
                                <a href="javascript:void(0)" data-url="{{url('buy-product/'.$item->product_slug)}}"
                                    class="btn btn-danger btn-block add_to_cart">Add To Cart</a>
                                @else
                                <a href="javscript:void(0)" class="btn btn-danger btn-block disabled">Out Of Stock</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif -->

    <!-- @if(count($blog))
        <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-3 overflow-hidden">
            <h1 class="h4 mb-0 float-left">Blogs</h1>
            <a href="{{url('all-blogs')}}" class="d-sm-inline-block text-xs float-right">View All <i
                    class="fas fa-eye fa-sm"></i></a>
        </div>
        <div class="row pb-4 mb-2">
            @foreach ($blog as $bgl)
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="blog-card shadow-sm">
                        <div class="row align-items-center no-gutters">
                            <div class="col-lg-4">
                                <div class="blog-image">
                                    <a href="{{ url('/blog-detail/' . $bgl->id . '/' . Str::slug($bgl->title)) }}"><img
                                            src="{{asset('images/upload/'.$bgl->image)}}" alt="image" class="img-fluid"></a>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="blog-content">
                                    <div class="date"><span><i class="far fa-calendar-alt"></i>
                                            {{ Carbon\Carbon::parse($bgl->created_at)->format('d M Y') }}</span>
                                    </div>
                                    <h3>
                                        <a
                                            href="{{ url('/blog-detail/' . $bgl->id . '/' . Str::slug($bgl->title)) }}">{{ $bgl->title }}</a>
                                    </h3>
                                    <p>{!! Str::substr(strip_tags($bgl->description), 0, 150).'...' !!}</p>
                                    <div class="text-right">
                                        <a href="{{ url('/blog-detail/' . $bgl->id . '/' . Str::slug($bgl->title)) }}"
                                            class="blog-btn btn btn-sm btn-outline-danger">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif -->
</div>
{{-- model start --}}

@if ($popup != null)
<div class="modal fade" id="Location" tabindex="-1" aria-labelledby="LocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body p-1" id="model_body">
            <button type="button" class="btn-close" id="cancel_edit"><i class="fas fa-times"></i></button>
            <a href="{{$popup->img_url}}" class="text-decoration-none">
                <img class="img-fluid" src="/upload/popup/{{$popup->image}}" alt="">
            </a>
        </div>
      </div>
    </div>
  </div>
@endif


{{-- Model End --}}
@include('alert-messages')
@endsection
@push('scripts')
<script type="text/javascript">
    $(window).on('load', function() {
        $('#Location').modal('show');
    });

    $("#cancel_edit").click(function(){
        $('#Location').modal('hide');
    });
</script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endpush