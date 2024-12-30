@extends('frontend.master', ['activePage' => 'login'])
@section('title', __('Login'))
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" integrity="sha512-DIW4FkYTOxjCqRt7oS9BFO+nVOwDL4bzukDyDtMO7crjUZhwpyrWBFroq+IqRe6VnJkTpRAS6nhDvf0w+wHmxg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    @media all and (display-mode: standalone) {
        #organizerLoginRadio {
            display: none;
        }
    }
</style>
<style>
    @media (max-width: 576px) {
        .imageHidden{
            display:none !important;
        }
        .col-lg-6{
            padding: 0px 15px !important;
        }
    }
</style>
<section class="section-area login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="imageHidden col-lg-6 p-0 d-flex align-items-stretch">
                <img src="{{asset('/images/login_banner.png')}}" width="100%" alt="">
            </div>
            <div class="col-lg-6 p-0 d-flex align-items-stretch">
                <div class="card o-hidden shadow-sm border-0 w-100">
                   <div class="card-body p-0">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12 d-flex justify-content-center align-items-center h-100">
                            <div class="p-lg-5 p-3 w-100">
                                <div class="text-center">
                                    <h1 class="h3 mb-4">Login to PlayOffz</h1>
                                </div>
                                {{-- <div class="form-group" style="display: none;">
                                    <h6>Login as a:</h6>
                                    <div class="radio-pannel d-flex flex-wrap" style="gap:15px">
                                        <label class="radio-label">
                                            <input type="radio" class="type_user" name="logintype" value="1"
                                                checked sty />
                                            <span>User</span>
                                        </label>
                                        <label class="radio-label" id="organizerLoginRadio">
                                            <input type="radio" class="type_user" name="logintype" value="2" />
                                            <span>Organiser</span>
                                        </label>
                                    </div>
                                </div> --}}
                                @include('messages')
                                <form class="user" method="post" name="register_frm" id="register_frm">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Mobile Number</label>
                                        <input type="number" name="number" class="form-control form-control-user"
                                            id="number" placeholder="Enter Mobile Number..." required>
                                    </div>
                                    <div class="form-group otp-section" style="display:none;">
                                        <label for="otp">OTP</label>
                                        <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP">
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck"
                                                    name="remember_me">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="{{url('user/resetPassword')}}">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <button type="button" id="verify_otp_btn" class="btn default-btn btn-user btn-block" style="display:none;">Verify OTP</button>
                                    <button type="submit" id="continue_btn"
                                        class="btn default-btn btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                {{-- <div class="text-center pb-3">
                                    <a href="{{url('login-with-google')}}" class="social-use-btn ">
                                        <img src="{{asset('images/google.png')}}" alt="" class="img-fluid">
                                        <span class="ps-2">Login with Google</span>
                                    </a>
                                </div> --}}
                                <div class="text-center">
                                    <a href="{{url('user-register')}}">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card o-hidden  shadow-sm border-0  ">
            <div class="card-body p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"
                        style="background-image: url('{{url("images/login.png")}}');">
                    </div>
                    <div class="col-lg-6">
                        <div class="row justify-content-center align-items-center h-100">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                <div class="p-lg-5 p-3">
                                    <div class="text-center">
                                    </div>
                                    <div class="text-center">
                                        <h1 class="h3 text-gray-900 mb-4">Login to Super Show</h1>
                                    </div>
                                    @include('messages')
                                    <form class="user" method="post" name="register_frm" id="register_frm">
                                        @csrf
                                        <div class="form-group">
                                            <h6>Login as a:</h6>
                                            <div class="radio-pannel d-flex flex-wrap" style="gap:15px">
                                                <label class="radio-label">
                                                    <input type="radio" class="type_user" name="logintype" value="1"
                                                        checked />
                                                    <span>User</span>
                                                </label>
                                                <label class="radio-label" id="organizerLoginRadio">
                                                    <input type="radio" class="type_user" name="logintype" value="2" />
                                                    <span>Purohit/Temple</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="email" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="password"
                                                placeholder="Password">
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck"
                                                        name="remember_me">
                                                    <label class="custom-control-label" for="customCheck">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="{{url('user/resetPassword')}}">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <button type="submit" id="continue_btn"
                                            class="btn default-btn btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center pb-3">
                                        <a href="{{url('login-with-google')}}" class="social-use-btn ">
                                            <img src="{{asset('images/google.png')}}" alt="" class="img-fluid">
                                            <span class="ps-2">Login with Google</span>
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <a href="{{url('user-register')}}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ url('frontend/js/jquery.validate.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        // Send OTP on mobile number submission
        $("#continue_btn").on('click', function (event) {
            event.preventDefault();
            const mobile = $('#number').val();
            const ccode = "+91"; // Assuming you have a country code field
            if (!mobile || mobile.length !== 10 || isNaN(mobile)) {
                iziToast.error({
                    title: 'Error',
                    position: 'topRight',
                    message: 'Please enter a valid 10-digit mobile number.'
                });
                return;
            }

            // Disable the button and change text
            $('#continue_btn').prop('disabled', true).text('Generating OTP...');

            $.ajax({
                url: "{{ route('verify-mobile-number') }}",
                type: 'POST',
                data: {
                    mobile: mobile,
                    ccode: ccode,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    // Re-enable the button and reset text
                    $('#continue_btn').prop('disabled', false).text('Continue');
                    if (response.status === 'success') {
                        iziToast.success({
                            title: 'Success',
                            position: 'topRight',
                            message: 'OTP sent successfully to your mobile number.'
                        });
                        // Show the OTP field
                        $('.otp-section').show();
                        $('#verify_otp_btn').show();
                        $('#continue_btn').hide();
                    } else {
                        iziToast.error({
                            title: 'Error',
                            position: 'topRight',
                            message: response.message
                        });
                    }
                },
                error: function () {
                    // Re-enable the button and reset text
                    $('#continue_btn').prop('disabled', false).text('Continue');
                    iziToast.error({
                        title: 'Error',
                        position: 'topRight',
                        message: 'Failed to send OTP. Please try again later.'
                    });
                }
            });
        });

        // Verify OTP and login the user
        $('#verify_otp_btn').on('click', function () {
            const otp = $('#otp').val();
            if (!otp || otp.length !== 4 || isNaN(otp)) {
                iziToast.error({
                    title: 'Error',
                    position: 'topRight',
                    message: 'Please enter a valid 4-digit OTP.'
                });
                return;
            }

            // Disable the OTP button and change text
            $('#verify_otp_btn').prop('disabled', true).text('Verifying OTP...');

            $.ajax({
                url: "{{ route('verify-login-otp') }}",
                type: 'POST',
                data: {
                    otp: otp,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    // Re-enable the button and reset text
                    $('#verify_otp_btn').prop('disabled', false).text('Verify OTP');
                    if (response.status === 'success') {
                        iziToast.success({
                            title: 'Success',
                            position: 'topRight',
                            message: response.message
                        });
                        setTimeout(() => {
                            window.location.href = "{{$redirectUrl}}";
                        }, 1000);
                    } else {
                        iziToast.error({
                            title: 'Error',
                            position: 'topRight',
                            message: response.message
                        });
                    }
                },
                error: function () {
                    // Re-enable the button and reset text
                    $('#verify_otp_btn').prop('disabled', false).text('Verify OTP');
                    iziToast.error({
                        title: 'Error',
                        position: 'topRight',
                        message: 'Failed to verify OTP. Please try again later.'
                    });
                }
            });
        });
    });
</script>
<script>
    // let main_btn = document.getElementById('main_btn');
    // let radio = document.getElementsByClassName('type_user');
    // Array.from(radio).forEach(element => {
    //     element.addEventListener('click',function(element){
    //         console.log(element.target.getAttribute("data-id"));
    //         main_btn.setAttribute("href", element.target.getAttribute("data-id"));
    //     })
    // });
</script>
@endpush