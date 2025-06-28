@extends('frontend.master', ['activePage' => 'home'])
@section('og_data')
<head>
    <meta charset="UTF-8">
    <meta property="og:title" content="{{ $tournament_detail['event_title'] }}" />
    <meta property="og:description" content="Organizer : {{ $tournament_detail['sponsore_name'] }}" />
    <meta property="og:image" content="{{ env('BACKEND_BASE_URL') }}/{{$tournament_detail['event_cover_img'][0]}}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Your Site Name" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:updated_time" content="{{ now()->toAtomString() }}" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $tournament_detail['event_title'] }}" />
    <meta name="twitter:description" content="Organizer : {{ $tournament_detail['sponsore_name'] }}" />
    <meta name="twitter:image" content="{{ env('BACKEND_BASE_URL') }}/{{$tournament_detail['event_cover_img'][0]}}" />
    <meta name="twitter:url" content="{{ url()->current() }}" />
    <meta name="twitter:site" content="@YourTwitterHandle" />

    <meta name="description" content="Organizer : {{ $tournament_detail['sponsore_name'] }}" />
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
        font-size: 16px;
        line-height: 1.6;
        color: #ffffff;
    }

    @media (min-width: 768px) {
        .single-detail-area p {
            font-size:  16px;
        }

        .dark-gap {
            margin-right: 2rem;
        }
    }

    /* Card layout for available sports */
    .available-sports {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 0px;
    }

    .available-sport-card {
        /* padding: 10px; */
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

        .mbsm{
            margin-bottom: 12px;
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
    
        
    
    {{-- <style>
        .btn-success, .default-btn {  
            animation: glowing 800ms infinite;
        }

        @keyframes  glowing {
        0% {  box-shadow: 0 0 3px #fff; }
        50% {  box-shadow: 0 0 8px #fff; }
        100% {  box-shadow: 0 0 3px #fff; }
        }

    </style> --}}
    <style>
        .icon_box{
            /* background: #f8f9fa; */
            /* color: gold; */
            padding: 23px;
            border-radius: 32px;
            margin-right: 15px;
            height: 30px;
            width: 30px;
            justify-content: center;
            align-items: center;
            display: flex;
            /* border: 1px solid #004aad; */
            color: initial; /* Default styling */
            border: 1px solid transparent; /* Default border */
        }
        .icon_box i{
            font-size: 20px;
        }
        
        /* Calendar Icon */
        .calendar_icon {
            color: #4A90E2; /* Vibrant blue */
            border: 2px solid #4A90E2;
        }

        /* Ticket Icon */
        .ticket_icon {
            color: #FF8C42; /* Bold orange */
            border: 2px solid #FF8C42;
        }

        /* Location Icon */
        .location_icon {
            color: #3AB795; /* Deep green */
            border: 2px solid #3AB795;
        }

        .profile-img {
            width: 50px !important;       /* Set the width of the image (adjust as necessary) */
            height: 50px !important;      /* Set the height of the image (adjust as necessary) */
            border-radius: 50%; /* Makes the image circular */
            object-fit: cover;  /* Ensures the image fills the circle without distorting */
            border:2px solid #004aad !important;
            margin-right: 15px;
            padding:3px !important;
        }
        .tags{
            background: #004aad;
            color: #ffffff;
            border-radius: 20px;
            padding: 3px 10px;
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
            background: #070b28 !important;
            padding: 20px;
            text-align: left;
            color: #ffffff;
            font-weight: 500;
            display: flex;
            border-radius: 3px;
            margin-bottom: 20px;
        }

        .alert_info span{
            color:#004aad;
            cursor: pointer;
        }

        .alert_info .iconBox{
            margin-right: 13px;
            font-size: 23px;
            color: #ffffff;
        }

        .social-share-buttons {
            display: flex;
            gap: 15px;
            /* margin-top: 20px; */
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
            width: 35px;
            height: 35px;
            text-align: center;
            font-size: 17px;
            line-height: 18px;
        }
        .instagram {
            background-color: #E4405F;
            padding: 10px;
            border-radius: 50%;
            color: #fff;
            width: 35px;
            height: 35px;
            text-align: center;
            font-size: 17px;
            line-height: 18px;
        }
        .linkedin {
            background-color: #0077b5;
            padding: 10px;
            color: #fff;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            text-align: center;
            font-size: 17px;
            line-height: 18px;
        }
        .whatsapp{
            background-color: #25D366;
            padding: 10px;
            color: #fff;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            text-align: center;
            font-size: 17px;
            line-height: 18px;
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

        h4 {
            font-weight: bold;
            color: #ffffff;
            font-size: 20px !important;
            margin-bottom: 8px !important;
        }

        .grayText{
            padding-left: .5rem !important;
        }

        .grayText p{
            font-size: 16px !important;
            font-weight: 400;
            color: #e7e7e7 !important;
            margin:0px;
        }

        .type_cat{
            padding: 4px 8px !important;
            background: #004aad;
            color: #ffffff;
            font-size: 12px !important;
            font-weight: 400;
        }

        .refree{
            background: #2e335a45;
            padding: 12px;
            border-radius: 20px;
            border: 1px dashed;
        }

        .grayText * {
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            color: inherit !important;
            background: inherit !important;
        }

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

    /* .highlighter{
        color: #ffffff !important;
        margin-bottom: 15px !important;
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        border-bottom: 1px solid #0dc1e3;
        font-size: 18px !important;
        box-shadow: 1px 1px 7px #fff;
        font-weight: 600 !important;
    } */

    .bgFilter{
        /* background: #111635;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px !important; */
        margin-bottom: 20px
    }

    .highlighter{
        position: relative;
        display: inline-block;
        padding: 9px 20px;
        font-weight: 400 !important;
        background: #070b28;
        margin-bottom: 14px !important;
        font-size: 18px !important;
        color: #ffffff !important;
        border-radius: 2px;
        border-radius: 20px;
        box-shadow: 0px 0px 6px #004aad;
    }

    .bgFilter2{
        margin-bottom: 20px !important;
    }

    .bgFilter2 .highlighter{
        color: #ffffff !important;
        border-radius: 20px;
        box-shadow: 0px 0px 6px #004aad;
    }

    .img-thumbnail{
        background-color: #070b28 !important
     }

     .modalClose span{
        background: #ffffff;
        border-radius: 50%;
        height: 25px;
        width: 25px;
        position: absolute;
        font-size: 22px;
        line-height: 20px;
        top: -10px;
        right: -10px;
        color: #1a1b2e;
     }

     .timeCounter{
        display: flex;
        justify-content: space-around;
        align-items: center;
        text-align: center;
        text-transform: capitalize;
        background: #004aad;
        padding: 10px;
        border-radius: 4px;
     }
    .default2-btn{
        background-color: #ff2f31 !important;
        border-color: #ff2f31 !important;
        padding: 7px 10px;
        color:#fff !important;
    }
    </style>
<style>
    /* Dark Theme Styling */
    .subscription-section {
        background: #070b28;
        color: #ffffff;
        padding: 40px 0;
    }

    
    .subscription-section h1{
        font-size: 30px;
    }

    .subscription-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background: #1a1b2e;
        color: #ffffff;
        border-radius: 10px;
        /* padding: 25px; */
        transition: transform 0.2s, background 0.3s;
        /* box-shadow: 0 4px 10px rgb(255 255 255 / 20%); */
        /* margin-bottom: 20px; */
        overflow: hidden;
    }

    .subscription-card:hover {
        transform: translateY(-4px);
        background: #1b1b37;
    }

    .subscription-card-header {
        font-size: 1.5rem;
        font-weight: bold;
        padding: 15px;
        border-radius: 10px 10px 0 0;
        text-align: left;
    }

    .subscription-card-body {
        padding: 25px 20px 20px;
        background: #2e335a45 !important;
        position: relative;
    }

    .subscription-card-title {
        font-size: 2rem;
        margin: 10px 0;
        text-align: left;
        margin-top:0px;
        margin-bottom:0px;
    }

    .price-text-muted {
        color: #b0b0b0;
        font-size: 0.9rem;
    }

    .button-primary, .button-success, .button-premium {
        display: inline-block;
        padding: 10px 25px;
        width: 100%;  /* Full width button */
        color: #ffffff;
        font-size: 1rem;
        text-align: center;
        border-radius: 5px;
        text-decoration: none;
        border-radius: 0px;
        transition: background 0.3s, transform 0.2s;
        /* margin-top: 20px; */
        border: none !important;
    }

    .button-primary {
        /* background: linear-gradient(90deg, #004aad, #e74c3c); */
        background: #004aad;
    }

    .bg-girl{
        background: #e74c3c !important;
    }

    .bg-boy{
        background: #004aad !important;
    }


    /* .button-primary:hover {
        background: linear-gradient(90deg, #e74c3c, #004aad);
        transform: translateY(-2px);
        color: #fff;
    } */

    .button-success {
        background: linear-gradient(90deg, #28a745, #34d058);
    }

    .button-success:hover {
        background: linear-gradient(90deg, #34d058, #28a745);
        transform: translateY(-2px);
        color: #fff;

    }

    .button-premium {
        background: linear-gradient(90deg, #f39c12, #e67e22);
    }

    .button-premium:hover {
        background: linear-gradient(90deg, #e67e22, #f39c12);
        transform: translateY(-2px);
        color: #fff;

    }

    .discount-badge {
        background-color: #ff9800;
        color: #121212;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.9rem;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .price-list {
        list-style: none;
        padding: 0;
        margin: 10px 0 0;
    }

    .price-list li {
        margin-bottom: 12px;
        display: flex;
        align-items: center;
    }

    .price-list li i {
        color: #28a745;
        margin-right: 8px;
    }



    @media (min-width: 768px) {
        .subscription-card {
            height: 100%;
        }
    }

    .shop_single_page_sidebar{
        background: #414362;
        color: #fff;
        border: none;
        padding: 8px 20px;
        border-radius: 10px;
    }

    .shop_single_page_sidebar2{
        border: 1px solid #414362 !important;
        color: #fff;
        border: none;
        padding: 8px 20px;
        border-radius: 10px;
        width: 50%;
        text-align: center;
        background: #1a1b2e;
    }

    .slotBadge{
        position: absolute;
        top: -10px;
        right: 7px;
        background: #ffe14f !important;
        color: #000000 !important;
        font-size: 11px;
        padding: 6px !important;
        font-weight: 500;
    }
    .col-md-3{
        padding: 5px !important;
    }
    .quantity-block{
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }

    @media (min-width: 992px) { /* lg breakpoint */
        .col-lg-8.custom-width {
            flex: 0 0 62%;
            max-width: 62%;
        }
        
        .col-lg-4.custom-width {
            flex: 0 0 38%;
            max-width: 38%;
        }
    }

    .verified-badge {
        font-size: 16px;
        padding: 3px 6px;
        border-radius: 10px;
        vertical-align: middle;
    }
    
    /* Optional: Adjust spacing if needed */
    .custom-width {
        padding-right: 15px;
        padding-left: 15px;
    }
</style>
@endpush
@section('content')
<section class="section-area single-detail-area p-0">
    <div class="container-fluid p-0">
        @php
            $banners = [
                asset('frontend/images/banner-1.png'),
                asset('frontend/images/banner-2.png'),
                asset('frontend/images/banner-3.png'),
            ];
            $randomBanner = $banners[array_rand($banners)];
        @endphp

        <div class="p-0 mt-0 shadow-sm home-slider">
            <img src="{{ $randomBanner }}" class="img-fluid rounded" alt="Banner">
        </div>
    </div>

    <div class="container">

        <div class="row mt-5">
            <div class="col-lg-8 col-md-8 col-12 custom-width">
                <h4 class="mb-2"><span class="badge badge-success h2">{{$tournament_detail['category']}} Tournament</span></h4>
                <div class="mb-2">
                    <h4>{{ $tournament_detail['event_title'] }}</h4>
                    <small class="text_muted"><i class="far fa-calendar-alt"></i> {{ $tournament_detail['event_start'] }} - {{ $tournament_detail['event_end'] }}</small>
                </div>
                @if(isset($tournament_detail['EventTypePrice']) && count($tournament_detail['EventTypePrice']) > 0)
                <div class="text-white mt-4 mb-3"> 
                    <h4 class="highlighter">Catgeory</h4>
                        <div class="row mt-3">
                            @foreach ($tournament_detail['EventTypePrice'] as $package)
                                <div class="col-md-4 d-flex mb-4">
                                    <div class="subscription-card flex-grow-1 d-flex flex-column position-relative">
                                        <div class="subscription-card-header" style="background-color: #004aad;" data-ticket-type="{{ $package['ticket_type'] }}">
                                            <h4 class="mb-0 text-center" style="font-size: 18px;"><i class="fas fa-gem" style="font-size: 18px;"></i> {{ $package['ticket_type'] }}</h4>
                                        </div>
                                        <div class="subscription-card-body">
                                            <h3 class="subscription-card-title text-center">₹{{$package['ticket_price']}}<small class="price-text-muted">/ Slot</small></h3>
                                            <div class="price-list">
                                                <p><span class="badge badge-danger p-2 mb-0 slotBadge">{{$package['TotalTicket']}} Slot Left</span></p>
                                                <p class="text-center mb-0"><i class="fas fa-trophy mr-2"></i>{{$package['description']}}</p>
                                            </div>
                                        </div>
                                        <div class="subscription-card-footer">
                                            <button type="button" data-category="{{$package['category']}}" data-tour="{{$tournament_detail['event_id']}}" data-ticket="{{$package['typeid']}}" class="button-primary btn-buy">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="text-white mb-4 mt-3"> 
                    <h4 class="mb-2 highlighter">About Tournament</h4>
                    <div class="fs-3 px-2">{!! stripslashes($tournament_detail['event_about']) !!}</div>
                </div>                
                
                <div class="row align-items-center mb-4 mt-2">
                    <div class="col-lg-12 mbsm">
                        <div class="text-white">
                            <h4 class="mb-1 highlighter">Organized By</h4>
                            <div class="d-flex align-items-center">
                                <img class="img-thumbnail profile-img" src="{{ env('BACKEND_BASE_URL').'/'.$tournament_detail['sponsore_img'] }}" alt="{{$tournament_detail['sponsore_name']}}">
                                <div>
                                    <p class="mb-0 fs-2 d-flex align-items-center">
                                        {{$tournament_detail['sponsore_name']}}
                                        <span class="verified-badge ml-1" data-toggle="tooltip" title="Verified Organizer">
                                            <i class="fas fa-check-circle text-success"></i>
                                        </span>
                                    </p>
                                    <p class="mb-0 fs-2">{{$tournament_detail['sponsore_mobile']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row text-white mb-4">
                    <div class="col-lg-12">   
                        <h4 class="mb-1 highlighter">Venue</h4>
                        <p class="mb-0 mt-2"><i class="fas fa-map-marker-alt ml-2 mr-1"></i> {{ $tournament_detail['event_address'] }}</p>
                    </div>
                </div>
                    
                @if(count($tournament_Facility))
                <div class="text-white bgFilter2 mb-4"> 
                    <h4 class="highlighter">Tournament Facility</h4>
                    <div class="available-sports">
                        @foreach ($tournament_Facility as $sport)
                            <div class="available-sport-card">
                                <img class="rounded-circle p-1" src="{{ env('BACKEND_BASE_URL').'/'.$sport['facility_img'] }}" alt="$sport['facility_title']" >
                                <p class="mb-0 mt-1" style="font-size:12px; ">{{ $sport['facility_title'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @if(count($tournament_Restriction))
                <div class="text-white bgFilter2 mb-4"> 
                    <h4 class="highlighter">Tournament Prohibited</h4>
                    <div class="available-sports">
                        @foreach ($tournament_Restriction as $sport)
                            <div class="available-sport-card">
                                <img class="rounded-circle p-1" src="{{ env('BACKEND_BASE_URL').'/'.$sport['restriction_img'] }}" alt="$sport['restriction_title']" >
                                <p class="mb-0 mt-1" style="font-size:12px; ">{{ $sport['restriction_title'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif  
                @if(count($tournament_gallery))
                    <h4 class="highlighter bgFilter2 mb-4">Tournament Gallery</h4>
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
            </div>
            <div class="col-lg-4 col-md-4 col-12 custom-width">
                <div class="countdown text-left event-ticket card shadow-sm mb-3">
                    <div class="card-body" id="countdown">
                        <p class="mb-0">Loading countdown...</p>
                    </div>
                </div>
                <div class="event-ticket card shadow-sm mb-3">
                    <div class="card-body">
                        <img src="{{env('BACKEND_BASE_URL')}}/{{$tournament_detail['event_img']}}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="event-ticket card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="alert_info mb-0 align-items-center" style="background: #FFF3D2" role="alert">
                            <div class="iconBox"><i class="fas fa-ticket-alt"></i></div>
                            <p class="mb-0">Contactless Ticketing & Fast-track Entry with M-ticket. <span class="text-default" data-toggle="modal" data-target="#exampleModal">Learn How ></span></a>
                        </div>
                    </div>
                </div>
                <div class="text-left event-ticket card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="products-reviews text-center">
                            @isset($qrCodePath)
                                <h5 class="mb-3">📲 Scan to register instantly!</h5>
                                <div class="qr-code-container mb-3" style="display: inline-block; padding: 10px; border: 2px solid #ddd; border-radius: 8px; background-color: #f9f9f9;">
                                    <img src="{{ $qrCodePath }}" alt="QR Code">
                                </div>
                                <br>
                                <!-- Download Button with Icon -->
                                <a href="{{ $qrCodePath }}" download="tournament-booking.png" class="btn btn-primary btn-sm mt-2" style="display: inline-flex; align-items: center; gap: 5px;">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            @endisset 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- CTA Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <button type="button" class="close modalClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <img src="{{asset('/images/contactlessm Ticket.png')}}" width="100%" alt="">
                </div>
            </div>
            </div>
        </div>

        @if (isset($related_tournament) && count($related_tournament))
            <div class="hawan_section">
                <div class="d-sm-flex align-items-center justify-content-between mt-5 mb-3 overflow-hidden">
                    <h1 class="h4 mb-0 float-left">Related Tournament</h1>
                </div>
                <div class="event-block-slider">
                    @foreach ($related_tournament as $tour)
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
                                        @if(strtotime($tour['event_sdate']) < strtotime(date('Y-m-d')))
                                            <a href="javascript:void(0);" class="mt-1 btn default2-btn btn-sm mb-1 w-100">Completed</a>
                                        @else
                                            <a href="{{route('tournament-detail', [Str::slug($tour['event_title']),$tour['event_id']])}}" class="mt-1 btn btn-success btn-sm mb-1 w-100">Book Ticket</a>
                                        @endif
                                    </div>
                                    @php
                                        // $sessionDays = isset($coaching->coachingPackage->session_days) ? json_decode($coaching->coachingPackage->session_days, true) : [];
                                    @endphp
                                    {{-- @if(isset($coaching->coachingPackage) && $coaching->coachingPackage!=null)
                                        <p class="my-1 text-light"><small> 
                                            {{ $coaching->venue_area.', '.$coaching->venue_address.', '.$coaching->venue_city }}    
                                        </small></p>

                                        <div class="mt-2">
                                        {!!Common::showDiscountLabel($coaching->coachingPackage->package_price, $coaching->coachingPackage->discount_percent )!!}  
                                            <a href="{{url('coaching-book/'.$coaching->id.'/'.Str::slug($coaching->coaching_title))}}" class="mt-1 btn btn-success btn-sm mb-1 w-100 ">Book Ticket</>
                                        </div>
                                    @endif --}}
                                
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
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
@php
    $date = $tournament_detail['event_sdate']; // Example: "26 January, 2025"
    $time = $tournament_detail['event_time_day']; // Example: "Sunday, 9:00 AM TO 7:00 PM"

    // Split the time string to get the start time
    $time_parts = explode(', ', $time);
    $start_time = isset($time_parts[1]) ? explode(' TO ', $time_parts[1])[0] : ''; // Extract "9:00 AM"

    // Combine date and start time into a single datetime string
    $event_datetime = "$date $start_time"; // Example: "26 January, 2025 9:00 AM"
@endphp
@endsection
@include('alert-messages')

@push('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script>
    // Get the event start time from the format "Tue, 1st Jul 09:00 am"
    const eventTimeString = "{{ $tournament_detail['event_start_counter'] }}";     
    const eventDate = new Date(eventTimeString).getTime();
    
    // Update the countdown every second
    const countdownInterval = setInterval(() => {
        const now = new Date().getTime();
        const timeLeft = eventDate - now;

        if (timeLeft >= 0) {
            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            document.getElementById("countdown").innerHTML = `
                <h5 class="mb-3">⏳ Starts In</h5>
                <div class="timeCounter">
                    <div class="days">
                        <span>${days < 10 ? "0" + days : days}</span>
                        <div>days</div>
                    </div>
                    <div class="separator">:</div>
                    <div class="days">
                        <span>${hours < 10 ? "0" + hours : hours}</span>
                        <div>hours</div>
                    </div>
                    <div class="separator">:</div>
                    <div class="days">
                        <span>${minutes < 10 ? "0" + minutes : minutes}</span>
                        <div>minutes</div>
                    </div>
                    <div class="separator">:</div>
                    <div class="days">
                        <span>${seconds < 10 ? "0" + seconds : seconds}</span>
                        <div>seconds</div>
                    </div>
                </div>
            `;
        } else {
            clearInterval(countdownInterval);
            document.getElementById("countdown").innerHTML = "<p class='mb-0 text-center'>Event has started!</p>";
        }
    }, 1000);
</script>
<!-- <script>
    // Get the event date and time from PHP
    const eventDateTime = "{{ $event_datetime }}"; // Example: "26 January, 2025 9:00 AM"

    // Parse the date and time into a JavaScript Date object
    const eventDate = new Date(eventDateTime).getTime();

    // Update the countdown every second
    // const countdownInterval = setInterval(() => {
        const now = new Date().getTime();
        const timeLeft = eventDate - now;

        if (timeLeft >= 0) {
            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            document.getElementById("countdown").innerHTML = `
                <h5 class="mb-3">⏳ Starts In</h5>
                <div class="timeCounter">
                    <div class="days">
                        <span>${days < 10 ? "0" + days : days}</span>
                        <div>days</div>
                    </div>
                    <div class="separator">:</div>
                    <div class="days">
                        <span>${hours < 10 ? "0" + hours : hours}</span>
                        <div>hours</div>
                    </div>
                    <div class="separator">:</div>
                    <div class="days">
                        <span>${minutes < 10 ? "0" + minutes : minutes}</span>
                        <div>minutes</div>
                    </div>
                    <div class="separator">:</div>
                    <div class="days">
                        <span>${seconds < 10 ? "0" + seconds : seconds}</span>
                        <div>seconds</div>
                    </div>
                </div>
            `;
        } else {
            clearInterval(countdownInterval);
            document.getElementById("countdown").innerHTML = "<p class='mb-0'>Event has started!</p>";
        }
    // }, 1000);
</script> -->
<!-- <script>
    document.getElementById('shareBtn').addEventListener('click', function() {
        // Get data attributes from the button
        var title = this.getAttribute('data-title');
        var eventDate = this.getAttribute('data-sdate');
        var eventTime = this.getAttribute('data-time');
        var ticketPrice = this.getAttribute('data-ticket');
        var totalSpots = this.getAttribute('data-total');
        var tournamentLink = this.getAttribute('data-link');
        var imageUrl = this.getAttribute('data-img');  // Get the image URL

        // Create the WhatsApp message with the image URL included directly in the message text
        var message = `Hey! Check out this tournament: 
        \nTitle: ${title}
        \nDate: ${eventDate}
        \nTime: ${eventTime}
        \nTicket Price: ${ticketPrice}
        \nRemaining Spots: ${totalSpots}
        \n\nMore details: ${tournamentLink}`;  // WhatsApp will recognize this as an image URL for preview

        // Encode the message for URL
        var encodedMessage = encodeURIComponent(message);

        // Open WhatsApp with the pre-filled message (image preview will automatically be handled by WhatsApp)
        var whatsappURL = `https://wa.me/?text=${encodedMessage}`;
        window.open(whatsappURL, '_blank');
    });
</script> -->
<script>
    
    // Add click event listener for "Book Now" button
    $('.btn-buy').click(function (e) {
        e.preventDefault();

        var button = $(this);

        // Extract tour_id and ticket_id from button's data attributes
        var tourId = button.data('tour');
        var ticketId = button.data('ticket');
        var category = button.data('category');

        // Perform AJAX request to process booking
        $.ajax({
            url: "{{ route('purchase-tournament') }}", // Laravel route for handling the purchase
            type: 'POST',
            data: {
                tour_id: tourId,
                ticket_id: ticketId,
                category: category,
                quantity: 1,
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for security
            },
            success: function (response) {
                if (response.status === 'success') {
                    iziToast.success({
                        title: 'Success',
                        position: 'topRight',
                        message: response.message,
                    });
                    // Redirect to the returned URL
                    window.location.href = response.redirect_url;
                } else {
                    iziToast.error({
                        title: 'Error',
                        position: 'topRight',
                        message: response.message,
                    });
                }
            },
            error: function () {
                iziToast.error({
                    title: 'Error',
                    position: 'topRight',
                    message: 'An error occurred. Please try again later.',
                });
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get all the headers and buttons
        const ticketHeaders = document.querySelectorAll('.subscription-card-header');
        
        // Loop through each header
        ticketHeaders.forEach(function (ticketHeader) {
            const textContent = ticketHeader.textContent.toLowerCase();
            
            // Check if it contains "girl" or "women"
            if (textContent.includes("girl") || textContent.includes("women")) {
                ticketHeader.style.backgroundColor = "#db207b"; // Change header background color
                
                // Find the associated buy button and change its background color
                const btnBuy = ticketHeader
                    .closest('.subscription-card') // Find the parent card
                    .querySelector('.btn-buy'); // Find the buy button inside the card
                
                if (btnBuy) {
                    btnBuy.style.backgroundColor = "#db207b";
                }
            }
        });
    });
</script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@endpush
