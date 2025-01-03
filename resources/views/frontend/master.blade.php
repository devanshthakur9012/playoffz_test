<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $favicon = Common::siteGeneralSettingsApi();
    @endphp
    <meta charset="utf-8">
   
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <link rel="manifest" href="{{ asset('/organizer_manifest.json') }}">
    {{-- env('BACKEND_BASE_URL')}}/{{$cat['cover_img'] --}}
    <link href="{{ $favicon['favicon'] ? env('BACKEND_BASE_URL')."/".$favicon['favicon'] : "https://app.playoffz.in/images/favicon.png" }}" rel="icon" type="image/png">
    {{-- <link href="https://app.playoffz.in/images/favicon.png" rel="icon" type="image/png">  --}}
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $favicon['app_name'] }} | @yield('title')</title>
    @yield('og_data')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light only">
    <input type="hidden" name="base_url" id="base_url" value="{{ url('/') }}">
    <link href="{{ asset('f-vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('f-vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('f-vendor/slick/slick.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('f-vendor/slick/slick-theme.min.css') }}" />
    <link href="{{ asset('f-css/main.css') }}" rel="stylesheet">
    
    @stack('styles')        
    
    <style>
        /* .btn-success, .default-btn {  
            animation: glowing 800ms infinite;
        }

        @keyframes glowing {
        0% {  box-shadow: 0 0 3px #fff; }
        50% {  box-shadow: 0 0 8px #fff; }
        100% {  box-shadow: 0 0 3px #fff; }
        } */
    </style>
    <style>
        .menu_item{
            border-radius: 20px;
            padding: 5px 10px;
            color: #ffffff;
            line-height: 20px;
        }
    </style>
</head>

