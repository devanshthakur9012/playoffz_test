@extends('frontend.master', ['activePage' => 'home'])
@section('og_data')
<head>
    <meta property="og:title" content="{{ $tournament_detail['event_title'] }}" />
    <meta property="og:description" content="{{ $tournament_detail['event_about'] }}" />
    <meta property="og:image" content="{{ env('BACKEND_BASE_URL') }}/{{$tournament_detail['event_cover_img'][0]}}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Your Site Name" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:updated_time" content="{{ now()->toAtomString() }}" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $tournament_detail['event_title'] }}" />
    <meta name="twitter:description" content="{{ $tournament_detail['event_about'] }}" />
    <meta name="twitter:image" content="{{ env('BACKEND_BASE_URL') }}/{{$tournament_detail['event_cover_img'][0]}}" />
    <meta name="twitter:url" content="{{ url()->current() }}" />
    <meta name="twitter:site" content="@YourTwitterHandle" />

    <meta name="description" content="{{ $tournament_detail['event_about'] }}" />
    <meta name="keywords" content="{{ implode(',', $tournament_detail['event_tags']) }}" />
</head>
@endsection

@section('title', $tournament_detail['event_title'])
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
        /* border: 1px solid #444; */
        border-radius: 8px;
        width: auto;
        text-align: center;
        color: #fff;
        white-space: nowrap;
        min-width: 110px;
    }

    .available-sport-card span {
        font-size: 1.8rem;
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
/* 
    #shareButton {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #shareButton:hover {
        background-color: #0056b3;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    } */
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
            /* background: #f8f9fa; */
            color: #db207b;
            padding: 15px;
            border-radius: 32px;
            margin-right: 20px;
            height: 30px;
            width: 30px;
            justify-content: center;
            align-items: center;
            display: flex;
        }
        .icon_box i{
            font-size: 30px;
        }
        .profile-img {
            width: 50px;       /* Set the width of the image (adjust as necessary) */
            height: 50px;      /* Set the height of the image (adjust as necessary) */
            border-radius: 50%; /* Makes the image circular */
            object-fit: cover;  /* Ensures the image fills the circle without distorting */
            border: 0px solid #ddd; /* Optional: adds a border around the image */
            margin-right: 15px;
        }
        .tags{
            background:#db207b;
            color: #fff;
            border-radius: 20px;
            padding: 10px 15px;
        }

        /* Container for the slider */
        #blurImg {
            position: relative;
            width: 100%;
            height: 400px; /* Adjust height as per your requirement */
            overflow: hidden; /* Prevent the blurred background from overflowing */
        }

        /* Pseudo-element for the blurred background */
        #blurImg::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            filter: blur(10px); /* Apply blur effect to the background */
            z-index: 1; /* Ensure the blurred background stays behind the image */
        }

        /* Image on top of the blurred background */
        #blurImg img {
            position: absolute;
            top: 50%; /* Position image at the center vertically */
            left: 50%; /* Position image at the center horizontally */
            transform: translate(-50%, -50%); /* Adjust to make sure it's exactly centered */
            max-width: 100%; /* Prevent the image from stretching beyond the container */
            max-height: 100%; /* Prevent the image from stretching beyond the container */
            z-index: 2; /* Ensure the image is on top of the background */
        }

        .alert_info{
            background: #FFF3D2;
            padding: 20px;
            text-align: left;
            color: #000;
            font-weight: 500;
            display: flex;
            border-radius: 3px;
            margin-bottom: 20px;
        }

        .alert_info span{
            color:#db207b;
        }

        .alert_info .iconBox{
            margin-right: 13px;
            font-size: 23px;
            color: #db207b;
        }

        .social-share-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        .social-button img {
            transition: transform 0.3s ease;
        }
        .social-button img:hover {
            transform: scale(1.1);
        }
        .facebook {
            background-color: #3b5998;
            padding: 10px;
            border-radius: 50%;
            color: #fff;
            width: 40px;
            height: 40px;
            text-align: center;
            font-size: 20px;
            line-height: 24px;
        }
        .instagram {
            background-color: #E4405F;
            padding: 10px;
            border-radius: 50%;
            color: #fff;
            width: 40px;
            height: 40px;
            text-align: center;
            font-size: 20px;
            line-height: 24px;
        }
        .linkedin {
            background-color: #0077b5;
            padding: 10px;
            color: #fff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            text-align: center;
            font-size: 20px;
            line-height: 24px;
        }
        .whatsapp{
            background-color: #25D366;
            padding: 10px;
            color: #fff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            text-align: center;
            font-size: 20px;
            line-height: 24px;
        }
        .instagram i:hover{
            color: #fff;
        }
        .linkedin i:hover{
            color: #fff;
        }
        .facebook i:hover{
            color: #fff;
        }
    </style>
