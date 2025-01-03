<?php

namespace App\Http\Controllers;

use App\Helpers\Common;
use App\Models\AppUser;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\CoachingPackage;
use App\Models\CoachingPackageBooking;
use App\Models\Popups;
use App\Models\User;
use App\Models\WhatsappSubscriber;
use App\Services\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use stdClass;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function index()
    {
        $selectedCity = Session::has('CURR_CITY') ? Session::get('CURR_CITY') : 'All';
        if($selectedCity != 'All'){
            $data['popup'] = Popups::Where('city', $selectedCity)->orderBy('id','DESC')->first();
        }else{
            $data['popup'] = "";
        }
        
        $data['blog'] = HomeService::allBlogs();
        $data['banner'] = HomeService::allHomeBanners();
        $data['products'] = HomeService::allProducts();
        $categories = Category::whereHas('coachings', function ($query) use($selectedCity){
            if($selectedCity != 'All'){
                $query->where('venue_city',$selectedCity);
            }
            $query->whereHas('coachingPackage');
        })->get()->toArray();
        $categoriesIds = [0];
        if(count($categories)){
            $categoriesIds = array_column($categories, 'id');
        }
        $data['coachingsData'] = HomeService::getCoachingDataByCityWithCategory($categoriesIds, $selectedCity);
        if (!\Session::has('CURR_CITY')) {
            \Session::put('CURR_CITY', 'Bengaluru');
        }
        $data['tournament'] = $this->homeDataApi();
        // dd(Common::fetchLocation());
        return view('home.index', $data);
    }

    public function tournamentType($type){
        $data['category'] = $type;
        $data['category_tournament'] = $this->getTournamentByType($type);
        return view('home.coachings', $data);
    }

    public function helpCenter(){
        $faq = $this->fetchHelpCenterApi();
        return view('frontend.faq',compact('faq'));
    }

    
    private function fetchHelpCenterApi(){
        try {
            // Instantiate the Guzzle client
            $client = new Client();

            // Prepare the data to send in the request body
            $data = [
                "uid"=>0,
            ];

            // Send POST request to the PHP admin panel API with the data in the body
            $baseUrl = env('BACKEND_BASE_URL');
            $response = $client->post("{$baseUrl}/web_api/faq.php", [
                'json' => $data,  // Use the 'json' option to send data as JSON in the request body
            ]);
            // Decode the JSON response
            $responseData = json_decode($response->getBody(), true);
            if($responseData['Result'] == true || $responseData['Result'] == "true"){
                // Return the HomeData from the response
                return $responseData['FaqData'];
            }
            return [];
        } catch (\Throwable $th) {
           return [];
        }
    }

    public function myBooking($status){
        $myBooing = $this->fetchMyBookingApi($status);
        // dd($myBooing);
        return view('frontend.my-booking',compact('myBooing','status'));
    }

    private function fetchMyBookingApi($status){
        try {
            // Instantiate the Guzzle client
            $client = new Client();

            $user = Common::userId();
            // Prepare the data to send in the request body
            $data = [
                "uid"=>$user,
                "status"=>$status
            ];

            // Send POST request to the PHP admin panel API with the data in the body
            $baseUrl = env('BACKEND_BASE_URL');
            $response = $client->post("{$baseUrl}/web_api/ticket_status.php", [
                'json' => $data,  // Use the 'json' option to send data as JSON in the request body
            ]);
            // Decode the JSON response
            $responseData = json_decode($response->getBody(), true);
            if($responseData['Result'] == true || $responseData['Result'] == "true"){
                // Return the HomeData from the response
                return $responseData['order_data'];
            }
            return [];
        } catch (\Throwable $th) {
           return [];
        }
    }

    public function getTournamentByType($type){
        try {
            // Instantiate the Guzzle client
            $client = new Client();

            $city = \Session::get('CURR_CITY', 'Bengaluru');

            // Prepare the data to send in the request body
            $data = [
                "city"=>$city,
                "type"=>$type
            ];

            // Send POST request to the PHP admin panel API with the data in the body
            $baseUrl = env('BACKEND_BASE_URL');
            $response = $client->post("{$baseUrl}/web_api/event_type_data.php", [
                'json' => $data,  // Use the 'json' option to send data as JSON in the request body
            ]);
            // Decode the JSON response
            $responseData = json_decode($response->getBody(), true);
            if($responseData['Result'] == true || $responseData['Result'] == "true"){
                // Return the HomeData from the response
                return $responseData['Events'];
            }
            return [];
        } catch (\Throwable $th) {
           return [];
        }
    }
    
 
    public function homeDataApi($uid=0,$lats =0,$longs =0)
    {
        // Caching the response for 10 minutes
        // $homeData = \Cache::remember('home-data', 10, function() use($uid,$lats,$longs){
            // Instantiate the Guzzle client
            $client = new Client();

            $city = \Session::get('CURR_CITY', 'Bengaluru');
            // Prepare the data to send in the request body
            $data = [
                'uid' => $uid,
                'lats' => $lats,
                'longs' => $longs,
                'city'=> $city,
            ];

            // Send POST request to the PHP admin panel API with the data in the body
            $baseUrl = env('BACKEND_BASE_URL');
            $response = $client->post("{$baseUrl}/web_api/home_data.php", [
                'json' => $data,  // Use the 'json' option to send data as JSON in the request body
            ]);
            // Decode the JSON response
            $responseData = json_decode($response->getBody(), true);

            if($responseData['ResponseCode'] == 200){
                // Return the HomeData from the response
                return $responseData['HomeData'];
            }
            // Return the HomeData from the response
            return [];
        // });

        // Return the cached or fetched home data
        // return $homeData;
    }

    public function coachingBook(string $title,int $id)
    {
        $selectedCity = Session::has('CURR_CITY') ? Session::get('CURR_CITY') : 'All';
        // $data['coachData'] = HomeService::coachingBookDataById($id);
        // $sessionDurationData = json_decode($data['coachData']->session_duration, true);
        // $data['sessionDurationData'] = $sessionDurationData;
        // $data['relatedCoaching'] = HomeService::getRelateCoachingData($id, $selectedCity, $data['coachData']->category->id);
        $data['isTicketSoldAvailable'] = HomeService::checkedIfTicketSoldOut($id);
        
        $inputObj = new stdClass();
        $inputObj->params = 'coach_id='.$id;
        $inputObj->url = route('coaching-packages');
        $data['packageLink'] = Common::encryptLink($inputObj);

        $user = Common::userId();
        $details = $this->getTournamentDetails($user,$id);
        $data['tournament_detail'] = $details['EventData'];
        $data['tournament_detail']['category'] = $details['category'];
        $data['tournament_gallery'] = $details['Event_gallery'];
        $data['tournament_Artist'] = $details['Event_Artist'];
        $data['tournament_Facility'] = $details['Event_Facility'];
        $data['tournament_Restriction'] = $details['Event_Restriction'];
        $data['tournament_reviewdata'] = $details['reviewdata'];
        $data['related_tournament'] = $details['related'];

        // $pageUrl = route('tournament-detail', ['title' => $title, 'id' => $id]);
        // $qrCodePath = public_path('qrcodes/tournament-' . $id . '.png');
        // \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')
        //     ->size(150) // Set the size of the QR code
        //     ->margin(0) // Minimize padding
        //     ->generate($pageUrl, $qrCodePath);
        // $data['qrCodePath'] = asset('qrcodes/tournament-' . $id . '.png'); // Public URL for sharing   
        
        
        // Use the title to create a more descriptive QR code file name
        $sanitizedTitle = preg_replace('/[^A-Za-z0-9\-]/', '_', $title); // Sanitize the title for use in filenames
        $qrCodeFileName = 'tournament-' . $sanitizedTitle . '-' . $id . '.png';
        $qrCodePath = public_path('qrcodes/' . $qrCodeFileName);
        
        // Check if the QR code already exists
        if (!file_exists($qrCodePath)) {
            \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')
                ->size(150) // Set the size of the QR code
                ->margin(0) // Minimize padding
                ->generate(route('tournament-detail', ['title' => $title, 'id' => $id]), $qrCodePath); // Generate and store the QR code
        }
        
        // Return the public URL for the cached QR code
        $data['qrCodePath'] = asset('qrcodes/' . $qrCodeFileName);

        return view('home.coaching-book', $data);
    }

    public function getTournamentDetails($userId, $eventId){
        try {
            // Instantiate the Guzzle client
            $client = new Client();

            // Prepare the data to send in the request body
            $data = [
                "uid"=>$userId,
                "event_id"=>$eventId
            ];

            // Send POST request to the PHP admin panel API with the data in the body
            $baseUrl = env('BACKEND_BASE_URL');
            $response = $client->post("{$baseUrl}/web_api/event_detail.php", [
                'json' => $data,  // Use the 'json' option to send data as JSON in the request body
            ]);
            // Decode the JSON response
            $responseData = json_decode($response->getBody(), true);

            // Return the HomeData from the response
            return $responseData;
        } catch (\Throwable $th) {
           return [];
        }
    }

    public function cityCoachings($cityName){
        $coachData = HomeService::getCoachingDataByCity($cityName);
        $data['cityName'] = $cityName;
        $data['coachingData'] = $coachData;
        return view('home.city-coachings', $data);
    }


    public function coachingPackages(){
        $coachingId = $this->memberObj['coach_id'];
        $data['coachData'] = HomeService::coachingBookDataById($coachingId);
        $data['packageData'] = HomeService::getCoachingPackagesDataByCoachId($coachingId);
        $availableData = HomeService::checkedIfTicketSoldOut($coachingId);
        if($availableData < 1){
            return redirect('/');
        }
        
        $data['tour_plans'] = $this->coachingPrice($coachingId);
        $data['coaching_id'] = $coachingId;
        return view('home.coaching-package', $data);
    }

    public function pagesData($slug){
        $pages = Common::pageListData();
        $page = null;
        foreach ($pages as $p) {
            if ($p['slug'] == $slug) {
                $page = $p;
                break;
            }
        }

        if (!$page) {
            abort(404); // Handle case where page is not found
        }
        return view('frontend.terms-and-conditions', ['page' => $page]); // Pass single page data
    }

    public function coachingPrice($event_id){
        try {
            // Instantiate the Guzzle client
            $client = new Client();

            // Prepare the data to send in the request body
            $data = [
                'event_id' => $event_id
            ];

            // Send POST request to the PHP admin panel API with the data in the body
            $baseUrl = env('BACKEND_BASE_URL');
            $response = $client->post("{$baseUrl}/web_api/u_event_type_price.php", [
                'json' => $data,  // Use the 'json' option to send data as JSON in the request body
            ]);
            // Decode the JSON response
            $responseData = json_decode($response->getBody(), true);

            // Return the HomeData from the response
            return $responseData['EventTypePrice'];
        } catch (\Throwable $th) {
           return [];
        }
    }

    public function coachings($category, $Id)
    {
        $selectedCity = Session::has('CURR_CITY') ? Session::get('CURR_CITY') : 'All';
        $coachData = HomeService::getCoachingDataByCateoryId($selectedCity, $Id);
        $data['coachingData'] = $coachData['coachesData'];
        $data['categoryData'] = $coachData['categoryData'];

        $data['category_tournament'] = $this->getCatgeoryData($Id);
        $data['category'] = $category;
        return view('home.coachings', $data);
    }

    public function getCatgeoryData($catId){
        try {
            // Instantiate the Guzzle client
            $client = new Client();

            $city = \Session::get('CURR_CITY', 'Bengaluru');

            // Prepare the data to send in the request body
            $data = [
                'cat_id' => $catId,
                'city'=>$city
            ];

            // Send POST request to the PHP admin panel API with the data in the body
            $baseUrl = env('BACKEND_BASE_URL');
            $response = $client->post("{$baseUrl}/web_api/cat_event.php", [
                'json' => $data,  // Use the 'json' option to send data as JSON in the request body
            ]);
            // Decode the JSON response
            $responseData = json_decode($response->getBody(), true);

            // Return the HomeData from the response
            return $responseData['CatEventData'];
        } catch (\Throwable $th) {
           return [];
        }
    }

    public function bookCoachingPackage()
    {
        $packageId = $this->memberObj['id'];
        $data['coachingData'] = HomeService::getCoachingDataByPackage($packageId);
        if($data['coachingData']->is_sold_out == 1){
            return redirect('/');
        }

        $inputObj = new stdClass();
        $inputObj->params = 'id='.$packageId;
        $inputObj->url = url('store-book-coaching-package');
        $data['encLink'] = Common::encryptLink($inputObj);


        return view('home.book-coaching-package', $data);
    }

    public function get_curl_handle($razorpay_payment_id){
         $settingData = Common::paymentKeysAll();
         $url = 'https://api.razorpay.com/v1/payments/' . $razorpay_payment_id . '/capture';
         $key_id = $settingData->razorPublishKey;
         $key_secret = $settingData->razorSecretKey;
 
          $curl = curl_init();
 
         curl_setopt_array($curl, [
         CURLOPT_URL => "https://api.razorpay.com/v1/payments/".$razorpay_payment_id,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_USERPWD=>$key_id . ':' . $key_secret,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "GET",
         ]);
 
         return $curl;
     }

    public function storeBookCoachingPackage(Request $request)
    {
        $packageId = $this->memberObj['id'];
        $userId = Auth::guard('appuser')->check() ? Auth::guard('appuser')->user()->id : 0;
        $packageData = CoachingPackage::find($packageId);

        $realPrice = $packageData->package_price;
        $afterDiscountPrice = $packageData->package_price;
        if($packageData->discount_percent > 0 && $packageData->discount_percent <= 100){
            $perc = ($realPrice * $packageData->discount_percent) / 100;
            $afterDiscountPrice = round($realPrice - $perc, 2);
            $showDiscount = 1;
        }

        if($request->payment_method == 2){
           
            $orderId = CoachingPackageBooking::insertGetId([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'address' => 'NA',
                'booking_id' => $request->merchant_order_id,
                'transaction_id' => $request->merchant_trans_id,
                'coaching_package_id' => $packageId,
                'user_id' => $userId,
                'actual_amount' => round($afterDiscountPrice, 2),
                'paid_amount' => $request->merchant_total / 100,
                'expiry_date' => date("Y-m-d H:i:s", strtotime("+".$packageData->package_duration)),
                'is_active' => CoachingPackageBooking::STATUS_ACTIVE,
                'payment_type' => 2,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ]);
            
            if(!empty($request->whattsapp_subscribe)){
                WhatsappSubscriber::insert([
                    'phone_number'=>$request->mobile_number,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ]);
            }

            $inputObjB = new \stdClass();
            $inputObjB->url = url('booked-coaching-package-details');
            $inputObjB->params = 'package_booking_id='.$orderId;
            $subLink = Common::encryptLink($inputObjB);

            return redirect($subLink)->with('success','Ticket Booked Successfully...');
        }else{
            if(!empty($request->razorpay_payment_id) && !empty($request->merchant_order_id)){
                $razorpay_payment_id = $request->razorpay_payment_id;
                $merchant_order_id = $request->merchant_order_id;
                $success = false;
                $error = '';
                try{
                    $ch = $this->get_curl_handle($razorpay_payment_id);
                    $result = curl_exec($ch);
                    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    if ($result === false){
                        $success = false;
                        $error = 'Curl error: ' . curl_error($ch);
                    }else{
                        $response_array = json_decode($result, true);
                        if ($http_status === 200 and isset($response_array['error']) === false){
                            $success = true;
                        }else{
                            $success = false;
                            if (!empty($response_array['error']['code'])){
                                $error = $response_array['error']['code'] . ':' . $response_array['error']['description'];
                            }else{
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>' . $result;
                            }
                        }
                    }
                    curl_close($ch);
                }catch(\Exception $e){
                    $success = false;
                    $error = 'OPENCART_ERROR:Request to Razorpay Failed';
                }
                if ($success === true){
                   
                    $checkData = CoachingPackageBooking::select('id')->where(['coaching_package_id'=>$packageId,'transaction_id'=>$razorpay_payment_id])->first();
                    if(!$checkData){
                        $orderId = CoachingPackageBooking::insertGetId([
                            'full_name' => $request->full_name,
                            'email' => $request->email,
                            'mobile_number' => $request->mobile_number,
                            'address' => 'NA',
                            'booking_id' => $merchant_order_id,
                            'transaction_id' => $razorpay_payment_id,
                            'coaching_package_id' => $packageId,
                            'user_id' => $userId,
                            'actual_amount' => round($afterDiscountPrice, 2),
                            'paid_amount' => $request->merchant_total / 100,
                            'expiry_date' => date("Y-m-d H:i:s", strtotime("+".$packageData->package_duration)),
                            'is_active' => CoachingPackageBooking::STATUS_ACTIVE,
                            'payment_type' => 1,
                            'created_at'=>date("Y-m-d H:i:s"),
                            'updated_at'=>date("Y-m-d H:i:s")
                        ]);
                        
                        if(!empty($request->whattsapp_subscribe)){
                            WhatsappSubscriber::insert([
                                'phone_number'=>$request->mobile_number,
                                'created_at'=>date("Y-m-d H:i:s"),
                                'updated_at'=>date("Y-m-d H:i:s")
                            ]);
                        }
                      
                    }else{
                        $orderId = $checkData->id;
                    }
    
                    $inputObjB = new \stdClass();
                    $inputObjB->url = url('booked-coaching-package-details');
                    $inputObjB->params = 'package_booking_id='.$orderId;
                    $subLink = Common::encryptLink($inputObjB);
    
                    return redirect($subLink)->with('success','Ticket Booked Successfully...');
                }else{
                    echo "<h4>Something went wrong..Payment Failed... <a href='/'>GO BACK TO Home</a></h4>";
                    exit();
                }
            }else{
                echo "<h4>Something went wrong..Payment Failed... <a href='/'>GO BACK TO Home</a></h4>";
                    exit();
            }
        }

        
    }

    public function bookedCoachingPackageDetails()
    {
        $packageBookingId = $this->memberObj['package_booking_id'];
        $data['orderData'] = CoachingPackageBooking::with(['coachingPackage' => function($query){
            $query->with('coaching');
        }])->find($packageBookingId);
        $data['userData'] = User::find($data['orderData']->coachingPackage->coaching->organiser_id);
        // dd($data['userData']);
        return view('home.booked-coaching-package-details', $data);
    }
}
