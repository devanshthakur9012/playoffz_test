@extends('frontend.master', ['activePage' => 'home'])
@section('title', __('Discover Sports Tournaments in Bangalore'))
@section('og_data')
    <meta name="title" content="Discover Sports Tournaments in Bangalore | PlayOffz" />
    <meta name="description" content="Find cricket, tennis, and badminton tournaments in Bangalore, Chennai, and Hyderabad. Book top courts and play sports with ease on PlayOffz!" />
    <meta name="keywords" content="playoffz tournament bangalore, cricket tournament in chennai, tennis tournament chennai, tennis tournaments in bangalore, badminton court in chennai, badminton courts bangalore, badminton courts hyderabad, play tournament in bangalore, play tournament in chennai, play tennis in bangalore" />
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
#cancel_edit{
    position: absolute;
    right: -10px;
    top: -10px;
    border-radius: 50%;
    background: #1a1b2e;
    border: none;
    width: 25px;
    height: 25px;
    color: #ffff;
}
/* Zoom-in animation */
@keyframes zoomIn {
    0% {
        opacity: 0;
        transform: scale(0.8);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

/* Apply animation to the modal */
.modal-dialog.animate-zoom-in {
    animation: zoomIn 0.5s ease-out;
}
.modal-backdrop {
    backdrop-filter: blur(5px);
}
.profile-img {
    width: 40px !important;
    height: 40px !important;
    border-radius: 50% !important;
    object-fit: cover;
    border: none !important;
    margin-right: 15px;
}
.catIcon{
    width: 20px !important;
    height: 20px !important;
}
.default2-btn{
    background-color: #ff2f31 !important;
    border-color: #ff2f31 !important;
    padding: 7px 10px;
    color:#fff !important;
}
.badge-default{
    color: #fff;
    background-color: #004aad;
    padding: 3px 8px;
}
.badge-default:hover{
    color: #fff;
    background-color: #06408d;
}
.badge-success{
    padding: 3px 8px !important;
}
</style>
<div class="pt-3 pb-3 shadow-sm home-slider">
    <div class="osahan-slider">
        @if (isset($tournament) && count($tournament['banner_img']))
            @foreach ($tournament['banner_img'] as $item)
                <div class="osahan-slider-item">
                    {{-- <a @if($item->redirect_link != null) href="{{$item->redirect_link}}" @endisset > --}}
                        <img src="{{env('BACKEND_BASE_URL')}}/{{$item}}" class="img-fluid rounded" alt="">
                    {{-- </a> --}}
                </div>
            @endforeach
        @endif
    </div>
</div>
<div class="container mt-5">
    @if (isset($tournament) && count($tournament['social_play']))
        <div class="hawan_section">
            <div class="d-sm-flex align-items-center justify-content-between mt-5 mb-3 overflow-hidden">
                <h2 class="h4 mb-0 float-left">Social Play</h2>
                <a href="{{route('social-play')}}" class="d-sm-inline-block text-xs float-right "> See All </a>
            </div>
            <div class="event-block-slider">
                @foreach ($tournament['social_play'] as $play)
                    <div class="card m-card shadow-sm border-0 listcard">
                        <div>
                            <div class="card-body position-relative">
                                <div class="d-flex gap-1 align-items-center mb-3">
                                    <img src="{{env('BACKEND_BASE_URL')."/".$play['user_img']}}" class="img-thumbnail profile-img" alt="">
                                    <div>
                                        <h4 class="card-title mb-0 text-capitalize" title="{{$play['play_title']}}"><u>{{ Str::lower(strlen($play['play_title']) > 25 ? substr($play['play_title'], 0, 25) . '...' : $play['play_title']) }}</u></h4>
                                        <small>{{$play['user_name']}} | {{$play['play_slots']}} slots</small> 
                                    </div>
                                </div>
                                {{-- <small>Devansh | 25 Karma</small>  --}}
                                <div class="my-2">
                                    @isset($play['category_name'])
                                        <a href="{{route('tournament',['category'=>Str::slug($play['category_name'])])}}" class="d-inline-flex justify-content-center align-items-center badge badge-default fw-normal"><img src="{{env('BACKEND_BASE_URL')."/".$play['category_img']}}" class="mr-1 catIcon" alt="{{$play['category_name']}}"><small>{{$play['category_name']}}</small></a>
                                    @endisset
                                    @if(isset($play['pay_join']) && $play['pay_join'] == 1)
                                        <a href="javascript:void(0)" class="d-inline-flex justify-content-center align-items-center badge badge-success fw-normal"><img src="{{asset('frontend/images/pay-join-icon.png')}}" class="mr-1 catIcon" alt="Price Tag"><small>INR {{$play['play_price']}}</small></a>
                                    @endif
                                </div>
                                <p class="card-text mb-0">
                                    <small class="text-dark text-capitalize" title="{{$play['play_place_location']}}"><i class="fas fa-map-marker-alt pr-1"></i>
                                    {{ Str::lower(strlen($play['play_place_location']) > 40 ? substr($play['play_place_location'], 0, 40) . '...' : $play['play_place_location']) }}
                                    </small>
                                </p>
                                <div class="mt-2">
                                    <button class="mt-1 btn btn-outline-white btn-sm mb-1"><i class="far fa-calendar-alt pr-2"></i> <small>{{$play['play_sdate']}}</small> </button>
                                    <a href="{{route('play', $play['play_uuid'])}}" class="mt-1 btn default2-btn btn-sm mb-1 w-100">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if (isset($tournament) && count($tournament['latest_event']))
        <div class="hawan_section">
            <div class="d-sm-flex align-items-center justify-content-between mt-5 mb-3 overflow-hidden">
                <h2 class="h4 mb-0 float-left">Latest Tournament</h2>
                <a href="{{route('tournament-type',['type'=>'latest'])}}" class="d-sm-inline-block text-xs float-right "> See All </a>
            </div>
            <div class="event-block-slider">
                @foreach ($tournament['latest_event'] as $tour)
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
                                    <small class="text-dark" title="{{$tour['event_place_address']}}"><i class="fas fa-map pr-1"></i>
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
                                <div class="mt-2">
                                    <button class="mt-1 btn btn-outline-white btn-sm mb-1">Ticket Price : {{$tour['event_ticket_price']}}</button>
                                    <a href="{{route('tournament-detail', [Str::slug($tour['event_title']),$tour['event_id']])}}" class="mt-1 btn btn-success btn-sm mb-1 w-100">Book Ticket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if (isset($tournament['location_images']) && isset($tournament['location_images']['adv_image_1']))
        <div class="row my-5">
            <div class="col-lg-12">
                <a class="small_banner" target="_blank">
                    <img src="{{env('BACKEND_BASE_URL')}}/{{$tournament['location_images']['adv_image_1']}}" alt="">
                </a>
            </div>
        </div>
    @endif
    @if (isset($tournament) && count($tournament['nearby_event']))
        <div class="hawan_section">
            <div class="d-sm-flex align-items-center justify-content-between mt-5 mb-3 overflow-hidden">
                <h2 class="h4 mb-0 float-left">Nearby Tournament</h2>
                <a href="{{route('tournament-type',['type'=>'nearby'])}}" class="d-sm-inline-block text-xs float-right "> See All </a>
            </div>
            <div class="event-block-slider">
                @foreach ($tournament['nearby_event'] as $tour)
                    <div class="card m-card shadow-sm border-0 listcard">
                        <div>
                            <div class="m-card-cover position-relative">
                                <img src="{{env('BACKEND_BASE_URL')}}/{{$tour['event_img']}}" class="card-img-top" alt="{{$tour['event_title']}}">
                                @isset($tour['cid'])
                                    <a href="{{route('tournament',['category'=>Str::slug($tour['category'])])}}" class="my-2"><small class="category">{{$tour['category']}}</small></a>
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
                                    @foreach ($tour['ticket_types'] as $key =>  $item)
                                        <span class="badge badge-primary m-1 type_cat" data-toggle="tooltip" data-placement="top" title="{{ $key }}">{{ $item }}</span>
                                    @endforeach
                                @endisset
                                <div class="mt-2"> 
                                    <button class="mt-1 btn btn-outline-white btn-sm mb-1">Ticket Price : {{$tour['event_ticket_price']}}</button>
                                    <a href="{{route('tournament-detail', [Str::slug($tour['event_title']),$tour['event_id']])}}" class="mt-1 btn btn-success btn-sm mb-1 w-100 ">Book Ticket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if (isset($tournament['location_images']) && isset($tournament['location_images']['adv_image_2']))
        <div class="row my-5">
            <div class="col-lg-12">
                <a class="small_banner" target="_blank">
                    <img src="{{env('BACKEND_BASE_URL')}}/{{$tournament['location_images']['adv_image_2']}}" alt="">
                </a>
            </div>
        </div>
    @endif
    @if (isset($tournament) && count($tournament['this_month_event']))
        <div class="hawan_section">
            <div class="d-sm-flex align-items-center justify-content-between mt-5 mb-3 overflow-hidden">
                <h2 class="h4 mb-0 float-left">Monthly Tournament</h2>
                <a href="{{route('tournament-type',['type'=>'monthly'])}}" class="d-sm-inline-block text-xs float-right "> See All </a>
            </div>
            <div class="event-block-slider">
                @foreach ($tournament['this_month_event'] as $tour)
                    <div class="card m-card shadow-sm border-0 listcard">
                        <div>
                            <div class="m-card-cover position-relative">
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
                                    <small class="text-dark" title="{{$tour['event_place_address']}}"><i class="fas fa-map-marker-alt pr-1"></i>
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
                                    @foreach ($tour['ticket_types'] as $key =>  $item)
                                        <span class="badge badge-primary m-1 type_cat" data-toggle="tooltip" data-placement="top" title="{{ $key }}">{{ $item }}</span>
                                    @endforeach
                                @endisset
                                <div class="mt-2"> 
                                    <button class="mt-1 btn btn-outline-white btn-sm mb-1">Ticket Price : {{$tour['event_ticket_price']}}</button>
                                    <a href="{{route('tournament-detail', [Str::slug($tour['event_title']),$tour['event_id']])}}" class="mt-1 btn btn-success btn-sm mb-1 w-100 ">Book Ticket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if (isset($tournament['location_images']) && isset($tournament['location_images']['adv_image_3']))
        <div class="row my-5">
            <div class="col-lg-12">
                <a class="small_banner" target="_blank">
                    <img src="{{env('BACKEND_BASE_URL')}}/{{$tournament['location_images']['adv_image_3']}}" alt="">
                </a>
            </div>
        </div>
    @endif
    @if (isset($tournament) && count($tournament['upcoming_event']))
        <div class="hawan_section">
            <div class="d-sm-flex align-items-center justify-content-between mt-5 mb-3 overflow-hidden">
                <h2 class="h4 mb-0 float-left">Upcoming Tournament</h2>
                <a href="{{route('tournament-type',['type'=>'upcoming'])}}" class="d-sm-inline-block text-xs float-right "> See All </a>
            </div>
            <div class="event-block-slider">
                @foreach ($tournament['upcoming_event'] as $tour)
                    <div class="card m-card shadow-sm border-0 listcard ">
                        <div>
                            <div class="m-card-cover position-relative">
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
                                    <small class="text-dark" title="{{$tour['event_place_address']}}"><i class="fas fa-map-marker-alt pr-1"></i>
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
                                <div class="mt-2"> 
                                    <button class="mt-1 btn btn-outline-white btn-sm mb-1">Ticket Price : {{$tour['event_ticket_price']}}</button>
                                    <a href="{{route('tournament-detail', [Str::slug($tour['event_title']),$tour['event_id']])}}" class="mt-1 btn btn-success btn-sm mb-1 w-100 ">Book Ticket</a>
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
            <a href="{{ route('tournament', [Str::slug($tour['category'])]) }}">
                <img src="{{env('BACKEND_BASE_URL')}}/{{$cat['cover_img']}}" class="category-img" alt="...">
                <div class="cat-content">
                    <p class="cat-title text-truncate">{{$cat['title']}}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@if (isset($tournament['location_images']) && isset($tournament['location_images']['popup_image']))
    <div class="modal fade" id="Location" tabindex="-1" role="dialog" aria-labelledby="LocationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered animate-zoom-in" role="document">
            <div class="modal-content">
                <div class="modal-body p-1" id="model_body">
                    <button type="button" class="btn-close" id="cancel_edit"><i class="fas fa-times"></i></button>
                    <img class="img-fluid" src="{{env('BACKEND_BASE_URL')}}/{{$tournament['location_images']['popup_image']}}" alt="">
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
        // Delay the modal show by 3 seconds (3000 milliseconds)
        setTimeout(function() {
            $('#Location').modal('show');
        }, 3000);
    });

    // Hide the modal when the cancel button is clicked
    $("#cancel_edit").click(function() {
        $('#Location').modal('hide');
    });
</script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endpush