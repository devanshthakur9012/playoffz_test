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
        padding: 4px 10px !important;
        background: #ffd700;
        color: #000;
        font-size: 14px !important;
        font-weight: 500;
    }
    .location{
        background: #004aad;
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
        padding: 4px 10px !important;
        font-size: 14px !important;
        position: absolute;
        top: 10px;
        left: 7px;
    }
</style>
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
                                    <small class="text-dark" title="{{$tour['event_place_address']}}"><i class="fas fa-map pr-2"></i>
                                    {{ strlen($tour['event_place_address']) > 50 ? substr($tour['event_place_address'], 0, 50) . '...' : $tour['event_place_address'] }}
                                    </small>
                                </p>
                                @isset($tour['ticket_types'])
                                    @foreach ($tour['ticket_types'] as $key => $item)
                                        <span class="badge badge-primary m-1 type_cat" data-toggle="tooltip" data-placement="top" title="{{ $key }}">{{ $item }}</span>
                                    @endforeach
                                @endisset
                                {{-- <div class="mt-2 d-flex justify-content-between align-items-center">
                                    <a href="{{route('tournament-detail', [$tour['event_id'], Str::slug($tour['event_title'])])}}" class="mt-1 btn btn-success btn-sm mb-1">Book Now</a>
                                    
                                    <button class="mt-1 btn btn-white btn-sm mb-1">{{$tour['event_ticket_price']}}</button>
                                </div> --}}
                                <div class="mt-2">
                                    <button class="mt-1 btn btn-outline-white btn-sm mb-1">Ticket Price : {{$tour['event_ticket_price']}}</button>
                                    <a href="{{route('tournament-detail', [Str::slug($tour['event_title']),$tour['event_id']])}}" class="mt-1 btn btn-success btn-sm mb-1 w-100">Book Ticket</a>
                                </div>
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
@push('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endpush
@endsection
