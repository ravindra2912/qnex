<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Validator;
use App\Models\User;
use App\Models\AddToCart;
use Mail;

class AuthController extends Controller
{
    public function register(Request $request){

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

    public function login(Request $request){

        $success = false;
        $message = __("messages.exception_error");
        $data = array();
        $accessToken = "";
        $cart_count = 0;
        $user = (object) array();

        $validator = Validator::make($request->all(), [
            'email' => 'required|email:filter|max:100',
            'password' => 'required|min:8|max:15',
        ]);
		
	

        if ($validator->fails()) { // validation fails
            $message = $validator->errors()->first();
        }
        else{
            if(auth()->attempt(array('email' => $request->email, 'password' => $request->password))){
                $success = true;
                $message = __("messages.sign_in_success");
                $user = Auth::user();
                $user->image = getImage($user->image);
                $accessToken = $user->createToken('authToken')->accessToken;
				$user->accessToken = $accessToken;
				$cart_count = AddToCart::where('user_id', $user->id)->count();
            }
            else{ 
                $message = __("messages.invalid_credentials");
            }
        }

        return response(["success" => $success, "message" => $message, "cart_count"=>$cart_count, "data" => $user, "access_token" => $accessToken]);
    }

    public function logout(){

        $success = false;
        $message = __("messages.exception_error");
        $data = array();

        if (Auth::user()) {
            Auth::user()->accessToken()->delete();
            //Auth::user()->AauthAcessToken()->delete();
            $success = true;
            $message = __("messages.logout");
        }

        return response(["success" => $success, "message" => $message, "data" => $data]);
    }

	public function ForgotPassword(Request $request){
        $success = false;
        $message = __("messages.exception_error");
        $data = array();

        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
        ]);

        if ($validator->fails()) { // validation fails
            $message = $validator->errors()->first();
        }
        else{
			$Pin = random_int(100000, 999999);
			$user = User::where('email',$request->email)->first();
			$user->forgot_pin = $Pin;
			$user->forgot_at = date('Y-m-d H:i:s');
			
			
			
			$SubscriptionUrl = 'SubscriptionUrl';
			$datas = compact('Pin','SubscriptionUrl');
			
			$info['to'] = $request->email;
			try{
				$user->save();
				Mail::send('emails.FogotEmail', $datas, function($message) use ($info){
					$message->to($info['to']);
					$message->subject('Forgot Password');
				});
			}
			catch(\Exception $e){
				$message = __("messages.exception_error");
				$message = $e->getMessage();
			}
			$success = true;
            $message = "Succesfully Sent To Your Mail, Please Check Your Mail.";
		}


        return response(["success" => $success, "message" => $message, "data" => $data]);
    }
	
	public function ResetPassword(Request $request){

        $success = false;
        $message = __("messages.exception_error");
        $data = array();

        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'pin' => 'required|exists:users,forgot_pin',
            'password' => 'required|min:8|max:15',
            'confirm_password' => 'required|min:8|max:15|same:password',
        ]);

        if ($validator->fails()) { // validation fails
            $message = $validator->errors()->first();
        }
        else{
			
			$user = User::where('email',$request->email)->first();
			$interval = date_diff(date_create($user->forgot_at), date_create(date('Y-m-d H:i:s')));
			$min = $interval->days * 24 * 60;
			$min += $interval->h * 60;
			$min += $interval->i;
			if($min <= 30){
				$user->password = Hash::make($request->password);
				$user->forgot_pin = null;

				try{
					$user->save();
					$success = true;
					$message ="Password reset Succesfully";
				}
				catch(\Exception $e){
					$message = __("messages.exception_error");
					$message = $e->getMessage();
				}
			}else{
				$message = "Session Expired!";
			}
			
		}


        return response(["success" => $success, "message" => $message, "data" => $data]);
    }
}