<body>
    {{-- <div class="sharethis-sticky-share-buttons"></div> --}}
    <div class="sigma_preloader">
        @if (isset($favicon['loader']))
            @php $url = env('BACKEND_BASE_URL')."/".$favicon['loader'];  @endphp
        @else
            @php $url = asset('images/FitSportsy_logo_No_BG.png');  @endphp
        @endif
        <img src="{{$url}}" alt="preloader">
    </div>
    <header class="site-header sticky-top">
        <nav class="navbar navbar-expand navbar-dark topbar static-top shadow-sm bg-dark osahan-nav-top">
            <div class="container">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <a class="navbar-brand" href="/"><img
                            src="{{ $favicon['favicon'] ? env('BACKEND_BASE_URL')."/".$favicon['logo'] : "https://app.playoffz.in/images/website/1733339125.png" }}"
                            class="img-fluid" alt></a>
                    <div class="d-none d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 ml-3 navbar-search">
                        <div class="input-group searchinput">
                            <input type="text" class="form-control border-0 small head-search-box"
                                placeholder="Search for tournaments..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="list-group list-group-flush searchlist scrollbar search-result">

                            </div>
                            <div class="input-group-append">
                                <button class="btn bg-light" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow-sm animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <div class="form-inline mx-auto w-100 navbar-search">
                                    <div class="input-group searchinput">
                                        <input type="text"
                                            class="form-control bg-light text-dark border-0 small head-search-box"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="list-group list-group-flush searchlist scrollbar search-result">

                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item no-arrow mx-1 desk-seva-ticket">
                            <a class="nav-link" href="javascript:void(0);"  data-toggle="modal" data-target="#locationModal">
                               <i class="fas fa-map-marker-alt"></i>
                               <span class="pl-2">{{Session::has('CURR_CITY') ? Session::get('CURR_CITY') : 'Popular Locations'}}</span>
                            </a>
                        </li>
                        {{-- <li class="nav-item no-arrow mx-1">
                            <a class="nav-link" href="{{ url('my-cart') }}">
                                <i class="fas fa-heart pr-1"></i>
                                @php
                                    $cartTotal = 0;
                                    if (Session::has('CART_DATA_BMJ')) {
                                        $cartTotal = count(json_decode(Session::get('CART_DATA_BMJ'), true));
                                    }
                                @endphp
                                <span class="badge badge-danger badge-counter">{{ $cartTotal }}</span>
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{env('BACKEND_BASE_URL')}}/add_event.php" class="mx-3 loginbtn "><img src="{{asset('/images/org_btn.png')}}" alt="" style="height:55px"></a>
                        </li>
                        @if (Common::isUserLogin())
                            <li class="nav-item dropdown no-arrow ">
                                @if (Common::isUserLogin())
                                    @php $userData = Common::fetchUserDetails(); @endphp
                                    <a class="nav-link dropdown-toggle pr-0" href="#" id="userDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <span
                                            class="mr-2 d-none d-lg-inline text-white ">{{ $userData['name'] }}</span>
                                            @if (isset($user['pro_pic']) && $user['pro_pic'] != null)
                                                <img class="img-profile rounded-circle"
                                                    src="{{ asset('images/upload/' . $userData['pro_pic']) }}">
                                            @else
                                                <i class="fas fa-user-circle fa-lg"></i>
                                            @endif
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow-sm animated--grow-in"
                                        aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="{{ url('user/my-profile') }}">
                                            <i class="fas fa-user-circle fa-sm fa-fw mr-2 text-gray-600"></i>
                                            Profile
                                        </a>
                                        <a class="dropdown-item" href="{{ route('my-booking',['type'=>'Active']) }}">
                                            <i class="fas fa-ticket-alt fa-sm fa-fw mr-2 text-gray-600"></i>
                                            My Booking
                                        </a>
                                        {{-- <a class="dropdown-item" href="{{ url('my-orders') }}">
                                            <i class="fas fa-wallet fa-sm fa-fw mr-2 text-gray-600"></i>
                                            Wallet
                                        </a> --}}
                                        <a class="dropdown-item" href="{{route('help-center')}}">
                                            <i class="fas fa-question fa-sm fa-fw mr-2 text-gray-600"></i>
                                            Help Center
                                        </a>
                                        {{-- <a class="dropdown-item" href="{{ url('user/account-settings') }}">
                                            <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-600"></i>
                                            Invite Friends
                                        </a> --}}
                                        {{-- <a class="dropdown-item" href="{{ url('user/account-settings') }}">
                                            <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-600"></i>
                                            Delete Account
                                        </a> --}}
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="{{ url('logout-user') }}">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 "></i>
                                            Logout
                                        </a>
                                    </div>
                                @else
                                    {{-- <a class="nav-link dropdown-toggle pr-0" href="#" id="userDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <span
                                            class="mr-2 d-none d-lg-inline text-white ">{{ $user['name'] }}</span>
                                        <img class="img-profile rounded-circle"
                                            src="{{ asset('images/upload/' . $user['pro_pic']) }}">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow-sm animated--grow-in"
                                        aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="{{ url('admin/home') }}">
                                            <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-600"></i>
                                            Dashboard
                                        </a>
                                        <a class="dropdown-item text-danger" href="{{ url('logout-user') }}">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 "></i>
                                            Logout
                                        </a>
                                    </div> --}}
                                @endif
                            </li>
                        @else
                            <li class="nav-item no-arrow align-self-center mx-2 position-relative">
                               
                                <a class="position-relative dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle fa-lg"></i>
                                  </a>
                                
                                  <div class="dropdown-menu dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ url('user-login') }}"><i class="fas fa-sign-in-alt"></i>   Login</a>
                                    <a class="dropdown-item" href="{{ url('user-register') }}"><i class="fas fa-user-plus"></i> Register</a>
                                  </div>

                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark osahan-nav-mid">
            <div class="container position-relative">
                <a class="mobile-seva-ticket text-white" href="javascript:void(0);"  data-toggle="modal" data-target="#locationModal">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{Session::has('CURR_CITY') ? Session::get('CURR_CITY') : 'Location'}}</span>
                </a>
                <button class="navbar-toggler navbar-toggler-right btn btn-danger btn-sm " type="button"
                    data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span> Menu
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav w-100 justify-content-center">
                        @foreach (Common::allEventCategoriesByApi() as $cat)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('tournament', [Str::slug($cat['title']), $cat['id']]) }}">
                                    <span class="menu_item"><img src="{{env('BACKEND_BASE_URL')}}/{{$cat['cat_img']}}" class="mr-1" width="20px" alt="{{$cat['title']}}">{{$cat['title']}}</span></a>
                            </li>
                        @endforeach
                        {{-- <li class="nav-item ml-auto">
                    <a class="nav-link" href="">
                        Samuhik Homam</a>
                </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="">Religious & Spirtual Items</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/spiritual-volunteers">Spiritual Volunteers</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </nav>
    </header>



    @yield('content')
    {{-- <address class="bottom-location">
        <div class="container">
            <h5 class="text-white mb-3">Categories</h5>
            <div>
                <ul class="list-unstyled ">
                    @foreach (Common::allEventCategories() as $cat)
                    <li><a href="{{url('all-events?category='.$cat->id)}}">{{$cat->name}}</a></li>
                    @endforeach
                </ul>
            </div>
              <h5 class="text-white mb-3">Locations</h5>
            <div>
                    <ul class="list-unstyled ">
                        @foreach (Common::allEventCities() as $city)
                            <li><a href="{{url('all-events?city='.$city->id)}}">{{$city->city_name}}</a></li>
                        @endforeach

                    </ul>
            </div>
        </div>
    </address> --}}
    {{-- <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 mt-4 col-lg-4 ">
                    <div class="resources">
                        <h6 class="footer-heading text-uppercase text-white fw-bold">Quick Links</h6>
                        <ul class="list-unstyled footer-link mt-4">
                            <li class="mb-1"><a href="{{url('all-events')}}" class="text-white text-decoration-none ">All Events</a></li>
                            <li class="mb-1"><a href="{{url('contact')}}" class="text-white text-decoration-none ">Contact Us</a></li>
                            <li class="mb-1"><a href="" class="text-white text-decoration-none ">Terms & Conditions </a></li>
                            <li class=""><a href="{{url('privacy-policy')}}" class="text-white text-decoration-none ">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mt-4 col-lg-4 ">
                  <div class="social">
                      <h6 class="footer-heading text-uppercase text-white fw-bold">Social Links</h6>
                      <ul class=" my-4">
                        <li class=""><a href="{{$favicon['Facebook']}}" class="text-white mb-2"><i class="fab fa-facebook"></i> Facebook</a></li>
                        <li class=""><a href="{{$favicon['Instagram']}}" class="text-white mb-2"><i class="fab fa-instagram"></i> Instagram</a></li>
                        <li class=""><a href="{{$favicon['Twitter']}}" class="text-white mb-2"><i class="fab fa-twitter"></i> Twitter</a></li>
                    </ul>
                  </div>
              </div>
                <div class="col-sm-6 col-md-6 mt-4 col-lg-4 ">
                  <div class="contact">
                      <h6 class="footer-heading text-uppercase text-white fw-bold">Contact Us</h6>
                      <address class="mt-4 m-0 text-white mb-1"><i class="fas fa-map-marker-alt"></i> New South Block , Phase 8B , 160055</address>
                      <a href="tel:+" class="text-white mb-1 text-decoration-none d-block "><i class="fas fa-phone-alt"></i>  909090XXXX</a>
                      <a href="mailto:" class="text-white mb-1 text-decoration-none d-block "><i class="fas fa-envelope"></i> xyzdemomail@gmail.com</a>
                  </div>
                </div>
            </div>
        </div>
        <div class="text-center bg-dark text-white mt-4 p-1">
             <p class="m-0 text-center">Copyright &copy; 2023 | Made with by <a class="text-danger" target="_blank" href="https://applaudwebmedia.com/">Applaud Web Media</a></p>
        </div>
      </footer> --}}


    <address class="bottom-location">
        <div class="container">
            <div>
                <h5 class="text-white mb-2">Categories</h5>
                <ul class="list-unstyled ">
                    @foreach (Common::allEventCategoriesByApi() as $cat)
                        <li><a href="{{ route('tournament', [Str::slug($cat['title']), $cat['id']]) }}">
                            {{$cat['title']}}</a></li>
                            {{-- <img src="{{env('BACKEND_BASE_URL')}}/{{$cat['cat_img']}}" class="me-2" alt="{{$cat['title']}}"> --}}
                    @endforeach
                </ul>
            </div>
            <div>
                <h5 class="text-white mb-2">Locations</h5>
                <ul class="list-unstyled ">
                    @foreach (Common::fetchLocation() as $item)
                        <li><a href="{{ url('event-city?city=' . $item['city'] . '&redirect=' . request()->fullUrl()) }}">{{$item['city']}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </address>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 mt-4 col-lg-4 col-6 ">
                    <div class="resources">
                        <h6 class="footer-heading text-uppercase text-white fw-bold">Quick Links</h6>
                        <ul class="list-unstyled footer-link mt-4">
                            {{-- <li class="mb-1"><a href="all-events" class="text-white text-decoration-none ">All
                                    Events</a></li> --}}
                            <li class=""><a href="{{route('help-center')}}"
                                class="text-white text-decoration-none ">Help Center</a></li>
                            @php
                                // dd(Common::pageListData());
                            @endphp
                            @if(Common::pageListData() && count(Common::pageListData()))
                                @foreach (Common::pageListData() as $item)
                                    <li class="mb-1"><a href="{{ url('/pages/' . $item['slug']) }}" class="text-white text-decoration-none">{{ $item['title'] }}</a></li>
                                @endforeach
                            @endif  
                            {{-- <li class="mb-1"><a href="contact" class="text-white text-decoration-none ">Contact
                                    Us</a></li>
                            <li class="mb-1"><a href="{{url('terms-and-conditions')}}"
                                    class="text-white text-decoration-none ">Terms & Conditions </a></li>
                            <li class=""><a href="{{url('privacy-policy')}}"
                                    class="text-white text-decoration-none ">Privacy Policy</a></li>
                            <li class=""><a href="{{url('cancellation-policy')}}"
                                class="text-white text-decoration-none ">Cancellation Policy</a></li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mt-4 col-lg-4 col-6">
                    <div class="social">
                        <h6 class="footer-heading text-uppercase text-white fw-bold">Social Links</h6>
                        <ul class=" my-4">
                            @isset($favicon['Facebook'])
                                <li class=""><a href="{{ $favicon['Facebook'] }}" target="_blank"
                                        class="text-white mb-2"><i class="fab fa-facebook"></i> Facebook</a></li>
                            @endisset
                            @isset($favicon['Instagram'])
                            <li class=""><a href="{{ $favicon['Instagram'] }}" target="_blank"
                                    class="text-white mb-2"><i class="fab fa-instagram"></i> Instagram</a></li>
                            @endisset
                            @isset($favicon['Twitter'])
                            <li class=""><a href="{{ $favicon['Twitter'] }}" target="_blank"
                                    class="text-white mb-2"><i class="fab fa-twitter"></i> Twitter</a></li>
                            @endisset
                            @isset($favicon['Linkedin'])
                            <li class=""><a href="{{ $favicon['Linkedin'] }}" target="_blank"
                                    class="text-white mb-2"><i class="fab fa-linkedin"></i> Linkedin</a></li>
                            @endisset
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 mt-4 col-lg-4 col-12">
                    <div class="contact">
                        <h6 class="footer-heading text-uppercase text-white fw-bold">Contact Us</h6>
                        <a href="" class="mt-4 text-white mb-2"><i class="fas fa-map-marker-alt"></i> {{ $favicon['address'] }}</a>
                        <a href="tel:{{ $favicon['mobile'] }}" class="text-white mb-1 mt-1 text-decoration-none d-block "><i
                                class="fas fa-phone-alt"></i> {{ $favicon['mobile'] }}</a>
                        <a href="mailto:{{$favicon['email']}}"
                            class="text-white mb-1 text-decoration-none d-block "><i class="fas fa-envelope"></i>
                            {{ $favicon['email'] }}</a>
                    </div>
                </div>
            </div>
        </div>
     
        <div class="text-center bg-dark mt-4 p-2" style="color: #b5b5b5">
            <div class="container">
                <p class="m-0 small text-center">{{ $favicon['footer_copyright'] }}</p>
            </div>
           
        </div>
    </footer>

    <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel"><i class="fas fa-map-marker-alt"></i>
                        Locations</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="popular-location">
                            <h6 class="text-center mb-3">Popular Cites</h6>
                            {{-- @php
                                $citiesAll = Common::allEventCities();
                                $citiesImages = [];
                                $citiesWimg = [];
                                foreach($citiesAll as $vl){
                                    if(file_exists(public_path('images/city-icons/'.$vl->city_name.'.png'))){
                                        $citiesImages[] = $vl;
                                    }else{
                                        $citiesWimg[] = $vl;
                                    }
                                }
                            @endphp --}}
                            <div class="d-flex flex-wrap justify-content-center" style="gap: 10px;">
                                {{-- @foreach ($citiesImages as $city)
                                <div class="w-auto">
                                    <a href="{{ url('event-city?city=' . $city->city_name . '&redirect=' .request()->fullUrl()) }}" class="btn text-center btn-outline-light btn-sm "><img src="{{asset('images/city-icons/'.$city->city_name.'.png')}}" alt="" class="img-fluid d-block m-auto" style="width: 50px; height: 50px;object-fit: contain;">{{ $city->city_name }}</a>
                                </div>
                                @endforeach --}}
                                @foreach (Common::fetchLocation() as $item)
                                    <div class="w-auto">
                                        <a href="{{ url('event-city?city=' . $item['city'] . '&redirect=' . request()->fullUrl()) }}" class="btn text-center btn-outline-light btn-sm">
                                            @if(isset($item['image']) && $item['image'] != null)
                                                <img class="img-fluid d-block m-auto" style="width: 50px; height: 50px; object-fit: contain;" src="{{ env('BACKEND_BASE_URL') }}/{{$item['image']}}" alt="{{$item['city']}}">
                                            @endif
                                            {{$item['city']}}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            {{-- <h6 class="mt-3 text-center">Other Cites</h6>
                            <div class="d-flex flex-wrap justify-content-center" style="gap: 10px;">
                                <a href="{{ url('event-city?city=All' . '&redirect=' .request()->fullUrl()) }}"
                                    class="btn btn-outline-light btn-sm w-auto ">All Cities</a>
                                @foreach ($citiesWimg as $city)
                                <div class="w-auto">
                                    <a href="{{ url('event-city?city=' . $city->city_name . '&redirect=' .request()->fullUrl()) }}" class="btn btn-outline-light btn-sm w-100 m">{{ $city->city_name }}</a>
                                </div>
                                @endforeach
                            </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

 <!-- Start Go Top Area -->
 {{-- <div class="go-top">
    <i class="fas fa-arrow-up"></i>
</div> --}}


    <script src="{{ asset('f-vendor/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('f-vendor/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('f-vendor/slick/slick.min.js') }}"></script>
    @stack('scripts')
    <script>
        var timeout = null;
        $(".head-search-box").on('input click', function(e) {
            var val = $(this).val().split(' ').join('_');

            if (e.which == 13 && val != '') {
                    //
            }
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                $.get('{{ url('search-all-events') }}?search_str=' + val, function(data) {
                    $(".search-result").html(data);
                })
            }, 200);

        })
    </script>
    <script src="{{ asset('frontend/js/site_custom.js') }}" type="text/javascript"></script>
    <script>
        $(document).on('click', function(event) {
            if (!$(event.target).closest(".searchinput").length) {
                $(".search-result").html('')
            }

        })
    </script>

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            window.addEventListener("load", function() {
                navigator.serviceWorker
                .register("/sw.js")
                .then(res => console.log("service worker registered"))
                .catch(err => console.log("service worker not registered", err))
            })
        }
    </script>
     <script src="{{ asset('frontend/js/site_custom.js') }}" type="text/javascript"></script>
     <script>
         $(document).on('click', function(event) {
             if (!$(event.target).closest(".searchinput").length) {
                 $(".search-result").html('')
             }
 
         })
 
         $(window).on('scroll', function(){
         var scrolled = $(window).scrollTop();
         if (scrolled > 600) $('.go-top').addClass('active');
         if (scrolled < 600) $('.go-top').removeClass('active');
     });  
     $('.go-top').on('click', function() {
         $("html, body").animate({ scrollTop: "0" },  500);
     });
     </script>
    @if(!Session::has('CURR_CITY'))
    <script>
        setTimeout(()=>{
            $('#locationModal').modal('show');
        },3000)
    </script>

    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(getpos);
        } else {
        }
        function getpos(position) {
            latx=position.coords.latitude;
            lonx=position.coords.longitude;
        $.post('{{url("set-u-location")}}',{'_token':"{{csrf_token()}}","latx":latx,"lonx":lonx},function(data){
                if(data.s==1){
                    if(localStorage.getItem("u_curr_location") === null){
                        localStorage.setItem("u_curr_location",data.name)
                        window.location.reload();
                    }
                    
                }else{
                    localStorage.removeItem("u_curr_location");
                }
        })
        }
    </script>

    @endif

    

</body>

</html>
