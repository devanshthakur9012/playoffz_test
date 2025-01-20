@extends('frontend.master', ['activePage' => 'home'])

@php $locationName = ""; @endphp
@isset($location['city'])
    @php $locationName = $location['city'] @endphp
@endisset
@section('title', __('Tournaments In ' .$locationName))
@section('og_data')
    <meta name="description" content="@isset($location['description']){{$location['description']}}@endisset" />
    <meta name="keywords" content="Tournaments In @isset($location['city']){{$location['city']}}@endisset" />
@endsection
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
        <div class="mt-5 mb-3">
            <h1 class="h4 mb-2">{{ ucwords(str_replace('-', ' ', $category)) }} Tournament</h1>
            @isset($location['description'])<p>{{$location['description']}}</p>@endisset
        </div>
        <div class="row list-bp">
            @foreach ($category_tournament as $tour)
                <div class="col-xl-4 col-md-4 col-sm-6 mb-3">
                    <div class="card m-card shadow-sm border-0 listcard">
                        <div>
                            <div class="m-card-cover  position-relative">
                                <img src="{{env('BACKEND_BASE_URL')}}/{{$tour['event_img']}}" class="card-img-top" alt="{{$tour['event_title']}}">
                                @isset($tour['cid'])
                                    <a href="{{route('tournament',['category'=>Str::slug($tour['category'])])}}" class="my-2"><small class="category">{{$tour['category']}}</small></a>
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
                                @php
                                    // Ensure ticket_types exists and is an array
                                    if (isset($tour['ticket_types']) && is_array($tour['ticket_types'])) {
                                        // Sort the array by extracting numeric and alphabetic parts
                                        uksort($tour['ticket_types'], function ($a, $b) {
                                            // Extract the numeric part of the keys
                                            $numA = (int) preg_replace('/\D/', '', $a); // Get numbers only
                                            $numB = (int) preg_replace('/\D/', '', $b); // Get numbers only
                                
                                            // Compare numeric parts first
                                            if ($numA !== $numB) {
                                                return $numA <=> $numB;
                                            }
                                
                                            // If numeric parts are the same, compare alphabetically (B vs G)
                                            return strcmp($a, $b);
                                        });
                                    }
                                @endphp
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