@endpush
@section('content')
<section class="section-area single-detail-area py-3">
    <div class="container">
        @if (isset($tournament_detail) && count($tournament_detail['event_cover_img']))
            @if (count($tournament_detail['event_cover_img']) > 1)
                <div class="pt-3 pb-3 shadow-sm home-slider">
                    <div class="osahan-slider">
                        @foreach ($tournament_detail['event_cover_img'] as $item)
                            <div class="osahan-slider-item">
                                {{-- <a @if($item->redirect_link != null) href="{{$item->redirect_link}}" @endisset > --}}
                                    <img src="{{env('BACKEND_BASE_URL')}}/{{$item}}" class="img-fluid rounded" alt="...">
                                {{-- </a> --}}
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="pt-3 pb-3 shadow-sm home-slider" id="blurImg">
                    @foreach ($tournament_detail['event_cover_img'] as $item)
                        <img src="{{ env('BACKEND_BASE_URL') }}/{{$item}}" class="img-fluid rounded" alt="...">
                    @endforeach
                </div>
            @endif
        @endif

        <div class="row mt-5">
            <div class="col-lg-8 col-md-8 col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>{{ $tournament_detail['event_title'] }}</h2>
                    {{-- <button id="shareButton" class="btn-sm btn-primary btn">Share</button> --}}
                </div>
                <div class="dark-gap text-white h5" style="margin-bottom: 0;">
                    <p class="dark-gap">Sport Catgeory : {{$tournament_detail['category']}}</p>

                    
                    <div class="row">
                        <div class="col-lg-6">
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
                        </div>
                        <div class="col-lg-6">
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
                        </div>
                    </div>
                    {{-- Address --}}
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon_box">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="text_box">
                            <!-- Using the provided latitude and longitude to open Google Maps -->
                            <p class="text_muted"></p><a class="text-white" href="{{ $tournament_detail['map_url'] }}" target="_blank">
                                {{ $tournament_detail['event_address'] }}
                            </a></p>
                        </div>
                    </div>
                    {{-- <p class="mr-3">👨‍👩‍👧‍👦 Age group: {{ $coachData->age_group }}</p>
                    <p class="mr-3">🏸 BYOE: {{ $coachData->bring_own_equipment }}</p>
                    <p>🎟️ Free Demo session: {{ $coachData->free_demo_session }}</p> --}}
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="my-5 text-white h5">
                            <h4 class="mr-4 mb-3">Organized By</h4>
                            <div class="d-flex align-items-center">
                                <img class="img-thumbnail profile-img" src="{{ env('BACKEND_BASE_URL').'/'.$tournament_detail['sponsore_img'] }}" alt="{{$tournament_detail['sponsore_name']}}">
                                <p class="mb-0 fs-2">{{ $tournament_detail['sponsore_name'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="mb-1">Share : </h5>
                        <div class="social-share-buttons">
                            <!-- Facebook Share Button -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="social-button facebook">
                                <i class="fab fa-facebook-f text-white"></i>
                            </a>
                            
                            <!-- Instagram Share Button -->
                            <!-- Instagram doesn't have a direct sharing link, so we use the profile link or a general Instagram share link -->
                            <a href="https://www.instagram.com" target="_blank" class="social-button instagram">
                                <i class="fab fa-instagram text-white"></i>
                            </a>
                            
                            <!-- LinkedIn Share Button -->
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($tournament_detail['event_title']) }}&summary={{ urlencode($tournament_detail['event_about']) }}" target="_blank" class="social-button linkedin">
                                <i class="fab fa-linkedin-in text-white"></i>
                            </a>

                            <!-- WhatsApp Share Button -->
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($tournament_detail['event_title']) }}%0A{{ urlencode($tournament_detail['event_about']) }}%0A{{ urlencode(url()->current()) }}" target="_blank" class="social-button whatsapp">
                                <i class="fab fa-whatsapp text-white"></i>
                            </a>
                        </div>
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

                @if(count($tournament_Artist))
                <h4 class=" mb-4">Tournament Referee</h4>
                <div class="row">
                    @foreach ($tournament_Artist as $sport)
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="card text-center shadow-sm" style="background: transparent">
                                <div class="card-body">
                                    <!-- Artist Image -->
                                    <img class="rounded-circle p-1 border" 
                                         src="{{ env('BACKEND_BASE_URL').'/'.$sport['artist_img'] }}" 
                                         alt="{{ $sport['artist_title'] }}" 
                                         width="100px" height="100px">
                                    <!-- Artist Title -->
                                    <p class="mt-2 mb-0" style="font-size: 16px; font-weight: 600;">{{ $sport['artist_title'] }}</p>
                                    <!-- Artist Role -->
                                    <span class="badge badge-primary mt-2">{{ $sport['artist_role'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            

                @if(count($tournament_Facility))
                    <h4 class="">Tournament Facility</h4>
                    <div class="available-sports mb-3">
                        @foreach ($tournament_Facility as $sport)
                            <div class="available-sport-card">
                                <img class="rounded-circle p-1" src="{{ env('BACKEND_BASE_URL').'/'.$sport['facility_img'] }}" alt="$sport['facility_title']" width="75" height="75">
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
                                <img class="rounded-circle p-1" src="{{ env('BACKEND_BASE_URL').'/'.$sport['restriction_img'] }}" alt="$sport['restriction_title']" width="75" height="75">
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
                        <div class="alert_info" style="background: #FFF3D2" role="alert">
                            <div class="iconBox"><i class="fas fa-ticket-alt"></i></div>
                            <div>Contactless Ticketing & Fast-track Entry with M-ticket. <span class="text-default">Learn How ></span></div>
                        </div>
                        <div class="single-ticket">
                            @if($tournament_detail['total_ticket'] <= 0)
                                <a href="javascript:void(0)" class="btn default-btn w-100">Sold Out</a>
                            @else
                                <a href="{{ $packageLink }}" class="btn default-btn w-100">Continue To Book {{ $tournament_detail['category'] }}</a>
                            @endif
                        </div>
                    </div>
                </div>
        
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="products-reviews">
                            <h3>{{$tournament_detail['event_address_title']}}</h3>
                            <span class="d-block" style="font-size: 12px;">{{ $tournament_detail['event_address'] }}</span>
                            {{-- <div class="progress-section mb-0 mt-3">
                                <iframe
                                width="100%" 
                                height="100%" 
                                frameborder="0" 
                                style="border:0;" 
                                allowfullscreen=""
                                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAxasPhBlBcRiOxTX8U9f7K-_0992N7Si8&q={{ $tournament_detail['event_latitude'] }},{{ $tournament_detail['event_longtitude'] }}">
                              </iframe>
                            </div> --}}
                            <div class="progress-section mb-0 mt-3" style="position: relative;">
                                <!-- Embed Google Map -->
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30766738.48171446!2d60.96917638629971!3d19.72516357822192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30635ff06b92b791%3A0xd78c4fa1854213a6!2sIndia!5e0!3m2!1sen!2sus!4v1734715250824!5m2!1sen!2sus" 
                                    width="100%" 
                                    height="100%" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            
                                <!-- Overlay that redirects on click -->
                                <a href="{{ $tournament_detail['map_url'] }}" target="_blank" 
                                   style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0); z-index: 10;">
                                </a>
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="progress-section mb-4 mt-4">
            <iframe
            width="100%" 
            height="450" 
            frameborder="0" 
            style="border:0;" 
            allowfullscreen=""
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAxasPhBlBcRiOxTX8U9f7K-_0992N7Si8&q={{ $tournament_detail['event_latitude'] }},{{ $tournament_detail['event_longtitude'] }}">
          </iframe>
        </div> --}}

        
                
        @if(count($tournament_gallery))
            <h4 class="mt-3">Tournament Gallery</h4>
            <div class="tournament-gallery">
                <div class="row gap-3">
                    @foreach ($tournament_gallery as $sport)
                        <div class="gallery-item col-lg-3">
                            <img class="gallery-image p-1" src="{{ env('BACKEND_BASE_URL').'/'.$sport }}" alt="Tournament Gallery Image" width="100%">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    
        
        @if(count($tournament_detail['event_tags']))
            <h4 class="mt-3">Tags</h4>
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
        <br>
    </div>
