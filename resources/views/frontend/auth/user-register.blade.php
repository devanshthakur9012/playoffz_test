@extends('frontend.master', ['activePage' => 'register'])
@section('title', __('Register'))
@section('content')
<section class="section-area login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card o-hidden  shadow-sm border-0  ">
                    <div class="card-body p-0">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                            @if(Session::has('success'))
                                <div class="text-center mb-3">
                                <img src="{{asset('images/checked.png')}}" alt="" class="img-fluid" style="height: 150px;">
                                <h5 class="mt-3">Approval Pending</h5>
                            </div>
                            @endif
                            @include('messages')
                            @if(!Session::has('success'))
                                <div class="p-lg-5 p-3">
                                    <div class="text-center">
                                    </div>
                                    <div class="text-center">
                                        <h1 class="h3 mb-4">Create An Account</h1>
                                        <p class="ot_err text-danger text-left"></p>
                                    </div>
                                    <form class="user" method="post" name="register_frm" id="register_frm"> 
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                            <input type="text" name="full_name" class="form-control form-control-user" value="{{old('full_name')}}" id="full_name" placeholder="Enter Name">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control form-control-user" value="{{old('email')}}" name="email" id="email" placeholder="Enter Email Adress">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Mobile Number <span class="text-danger">*</span> <span style="font-size:10px;" class="text-muted">10 digit mobile number</span></label>
                                            <input type="number" class="form-control form-control-user" value="{{old('mobile_number')}}" id="mobile_number" name="mobile_number" placeholder="Enter Mobile number">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control form-control-user" id="password" autocomplete="new-password" name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Referral Code (Optional)</label>
                                            <input type="text" class="form-control form-control-user" value="{{old('referral_code')}}" name="referral_code" id="referral_code" placeholder="Enter Referral Code">
                                        </div>
                                        <div class="form-group">
                                            <div id="recaptcha-container" class="mb-3"></div>
                                        </div>
                                        <button type="submit" id="continue_btn" class="btn default-btn btn-user btn-block">
                                            Register
                                        </button>
                                    </form>
                                    <div class="mt-4" id="otp_frm" style="display: none;">
                                        <p>Enter OTP sent to your mobile number</p>
                                        <div class="form-group">
                                            <label class="form-label">OTP (One Time Password) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-user" id="otp_password" placeholder="OTP">
                                        </div>
                                        <button type="button" onclick="verify()" id="verify_btn" class="btn default-btn btn-user btn-block">
                                            Continue
                                        </button>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <a href="{{url('user-login')}}">Already have an account, <b>Login</b> here</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="{{ url('frontend/js/jquery.validate.min.js') }}"></script>
{{-- <script> 
    $("#register_frm").validate({
        rules: {
            first_name:{required:true,maxlength:225},
            referral_code:{maxlength:225},
            email:{required:true,email:true},
            password:{required:true,minlength:5},
        },
        messages: {
            mobile_number:{minlength:'Enter valid 10 digit mobile number', maxlength:'Enter valid 10 digit mobile number'}
        },
        errorElement: 'div',
        highlight: function(element, errorClass) {
            $(element).css({ border: '1px solid #f00' });
        },
        unhighlight: function(element, errorClass) {
            $(element).css({ border: '1px solid #c1c1c1' });
        },
        submitHandler: function(form,event) {
            event.preventDefault();
            $("#continue_btn").attr('disabled','disabled').text('Generating OTP...');
            sendOtpToMobile();
        }
    });
</script> --}}

<script>
    // Your validation rules and messages
    $("#register_frm").validate({
        rules: {
            full_name: { required: true, maxlength: 225 },
            email: { required: true, email: true },
            mobile_number: { required: true, minlength: 10, maxlength: 10 },
            password: { required: true, minlength: 5 }
        },
        messages: {
            mobile_number: { minlength: 'Enter valid 10 digit mobile number', maxlength: 'Enter valid 10 digit mobile number' },
            email: { required: 'Email is required', email: 'Enter a valid email address' },
            full_name: { required: 'Full Name is required' },
            password: { required: 'Password is required' }
        },
        errorElement: 'div',
        highlight: function(element, errorClass) {
            $(element).css({ border: '1px solid #f00' });
        },
        unhighlight: function(element, errorClass) {
            $(element).css({ border: '1px solid #c1c1c1' });
        },
        submitHandler: function(form, event) {
            event.preventDefault(); // Prevent form submission until API check

            // Get the mobile number and email values from the form
            var mobile_number = $('#mobile_number').val();
            var email = $('#email').val();

            // Check mobile and email via AJAX
            $.ajax({
                url: "{{route('verify-details')}}", 
                type: 'POST',
                data: {
                    mobile: mobile_number,
                    email: email,
                    ccode: '+91',
                    _token: "{{ csrf_token() }}"  // Pass CSRF token directly
                },
                success: function(response) {
                    if (response.ResponseCode == '401') {
                        // If mobile or email is already used, show error message
                        alert(response.ResponseMsg); // Or display it in a more user-friendly way
                    } else {
                        // If no issue, proceed with form submission
                        $("#continue_btn").attr('disabled', 'disabled').text('Generating OTP...');
                        // sendOtpToMobile();
                    }
                },
                error: function(xhr, status, error) {
                    alert('There was an error while checking. Please try again.');
                }
            });
        }
    });
</script>
@endpush