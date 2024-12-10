@extends('frontend.master', ['activePage' => 'home'])

@section('title', __('Coach Book'))
@push('styles')
<style>
    /* Overall Dark Theme */
    .text-muted {
        color: #888 !important;
    }

    .dark-gap {
        margin-right: 1.5rem;
    }

    /* Custom positioning for overlay content in dark theme */
    .dark-absolute {
        position: absolute;
        top: 15px;
        left: 20px;
        right: 16px;
    }

    @media (min-width: 768px) {
        .dark-absolute {
            top: 60px;
            left: 130px;
            right: 8px;
        }
    }

    @media (min-width: 992px) {
        .dark-absolute {
            top: 80px;
            left: 140px;
            right: 16px;
        }
    }

    /* Intensity Bar */
    .dark-intensity-bar {
        display: flex;
        width: 100%;
        max-width: 24rem;
        height: 0.5rem;
        background-color: #333;
        border-radius: 9999px;
        gap: 4px;
    }

    .dark-bar-section {
        flex: 1;
        height: 100%;
    }

    .rounded-left {
        border-top-left-radius: 9999px;
        border-bottom-left-radius: 9999px;
    }

    .rounded-right {
        border-top-right-radius: 9999px;
        border-bottom-right-radius: 9999px;
    }

    /* Custom Progress Bar */
    .dark-progress {
        display: flex;
        width: 100%;
        max-width: 100%;
        height: 8px;
        background-color: #444;
        border-radius: 9999px;
    }

    .dark-progress-bar {
        height: 100%;
    }

    .dark-progress-bar:first-child {
        width: 15%;
    }

    .dark-progress-bar:nth-child(2) {
        width: 20%;
    }

    .dark-progress-bar:nth-child(3) {
        width: 50%;
    }

    .dark-progress-bar:last-child {
        width: 15%;
    }

    /* Utility Classes */


    .dark-coach-image {
        width: 100px;
        height: 120px;
    }

    .dark-icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .border-dark-theme {
        border-color: #444 !important;
    }

    .bg-dark-theme {
        background-color: #1a1b2e;
        border-radius: 10px;
    }

    /* Responsive Design Enhancements */


    .single-detail-area h2,
    .single-detail-area h3,
    .single-detail-area h4 {
        font-weight: bold;
        color: #e0e0e0;
    }

    .single-detail-area p {
        font-size: 1rem;
        line-height: 1.6;
        color: #ffffff;
    }

    @media (min-width: 768px) {
        .single-detail-area p {
            font-size: 1.125rem;
        }

        .dark-gap {
            margin-right: 2rem;
        }
    }

    /* Card layout for available sports */
    .available-sports {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-top: 20px;
    }

    .available-sport-card {
        padding: 10px 15px;
        border: 1px solid #444;
        border-radius: 8px;
        width: auto;
        text-align: center;
        color: #fff;
        white-space: nowrap;
        min-width: 110px;
    }

    .available-sport-card span {
        font-size: 1.5rem;
        
    }

    /* Buttons */
    .btn-dark-theme {
        background-color: #444;
        color: #fff;
        border: 1px solid #555;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: bold;
    }

    .btn-dark-theme:hover {
        background-color: #555;
        border-color: #666;
    }

    /* Dark Progress Section */
    .progress-section {
        margin-top: 20px;
    }

    .dark-progress-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }

    .progress-label {
        color: #b0b0b0;
    }

    .dark-progress-bar-wrapper {
        flex-grow: 1;
    }

    /* Icon Box for Sessions */
    .dark-icon-box {
        background-color: #444;
        width: 32px;
        height: 12px;
        border-radius: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #e0e0e0;
    }

    .dark-session-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #36384a;
    }

    /* Coaches Hover Effects */
    .coach-card {
        padding: 15px;
        height: 100%;
    }


    .coach-image {
        width: 100px;
        height: 100px;
        transition: transform 0.3s ease;
    }

    .coach-details {
        margin-top: 10px;
    }

    @media (max-width: 576px) {


        .coach-image {
            width: 80px;
            height: 80px;
        }
    }

    .amenity_round{
        border-radius: 100%;
        height: 80px;
        width: 80px;
    }

    .amenity_round img{
        margin-top: 5px;
    }
