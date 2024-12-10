@extends('frontend.master', ['activePage' => 'home'])
@section('title', __('Home'))
@section('content')
{{-- <div class="pt-3 pb-3 shadow-sm home-slider">
    <div class="osahan-slider">
      
    </div>
</div> --}}
<div class="container my-5">
    <div class="hawan_section">
        <div class="d-sm-flex align-items-center justify-content-between mt-5 mb-3 overflow-hidden">
            <h1 class="h4 mb-0 float-left">{{ ucwords(str_replace('-', ' ', $category)) }} Tournament</h1>
        </div>
        <div class="row list-bp">
            @foreach ($category_tournament as $tour)
                <div class="col-xl-4 col-md-4 col-sm-6 mb-3">
                    <div class="card m-card shadow-sm border-0 listcard">
                        <div>
                            <div class="m-card-cover">
                                <img src="{{env('BACKEND_BASE_URL')}}/{{$tour['event_img']}}" class="card-img-top" alt="{{$tour['event_title']}}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title mb-2"><u>{{$tour['event_title']}}</u></h5>
                                <small>{{$tour['event_sdate']}}</small>
                                <p class="card-text mb-0">
                                    <small class="text-dark" title="{{$tour['event_place_name']}}"><i class="fas fa-map-marker-alt pr-2"></i>
                                    {{ strlen($tour['event_place_name']) > 50 ? substr($tour['event_place_name'], 0, 50) . '...' : $tour['event_place_name'] }}
                                    </small>
                                </p>
                                <a href="{{route('tournament-detail', [$tour['event_id'], Str::slug($tour['event_title'])])}}" class="mt-1 btn btn-success btn-sm mb-1">Book Now</a>

                                {{-- <p class="my-1 text-light"><small> {{ $coaching->venue_area.', '.$coaching->venue_address.', '.$coaching->venue_city }}</small></p>
    
                                <div class="mt-2 d-flex justify-content-between align-items-center">
                                {!!Common::showDiscountLabel($coaching->coachingPackage->package_price, $coaching->coachingPackage->discount_percent )!!}  
                                
                                    <a href="{{url('coaching-book/'.$coaching->id.'/'.Str::slug($coaching->coaching_title))}}" class="mt-1 btn btn-success btn-sm mb-1 ">Book Now</a>
                                </div> --}}
                            
                            </div>
                        </div>
                    </div>
                </div>
                
            @endforeach
        </div>
    </div>
    
</div>

@endsection
