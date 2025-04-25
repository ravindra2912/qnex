<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Hash;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    function showLoginForm(){
        return view('auth.login');
    }

    public function login_submit(Request $request)
    {
        $this->middleware('guest')->except('logout');
        $success = false;
        $message = __("messages.exception_error");
        $data = array();

        $validator = Validator::make($request->all(), [
            'email' => 'required|email:filter|max:100|exists:users',
            'password' => 'required|min:8|max:15',
        ]);

        if($validator->fails()){ // Validation fails
            $message = $validator->errors()->first();
        }
        else{
            if(auth()->attempt(array('email' => $request->email, 'password' => $request->password))){
                if(Auth::user()->role_id == "2" || Auth::user()->role_id == "1"){ // logged in user is seller
                    $success = true;
                    $message = __("messages.sign_in_success");
                    $data = array('redirect_url' => route('seller.dashboard'));
                }
                else{
                    $success = true;
                    $message = __("messages.sign_in_success");
					$data = array('redirect_url' => route('home'));
                }
            }
            else{
                $message = __('messages.invalid_credentials');
            }
        }

        return response()->json(['success' => $success, 'message' => $message, 'data' => $data]);
    }
	
	 public function register(Request $request){
        $this->middleware('guest')->except('logout');
        $success = false;
        $message = __("messages.exception_error");
        $data = array();
		
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'mobile_no' => 'required|max:15',
            'email' => 'required|email:filter|max:100',
            'password' => 'required|min:8|max:15',
            'confirm_password' => 'required|min:8|max:15|same:password',
        ]);

        if ($validator->fails()) { // validation fails
            $message = $validator->errors()->first();
        }
        else{

            $check_existing_email = User::where('email', $request->email)
                                        ->where('role_id', '3')
                                        ->count();

            if($check_existing_email == 0){

                $user = new User();
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->mobile = $request->mobile_no;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);

                try{
                    $user->save();
                    $success = true;
                    $message = __("messages.sign_up_success");
                }
                catch(\Exception $e){
                    $message = __("messages.exception_error");
					$message = $e->getMessage();
                }
            }
            else{
                $message = __("messages.profile_user_exist");
            }
        }

        return response(["success" => $success, "message" => $message, "data" => $data]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