</style>
    
        
    
    <style>
        .btn-success, .default-btn {  
            animation: glowing 800ms infinite;
        }

        @keyframes  glowing {
        0% {  box-shadow: 0 0 3px #fff; }
        50% {  box-shadow: 0 0 8px #fff; }
        100% {  box-shadow: 0 0 3px #fff; }
        }

    </style>
    <style>
        .icon_box{
            background: #f8f9fa;
            color: #db207b;
            padding: 30px;
            border-radius: 32px;
            margin-right: 20px;
            height: 30px;
            width: 30px;
            justify-content: center;
            align-items: center;
            display: flex;
        }
        .profile-img {
            width: 50px;       /* Set the width of the image (adjust as necessary) */
            height: 50px;      /* Set the height of the image (adjust as necessary) */
            border-radius: 50%; /* Makes the image circular */
            object-fit: cover;  /* Ensures the image fills the circle without distorting */
            border: 1px solid #ddd; /* Optional: adds a border around the image */
            margin-right: 15px;
        }
        .tags{
            background:#db207b;
            color: #fff;
            border-radius: 20px;
            padding: 10px 15px;
        }
    </style>
@endpush
@section('content')
<section class="section-area single-detail-area py-3">
    <div class="container">
        <div class="pt-3 pb-3 shadow-sm home-slider">
            <div class="osahan-slider">
                @if (isset($tournament_detail) && count($tournament_detail['event_cover_img']))
                    @foreach ($tournament_detail['event_cover_img'] as $item)
                        <div class="osahan-slider-item">
                            {{-- <a @if($item->redirect_link != null) href="{{$item->redirect_link}}" @endisset > --}}
                                <img src="{{env('BACKEND_BASE_URL')}}/{{$item}}" class="img-fluid rounded" alt="...">
                            {{-- </a> --}}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-8 col-md-8 col-12">
                <h2 >{{ $tournament_detail['event_title'] }}</h2>
                <div class=" dark-gap text-white h5" style="margin-bottom: 0;">
                    <p class="dark-gap">Sport Catgeory : {{$tournament_detail['category']}}</p>
                    {{-- Timing --}}
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon_box">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <div class="text_box">
                            <p class="mb-0">{{ $tournament_detail['event_sdate'] }}</p>
                            <small class="text_muted">{{ $tournament_detail['event_time_day'] }}</small>
                        </div>
                    </div>
                    {{-- Address --}}
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon_box">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="text_box">
                            <!-- Using the provided latitude and longitude to open Google Maps -->
                            <p class="text_muted"></p><a class="text-white" href="https://www.google.com/maps?q={{ $tournament_detail['event_latitude'] }},{{ $tournament_detail['event_longtitude'] }}" target="_blank">
                                {{ $tournament_detail['event_address'] }}
                            </a></p>
                        </div>
                    </div>
                    {{-- Tickets --}}
                    <div class="d-flex align-items-center mb-2">
                        <div class="icon_box">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="text_box">
                            <p class="mb-0">Ticket Price : {{ $tournament_detail['ticket_price'] }}</p>
                            <small class="text_muted">{{ $tournament_detail['total_ticket'] }} Spots Left</small>
                        </div>
                    </div>
                    {{-- <p class="mr-3">👨‍👩‍👧‍👦 Age group: {{ $coachData->age_group }}</p>
                    <p class="mr-3">🏸 BYOE: {{ $coachData->bring_own_equipment }}</p>
                    <p>🎟️ Free Demo session: {{ $coachData->free_demo_session }}</p> --}}
                </div>
        
                <div class="my-5 text-white h5">
                    <h4 class="mr-4 mb-3">Organized By</h4>
                    <div class="d-flex align-items-center">
                        <img class="img-thumbnail profile-img" src="{{ env('BACKEND_BASE_URL').'/'.$tournament_detail['sponsore_img'] }}" alt="{{$tournament_detail['sponsore_name']}}">
                        <p class="mb-0 fs-2">{{ $tournament_detail['sponsore_name'] }}</p>
                    </div>
                </div>

                <div class="mb-3 text-white h5"> 
                    <h4 class="mb-1">About Tournament</h4>
                    <p class="fs-3">{!! $tournament_detail['event_about'] !!}</p>
                </div>

                <div class="mb-3 text-white h5"> 
                    <h4 class="mb-1">Rules & Regulations</h4>
                    <p class="fs-3">{!! $tournament_detail['event_disclaimer'] !!}</p>
                </div>

                @if(count($tournament_Facility))
                    <h4 class="">Tournament Facility</h4>
                    <div class="available-sports mb-3">
                        @foreach ($tournament_Facility as $sport)
                            <div class="available-sport-card">
                                <img class="rounded-circle p-1" src="{{ env('BACKEND_BASE_URL').'/'.$sport['facility_img'] }}" alt="$sport['facility_title']" width="36" height="36">
                                <p class="mb-0 mt-1" style="font-size:14px; ">{{ $sport['facility_title'] }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
                
                @if(count($tournament_Restriction))
                    <h4 class="">Tournament Prohibited</h4>
                    <div class="available-sports">
                        @foreach ($tournament_Restriction as $sport)
                            <div class="available-sport-card">
                                <img class="rounded-circle p-1" src="{{ env('BACKEND_BASE_URL').'/'.$sport['restriction_img'] }}" alt="$sport['restriction_title']" width="36" height="36">
                                <p class="mb-0 mt-1" style="font-size:14px; ">{{ $sport['restriction_title'] }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
                
                <!-- Intensity and Calories Section -->
                {{-- <div class="mt-4 mb-3">
                    <h5>{{ $coachData->category->category_name }}</h5>
                    <div class="d-flex flex-row align-items-start w-100">
                        <div class="mr-4">
                            <span class="text-muted">CALORIES</span>
                            <div style="min-width: 115px;">
                                <span>🔥</span>
                                <span class="ml-2 font-weight-bold">{{ $sessionDurationData['calories'] }}</span>
                            </div>
                        </div>
                        <div class="w-100">
                            <span class="text-muted">INTENSITY: {{$sessionDurationData['intensity']}}</span>
                            <div class="dark-intensity-bar mt-2">
                                <div class="dark-bar-section rounded-left" style="background:{!! Common::intensityColors($sessionDurationData['intensity']) !!};"></div>
                            </div>
                        </div>
                    </div>
                </div> --}}
        
                {{-- <div class="mb-3">
                    <h5 class="">Benefits</h5>
                    <p class="text-muted">{{ implode("| ",$sessionDurationData['benefits']) }}</p>
                </div> --}}
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="event-ticket card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="single-ticket">
                            @if($tournament_detail['total_ticket'] <= 0)
                                <a href="javascript:void(0)" class="btn default-btn w-100">Sold Out</a>
                            @else
                                <a href="{{ $packageLink }}" class="btn default-btn w-100">Continue To Book {{ $tournament_detail['category'] }}</a>
                            @endif
                        </div>
                    </div>
                </div>
        
                {{-- <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="products-reviews">
                            <h3>Reviews</h3>
                            <div class="rating">
                                <h4 class="h3">4.5</h4>
                                <div>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star"></span>
                                </div>
                                <div>
                                    <p class="mb-0">501 review</p>
                                </div>
                            </div>
                            <div class="rating-count">
                                <span>Total review count and overall rating based on Visitor and Tripadvisior reviews</span>
                            </div>
                            <div class="rating-row">
                                <div class="side">
                                    <div>5 <span class="fas fa-star"></span></div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div class="bar-5"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div>02</div>
                                </div>
                            </div>
                            <div class="rating-row">
                                <div class="side">
                                    <div>4 <span class="fas fa-star"></span></div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div class="bar-4"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div>03</div>
                                </div>
                            </div>
                            <div class="rating-row">
                                <div class="side">
                                    <div>3 <span class="fas fa-star"></span></div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div class="bar-3"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div>04</div>
                                </div>
                            </div>
                            <div class="rating-row">
                                <div class="side">
                                    <div>2 <span class="fas fa-star"></span></div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div class="bar-2"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div>05</div>
                                </div>
                            </div>
                            <div class="rating-row">
                                <div class="side">
                                    <div>1 <span class="fas fa-star"></span></div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div class="bar-1"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div>00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="progress-section mb-4 mt-4">
            <iframe
            width="100%" 
            height="450" 
            frameborder="0" 
            style="border:0;" 
            allowfullscreen=""
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAxasPhBlBcRiOxTX8U9f7K-_0992N7Si8&q={{ $tournament_detail['event_latitude'] }},{{ $tournament_detail['event_longtitude'] }}">
          </iframe>
        </div>

        @if(count($tournament_detail['event_tags']))
            <h4 class="">Tags</h4>
            <div class="available-sports mb-4 gap-2">
                @foreach ($tournament_detail['event_tags'] as $tags)
                    <span class="tags">{{ $tags }}</span>
                @endforeach
            </div>
        @endif
        <!-- Progress Section -->
        {{-- <div class="progress-section mb-4 mt-4">
            <h4>Overview {{ $coachData->category->category_name }} Session</h4>
            <div class="dark-progress-container mb-3">
                <div class="progress-label">Begin</div>
                <div class="dark-progress-bar-wrapper">
                    <div class="dark-progress">
                        @php
                            $activityDurationD = $sessionDurationData['activities'];
                            $lastKey = array_key_last($activityDurationD);
                        @endphp
                        @foreach ($activityDurationD as $key => $activity)
                            @php
                                $perc = ceil(($activity['activity_duration'] / $sessionDurationData['session_duration']) * 100)
                            @endphp
                            <div class="dark-progress-bar {{ $key==0 ? 'rounded-left' : ($key == $lastKey ? 'rounded-right' : '')}}" style="background:{!! Common::sessionColors($key) !!};width:{{ $perc }}%;"></div>
                        @endforeach
                    </div>
                </div>
                <div class="progress-label">{{ $sessionDurationData['session_duration'] }} Min</div>
            </div>

            <div class=" p-3 bg-dark-theme mb-3">
                @foreach ($activityDurationD as $k => $act)
                <div class="dark-session-item mb-3">
                    <div class="dark-icon-box" style="background: {!! Common::sessionColors($k) !!};"></div>
                    <div class="ml-3 d-flex flex-grow-1 justify-content-start">
                        <span style="width:50px;">{{ $act['activity_duration'] }} Mins</span>
                        <span class="text-muted ml-5">{{ $act['activity'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div> --}}
        {{-- @if(count($relatedCoaching))
            <div class="hawan_section">
                <div class="d-sm-flex align-items-center justify-content-between mt-5 mb-3 overflow-hidden">
                    <h1 class="h4 mb-0 float-left">Related Coaching</h1>
                </div>
                <div class="event-block-slider">
                    @foreach ($relatedCoaching as $coaching)
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
                                        <small class="text-dark" title="{{ $coaching->venue_name }}"><i class="fas fa-map-marker-alt pr-2"></i>
                                        {{ strlen($coaching->venue_name) > 50 ? substr($coaching->venue_name, 0, 50) . '...' : $coaching->venue_name }}
                                        </small>
                                    </p>

                                    @php
                                        // $sessionDays = isset($coaching->coachingPackage->session_days) ? json_decode($coaching->coachingPackage->session_days, true) : [];
                                    @endphp
                                <p class="my-1 text-light"><small>  {{ $coaching->venue_area.', '.$coaching->venue_address.', '.$coaching->venue_city }} </small></p>

                                    <div class="mt-2 d-flex justify-content-between align-items-center">
                                    {!!Common::showDiscountLabel($coaching->coachingPackage->package_price, $coaching->coachingPackage->discount_percent )!!}  
                                    
                                        <a href="{{url('coaching-book/'.$coaching->id.'/'.Str::slug($coaching->coaching_title))}}" class="mt-1 btn btn-success btn-sm mb-1 ">Book Now</a>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif --}}
    </div>
</section>
@endsection
@include('alert-messages')