<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use App\Models\Coach;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\User;
use App\Models\Event;
use App\Models\Setting;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use GuzzleHttp\Client;

class AppUserController extends Controller
{
    public function index(Request $request)
    {
        $users = AppUser::OrderBy('id', 'DESC');
        if(!empty($request->search)){
            $users->orWhere('name','like','%'.$request->search.'%');
            $users->orWhere('email','like','%'.$request->search.'%');
            $users->orWhere('phone','like','%'.$request->search.'%');
        }
        $users = $users->paginate(50);
        return view('admin.appUser.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('app_user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.appUser.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|email|unique:app_user',
            'password' => 'bail|required|min:6',
        ]);
        $data = $request->all();
        $data['password'] =  Hash::make($request->password);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/upload');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        } else {
            $data['image'] = 'defaultuser.png';
        }
        $data['provider'] = 'LOCAL';
        $data['language'] = Setting::first()->language;
        $data['is_verify'] = 1;
        AppUser::create( $data);
        return redirect()->route('app-user.index')->withStatus(__('User is added successfully.'));
    }

    public function destroy(AppUser $appUser)
    {
        $appUser->delete();
        return true;
    }

    public function blockUser($id)
    {
        $user = AppUser::find($id);
        $user->status = $user->status == "1" ? "0" : "1";
        $user->save();
        return redirect()->route('app-user.index')->withStatus(__('User status changed successfully.'));
    }

    public function userDetail($id){
        (new AppHelper)->eventStatusChange();
        $user = AppUser::find($id);
        $following = array_filter(explode(',', $user->following));
        $user->following = User::whereIn('id', $following)->get();

        if (Auth::user()->hasRole('admin')) {
            $user->pending = Order::where([['customer_id', $user->id], ['order_status', 'Pending']])->orderBy('id', 'DESC')->count();
            $user->complete = Order::where([['customer_id', $user->id], ['order_status', 'Complete']])->orderBy('id', 'DESC')->count();
            $user->cancel = Order::where([['customer_id', $user->id], ['order_status', 'Cancel']])->orderBy('id', 'DESC')->count();
            $user->upcoming = Order::where([['customer_id', $user->id], ['order_status', 'Pending']])->orderBy('id', 'DESC')->get();
            $user->past = Order::where([['customer_id', $user->id], ['order_status', 'Complete']])
                ->orWhere([['customer_id', $user->id], ['order_status', 'Cancel']])
                ->orderBy('id', 'DESC')->get();
        } elseif (Auth::user()->hasRole('Organizer')) {
            $user->pending = Order::where([['customer_id', $user->id], ['organization_id', Auth::user()->id], ['order_status', 'Pending']])->orderBy('id', 'DESC')->count();
            $user->complete = Order::where([['customer_id', $user->id], ['organization_id', Auth::user()->id], ['order_status', 'Complete']])->orderBy('id', 'DESC')->count();
            $user->cancel = Order::where([['customer_id', $user->id], ['organization_id', Auth::user()->id], ['order_status', 'Cancel']])->orderBy('id', 'DESC')->count();
            $user->upcoming = Order::where([['customer_id', $user->id], ['organization_id', Auth::user()->id], ['order_status', 'Pending']])->orderBy('id', 'DESC')->get();
            $user->past = Order::where([['customer_id', $user->id], ['organization_id', Auth::user()->id], ['order_status', 'Complete']])
                ->orWhere([['customer_id', $user->id], ['organization_id', Auth::user()->id], ['order_status', 'Cancel']])
                ->orderBy('id', 'DESC')->get();
        }

        return view('admin.appUser.view', compact('user'));
    }

    public function searchAllEvents(Request $request){
        $search = $request->search_str;
        $searchStr = str_replace("_"," ",$search);

        $coaches = [];
        // $coaches = Coach::has('coachingPackage')->where('is_active', Coach::ACTIVE);
        if(!empty($search)){
            $coaches = $this->searchEvent($searchStr);  
        }

        $str = '';
        foreach($coaches as $val){
            $url = route('tournament-detail',[\Str::slug($val['event_title']),$val['event_id']]);
            $str .= '<a href="'.$url.'" class="list-group-item">'.$val['event_title'].'<br>'.$val['event_place_name'].'</a>';
        }
        echo $str;
    }

    public function searchEvent($keyword){
        try {
            // Instantiate the Guzzle client
            $client = new Client();

            // Prepare the data to send in the request body
            $data = [
                'keyword' => $keyword
            ];

            // Send POST request to the PHP admin panel API with the data in the body
            $baseUrl = env('BACKEND_BASE_URL');
            $response = $client->post("{$baseUrl}/web_api/event_search.php", [
                'json' => $data,  // Use the 'json' option to send data as JSON in the request body
            ]);
            // Decode the JSON response
            $responseData = json_decode($response->getBody(), true);

            // Return the HomeData from the response
            return $responseData['SearchData'];
        } catch (\Throwable $th) {
           return [];
        }
           
    }
}