</section>
<script>
        window.onload = function() {
            // Get the dynamic background image URL
            const backgroundImage = "{{ env('BACKEND_BASE_URL') . '/' . $tournament_detail['event_cover_img'][0] }}";

            // Add the background-image dynamically to the pseudo-element using JavaScript
            const style = document.createElement('style');
            style.innerHTML = `
                #blurImg::before {
                    background-image: url(${backgroundImage});
                }
            `;
            document.head.appendChild(style);
        };
</script>
{{-- <script>
    document.getElementById("shareButton").addEventListener("click", async () => {
        const shareData = {
            title: "{{ $tournament_detail['event_title'] }}",
            text: "{{ $tournament_detail['event_about'] }}",
            url: "{{ url()->current() }}",
        };

        if (navigator.share) {
            try {
                await navigator.share(shareData);
                // alert("Thanks for sharing!");
            } catch (err) {
                console.error("Sharing failed", err);
            }
        } else {
            // Fallback for browsers without Web Share API
            const encodedURL = encodeURIComponent(shareData.url);
            const shareOptions = `
                <div>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=${encodedURL}" target="_blank">Share on Facebook</a><br>
                    <a href="https://twitter.com/intent/tweet?text=${encodeURIComponent(shareData.text)}&url=${encodedURL}" target="_blank">Share on Twitter</a><br>
                    <a href="https://www.linkedin.com/shareArticle?url=${encodedURL}&title=${encodeURIComponent(shareData.title)}" target="_blank">Share on LinkedIn</a>
                </div>
            `;
            document.body.insertAdjacentHTML("beforeend", shareOptions);
        }
    });
</script> --}}
@endsection
@include('alert-messages')