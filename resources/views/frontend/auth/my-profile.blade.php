@extends('frontend.master', ['activePage' => 'My Profile'])
@section('title', __('My Profile'))
@push('styles')
    <style>
        .profile-area {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
            padding: 50px 0;
        }
        
        .profile-card {
            /* background: rgba(255, 255, 255, 0.05); */
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            /* box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2); */
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .profile-header {
            padding: 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .profile-title {
            color: #fff;
            font-weight: 600;
            margin: 0;
            font-size: 1.5rem;
        }
        
        .profile-content {
            padding: 25px;
        }
        
        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }
        
        .form-control {
            background-color: rgb(23 31 57);
            border: 1px solid rgb(0 74 173);
            color: #fff;
            height: 45px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            color: #fff;
            box-shadow: 0 0 0 0.2rem rgba(100, 149, 237, 0.25);
        }
        
        .form-control:disabled, .form-control[readonly] {
            background-color: rgba(255, 255, 255, 0.05);
            color: #b0b0b0 !important;
        }
        
        label {
            color: #ffffff;
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #004aad, #032472);
            border: none;
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 210, 255, 0.3);
            background: linear-gradient(45deg, #004aad, #032472);
        }
        
        .divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 20px 0;
        }
        
        .file-upload-wrapper {
            display:flex;
            justify-content: center;
            position: relative;
            margin-bottom: 20px;
        }
        
        .file-upload-label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .file-upload-icon {
            font-size: 24px;
            margin-right: 10px;
            color: #00d2ff;
        }
        
        .file-upload-text {
            color: #fff;
            font-size: 14px;
        }
        
        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        .validation-error {
            color: #ff6b6b;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
@endpush
@section('content')
    <section class="profile-area section-area">
        <div class="container list-bp">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    @include('messages')
                    <div class="profile-card mb-5">
                        <div class="profile-header">
                            <h1 class="profile-title">
                                <i class="fas fa-user-circle mr-2"></i>My Profile
                            </h1>
                        </div>
                        <div class="profile-content">
                            @php
                                $userData = Common::fetchUserDetails();
                            @endphp
                            <form name="register_frm" id="register_frm" action="{{ url('user/update-profile') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                
                                <div class="mb-4 text-center">
                                    @isset($userData['pro_pic'])
                                        <img id="profile-avatar" src="{{env('BACKEND_BASE_URL')}}/{{$userData['pro_pic']}}" alt="Profile Picture" class="profile-avatar">
                                    @else
                                        <div id="default-avatar" class="profile-avatar bg-secondary d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user fa-3x text-light"></i>
                                        </div>
                                    @endisset
                                    
                                    <div class="file-upload-wrapper">
                                        <label class="file-upload-label">
                                            <i class="fas fa-camera file-upload-icon"></i>
                                            <span class="file-upload-text">Change Profile Picture</span>
                                            <input id="image" type="file" class="file-upload-input" name="image" accept="image/*">
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="username">Username <span class="text-danger">*</span></label>
                                            <input id="username" type="text" class="form-control" placeholder="Username" name="username" value="{{ $userData['name'] }}">
                                            <div class="validation-error" id="username-error"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="email">Email Address <span class="text-danger">*</span></label>
                                            <input id="email" type="email" class="form-control" placeholder="Enter Email" name="email" value="{{ $userData['email'] }}">
                                            <div class="validation-error" id="email-error"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="phone">Contact No. <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-transparent text-white form-control">+91</span>
                                                </div>
                                                <input id="phone" type="text" class="form-control" placeholder="Enter Mobile Number" name="phone" value="{{ $userData['mobile'] }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input id="password" type="password" class="form-control" placeholder="Leave blank to keep current" name="password">
                                            <div class="validation-error" id="password-error"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input id="confirm_password" type="password" class="form-control" placeholder="Confirm your password" name="confirm_password">
                                            <div class="validation-error" id="confirm_password-error"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 text-center mt-0">
                                        <button type="submit" id="continue_btn" class="btn btn-primary btn-lg px-5">
                                            <i class="fas fa-save mr-2"></i>Update Profile
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ url('frontend/js/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Preview image before upload
            $("#image").change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                        // Hide default avatar if it exists
                        $('#default-avatar').hide();
                        
                        // Create image element if it doesn't exist
                        if ($('#profile-avatar').length === 0) {
                            $('.text-center').prepend('<img id="profile-avatar" class="profile-avatar" alt="Profile Picture">');
                        }
                        
                        // Set the new image source
                        $('#profile-avatar').attr('src', e.target.result).show();
                        
                        // Add animation effect
                        $('#profile-avatar').css({
                            'opacity': '0.8'
                        }).animate({
                            'opacity': '1'
                        }, 200);
                    }
                    
                    reader.readAsDataURL(this.files[0]);
                    
                    // Show file name
                    var fileName = $(this).val().split('\\').pop();
                    $('.file-upload-text').text(fileName);
                }
            });
            
            
            // Form validation
            $("#register_frm").validate({
                rules: {
                    username: {
                        required: true,
                        maxlength: 40
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        minlength: 6
                    },
                    confirm_password: {
                        equalTo: "#password"
                    }
                },
                messages: {
                    username: {
                        required: "Please enter your username",
                        maxlength: "Username cannot be longer than 40 characters"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        minlength: "Password must be at least 6 characters long"
                    },
                    confirm_password: {
                        equalTo: "Passwords do not match"
                    }
                },
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    error.appendTo(element.parent().find('.validation-error'));
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                    $(element).css({
                        'border-color': '#ff6b6b',
                        'box-shadow': '0 0 0 0.2rem rgba(255, 107, 107, 0.25)'
                    });
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                    $(element).css({
                        'border-color': 'rgb(0 74 173)',
                        'box-shadow': 'none'
                    });
                },
                submitHandler: function(form) {
                    $("#continue_btn").attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-spin mr-2"></i> Updating...');
                    form.submit();
                }
            });
        });
    </script>
@endpush