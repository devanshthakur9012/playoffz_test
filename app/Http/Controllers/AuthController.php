<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AppUser;
use App\Models\CoachingPackageBooking;
use App\Models\Order;
use Session;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function userLogin(){
        if(\Auth::guard('appuser')->check()==true || \Auth::check()==true){
            return redirect('/');
        }
        return view('frontend.auth.user-login');
    }

    public function organizerLogin(){
        if(\Auth::check()==true){
            return redirect('/dashboard');
        }
        return view('frontend.auth.organizer-login');
    }

    public function userRegister(){
        if(\Auth::guard('appuser')->check()==true || \Auth::check()==true){
            return redirect('/');
        }
        return view('frontend.auth.user-register');
    }

    public function verifyUserData(Request $request)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'mobile' => 'required',
                'email' => 'required|email',
                'ccode' => 'required',
                'full_name' => 'required',
                'password' => 'required',
                'referral_code' => 'required',
            ]);
    
            // Get the input data
            $mobile = $request->mobile;
            $email = $request->email;
            $ccode = $request->ccode;
            $referral_code = $request->referral_code;
    
            // Instantiate the Guzzle client
            $client = new Client();
    
            // Prepare the data to send in the request body
            $data = [
                'mobile' => $mobile,
                'ccode' => $ccode,
                'email' => $email,
                'referral_code' => $referral_code,
            ];
    
            // Send POST request to the PHP admin panel API
            $baseUrl = env('BACKEND_BASE_URL'); // Make sure this is set in your .env file
            $response = $client->post("{$baseUrl}/web_api/valid_user_detail.php", [
                'json' => $data,  // Use the 'json' option to send data as JSON in the request body
            ]);

            dd($response);
    
            // Decode the JSON response from the PHP API
            $responseData = json_decode($response->getBody(), true);
    
            // Check the response and handle accordingly
            if ($responseData['ResponseCode'] === '200') {

                // Call sendOTP function to send OTP
                // $is_otpSend = $this->sendOTP($mobile);
                // if ($is_otpSend) {
                //     // Success - New Number, OTP sent
                //     return response()->json([
                //         'status' => 'success',
                //         'message' => $responseData['ResponseMsg']
                //     ]);
                // }
                
                // If OTP is not sent successfully, return error message
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to send OTP. Please try again later.'
                ], 500);

            } else {
                // Error - Mobile or Email already used
                return response()->json([
                    'status' => 'error',
                    'message' => $responseData['ResponseMsg'], // Error message from the PHP API
                ]);
            }
        } catch (\Throwable $th) {
            // Log the error for debugging purposes
            Log::error('Error verifying user data: ' . $th->getMessage());
    
            // Return a generic error message
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again later. '.$th->getMessage(),
            ], 500);
        }
    }

    public function sendOTP($mobile)
    {
        try {
            // Start the session to store OTP
            session_start();
    
            // Instantiate the Guzzle client
            $client = new Client();
        
            // Prepare the data to send in the request body
            $data = [
                'mobile' => $mobile,
            ];
    
            // Send POST request to the PHP admin panel API
            $baseUrl = env('BACKEND_BASE_URL'); // Make sure this is set in your .env file
            $response = $client->post("{$baseUrl}/web_api/msg_otp.php", [
                'json' => $data,  // Use the 'json' option to send data as JSON in the request body
            ]);
        
            // Decode the JSON response from the PHP API
            $responseData = json_decode($response->getBody(), true);
        
            // Check if OTP was sent successfully
            if (isset($responseData['ResponseCode']) && $responseData['ResponseCode'] === '200') {
                // OTP was sent successfully, get the OTP from the response
                $otp = $responseData['otp'];
    
                // Store the OTP in the session
                Session::put('otp', $otp);
                
                // Return true if OTP sent successfully
                return true;
            } else {
                // Return false if OTP wasn't sent
                return false;
            }
        } catch (\Throwable $th) {
            // Log the error for debugging purposes
            Log::error('Error sending OTP: ' . $th->getMessage());
        
            // Return false if an error occurs while sending OTP
            return false;
        }
    }

    public function verifyOTP(Request $request)
    {
        try {
            // Validate the incoming request to make sure OTP is provided
            $request->validate([
                'otp' => 'required|numeric|digits:4',  // Ensure the OTP is a 4-digit number
            ]);
            
            // Get the OTP entered by the user
            $enteredOtp = $request->input('otp');

            // Retrieve the OTP stored in the session
            $storedOtp = Session::get('otp');

            // Check if the OTP is valid and matches
            if ($enteredOtp == $storedOtp) {
                // OTP is valid
                // You can add additional logic here (e.g., mark the user as verified or proceed with registration)
                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP verified successfully.',
                ]);
            } else {
                // OTP is incorrect
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid OTP. Please try again.',
                ], 400);  // 400 is for client errors
            }
        } catch (\Throwable $th) {
            // Log the error for debugging purposes
            Log::error('Error verifying OTP: ' . $th->getMessage());

            // Return a generic error message
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.',
            ], 500);  // 500 is for server errors
        }
    }

    public function postUserRegister(Request $request){
        $request->validate([
            'full_name'=>'required|max:225',
            'email'=>'required|email',
            'mobile_number'=>'required|numeric',
            'password'=>'required|min:5',
            'referral_code'=>'nullable|max:225',
        ]);

        dd($request->all());

        $data = $request->all();
        $data['name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['password'] = \Hash::make($request->password);
        $data['address'] = $request->address_one;
        $data['address_two'] = $request->address_two;
        $data['image'] = "defaultuser.png";
        $data['status'] = 1;
        $data['provider'] = "LOCAL";
        $data['language'] = 'English';
        $data['phone'] = $request->mobile_number;
        $data['is_verify'] = 1;
        $data['logintype'] = $request->logintype;
        if ($data['logintype'] == 2) {
            $checkEmail = User::where('email',$request->email)->count();
            if($checkEmail){
                return redirect()->back()->with('warning','Email already exist or registered with us..Please login to continue');
            }
            $user = User::create($data);
            $user->assignRole('Organizer');
            return redirect()->back()->with('success','Congratulations! Your account registration was successful. You can log in to your account')->withInput($request->input());
        } else {
            $checkEmail = AppUser::where('email',$request->email)->count();
            if($checkEmail){
                return redirect()->back()->with('warning','Email already exist or registered with us..Please login to continue')->withInput($request->input());
            }
            $user = AppUser::create($data);
            \Auth::guard('appuser')->login($user);
            return redirect('/');
        }
    }

    // public function checkUserLogin(Request $request){
    //     $request->validate([
    //         'email' => 'bail|required|email',
    //         'password' => 'bail|required',
    //     ]);

    //     $userdata = array(
    //         'email' => $request->email,
    //         'password' => $request->password,
    //         'status'=>1
    //     );
    //     $remember = $request->get('remember_me');
    //     if ($request->logintype == '1') {
    //         if (\Auth::guard('appuser')->attempt($userdata, $remember)) {
    //             if(Session::has('LAST_URL_VISITED')){
    //                 $redirectLink = Session::get('LAST_URL_VISITED');
    //                 return redirect($redirectLink);
    //             }
    //             return redirect('/');
    //         } else {
    //             return \Redirect::back()->with('warning', 'Invalid Username or Password.');
    //         }
    //     }else{
    //         if (\Auth::attempt($userdata, $remember)) {
    //             return redirect('/dashboard');
    //         } else {
    //             return \Redirect::back()->with('warning', 'Invalid Username or Password.');
    //         }
    //     }
    // }

    public function checkUserLogin(Request $request){
        $request->validate([
            'phonenumber' => 'bail|required|number',
            'password' => 'bail|required',
        ]);
    }


    public function checkOrganizerLogin(Request $request){
        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required',
        ]);

        $userdata = array(
            'email' => $request->email,
            'password' => $request->password,
            'status'=>1
        );
        $remember = $request->get('remember_me');
        if (\Auth::attempt($userdata, $remember)) {
            return redirect('/dashboard');
        } else {
            return \Redirect::back()->with('warning', 'Invalid Username or Password.');
        }
    }


    public function logoutUser(){
        \Auth::guard('appuser')->logout();
        \Auth::logout();
        return redirect('/');
    }

    public function myTickets(){
        $userId = \Auth::guard('appuser')->user()->id;
        $ticketData = CoachingPackageBooking::whereHas('coachingPackage')->with(['coachingPackage' => function($query){
            $query->whereHas('coaching')->with('coaching');
        }])->where(['user_id' => $userId, 'is_active' => CoachingPackageBooking::STATUS_ACTIVE])->paginate(50);
        
        return view("frontend.auth.my-tickets",compact('ticketData'));
    }

    public function myProfile(){
        return view("frontend.auth.my-profile");
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);
        $userId = \Auth::guard('appuser')->user()->id;
        AppUser::where('id',$userId)->update(
            [
                'name'=>$request->name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'address'=>$request->address,
                'address_two'=>$request->address_two,
                'phone'=>$request->phone,
            ]
        );
        return redirect()->back()->with('success','Profile details updated successfully!!');
    }

    public function accountSettings(){
        return view("frontend.auth.account-settings");
    }

    public function updateUserPassword(Request $request){
        $request->validate([
            'password'=>'required',
            'confirm_password'=>'required',
        ]);
        $userId = \Auth::guard('appuser')->user()->id;
        AppUser::where('id',$userId)->update(['password'=>\Hash::make($request->password)]);
        return redirect()->back()->with('success','Password updated successfully!!');
    }

    public function organizerRegsiter(){
        if(\Auth::check()==true){
            return redirect('/');
        }
        return view('frontend.auth.organizer-register');
    }

    public function postOrganizerRegister(Request $request){
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'max:255',
            'email'=>'required|email',
            'mobile_number'=>'required|numeric',
            'password'=>'required|min:5',
            // 'address_one'=>'required'
        ]);

        // dd($request->all());
        $data = $request->all();
        $data['name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['password'] = \Hash::make($request->password);
        $data['address'] = null;
        $data['address_two'] = null;
        $data['image'] = "defaultuser.png";
        $data['status'] = 1;
        $data['provider'] = "LOCAL";
        $data['language'] = 'English';
        $data['phone'] = $request->mobile_number;
        $data['is_verify'] = 1;
        $data['logintype'] = 2;
        // if ($data['logintype'] == 2) {
            $checkEmail = User::where('email',$request->email)->count();
            if($checkEmail){
                return redirect()->back()->with('warning','Email already exist or registered with us..Please login to continue');
            }
            $user = User::create($data);
            $user->assignRole('Organizer');
            return redirect()->back()->with('success','Congratulations! Your account registration was successful. You can log in to your account')->withInput($request->input());
        // } else {
        //     $checkEmail = AppUser::where('email',$request->email)->count();
        //     if($checkEmail){
        //         return redirect()->back()->with('warning','Email already exist or registered with us..Please login to continue')->withInput($request->input());
        //     }
        //     $user = AppUser::create($data);
        //     \Auth::guard('appuser')->login($user);
        //     return redirect('/');
        // }
    }

  
}
