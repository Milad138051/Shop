<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\Message\MessageService;
use App\Http\Requests\Auth\LoginRegisterRequest;
use App\Http\Services\Message\Email\EmailService;

class LoginRegisterController extends Controller
{
    public function loginRegisterForm()
	{
	  return view('auth.login-register');	
	} 

    public function loginRegister(LoginRegisterRequest $request)
    {
        $inputs = $request->all();

        //check id is email or not
        if(filter_var($inputs['id'], FILTER_VALIDATE_EMAIL))
        {
            $type = 1; // 1 => email
            $user = User::where('email', $inputs['id'])->first();
            if(empty($user)){
                $newUser['email'] = $inputs['id'];
            }
        }
        //check id is mobile or not
        elseif(preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['id'])){
            $type = 0; // 0 => mobile;

            // all mobile numbers are in on format 9** *** ***
            $inputs['id'] = ltrim($inputs['id'], '0');
            $inputs['id'] = substr($inputs['id'], 0, 2) === '98' ? substr($inputs['id'], 2) : $inputs['id'];
            $inputs['id'] = str_replace('+98', '', $inputs['id']);

            $user = User::where('mobile', $inputs['id'])->first();
            if(empty($user)){
                $newUser['mobile'] = $inputs['id'];
            }
        }else{
            $errorText = 'شناسه ورودی شما نه شماره موبایل است نه ایمیل';
            return redirect()->route('auth.customer.login-register-form')->withErrors(['id' => $errorText]);
        }

        if(empty($user)){
            $newUser['password']='12345678';
            $newUser['activation']=0;
            $newUser['user_type']=0;
            $newUser['name']='new user';
            $user=User::create($newUser);
        }

        //create otp code

        $otpCode=rand(111111,999999);
        $token=Str::random(60);
        $otpInputs=[
            'token'=>$token,
            'user_id'=>$user->id,
            'otp_code'=>$otpCode,
            'login_id'=>$inputs['id'],
			'type'=>$type,
        ];

        Otp::create($otpInputs);
        //send sms or email

        //send sms
        if($type == 0){

            // az inja jadide va khodam ba log minevisam chon service sms nadaram
            //Log::info('کد تایید:'.' '.$otpCode .' '.'برای کاربر:'.' '.$user->id);
            Log::info("your code is : $otpCode and is sent to your mobile");
        }

        //send email
	    elseif($type == 1){
           
  		   Log::info("your code is : $otpCode and is sent to your email");

             $emailService = new EmailService();
             $details = [
                 'title' => 'ایمیل فعال سازی',
                 'body' => "کد فعال سازی شما : $otpCode"
             ];
             $emailService->setDetails($details);
             $emailService->setFrom('noreply@example.com', 'example');
             $emailService->setSubject('کد احراز هویت');
             $emailService->setTo($inputs['id']);
 
             $messagesService = new MessageService($emailService);

        }
        
        $messagesService->send();
		
		return redirect()->route('auth.login-register-confirm-form',$token);
    }
	
	public function loginRegisterConfirmForm($token)
	{
       // dd($token);
		$otp=Otp::where('token',$token)->first();
		if(empty($otp)){
			return redirect()->route('auth.customer.login-register-form')->with('swal-error', 'کد وارد شده صحیح نمیباشد, لطفا دوباره امتحان کنید');            // ->withErrors(['id'=>'آدرس وارد شده معتبر نمیباشد']);
		}
		return view('auth.login-register-confirm',compact('token','otp'));
	}	
	
	public function loginRegisterConfirm($token,LoginRegisterRequest $request)
	{
		$inputs=$request->all();
		$otp=Otp::where('token',$token)->where('used',0)->where('created_at','>=', Carbon::now()->subMinute(1)->toDateTimeString())->first();
		
		if(empty($otp)){
		   return redirect()->route('auth.login-register-form',$token)->with('swal-error', 'کد وارد شده صحیح نمیباشد, لطفا دوباره امتحان کنید');
        //    withErrors(['id'=>'کد وارد شده معتبر نمیباشد']);
		}
		
		if($otp->otp_code !== $inputs['otp']){
		   return redirect()->route('auth.login-register-confirm-form',$token)->with('swal-error', 'کد وارد شده صحیح نمیباشد, لطفا دوباره امتحان کنید');
        //    ->withErrors(['otp'=>'کد وارد شده صحیح نمیباشد']);
		}
		
		$otp->update(['used'=>1]);
		$user=$otp->user()->first();
		
		if($otp->type == 0 && empty($user->mobile_verified_at)){
			$user->update(['mobile_verified_at'=>Carbon::now()]);
		}
		elseif($otp->type == 1 && empty($user->email_verified_at)){
			$user->update(['email_verified_at'=>Carbon::now()]);

		}
		
		Auth::login($user);
	    return redirect()->route('admin.home')->with('swal-success', 'موفق');
	}
	
	
	public function loginRegisterResendOtp($token)
	{
		$otp=Otp::where('token',$token)->where('created_at','<=',Carbon::now()->subMinute(1)->toDateTimeString())->first();
		
		if(empty($otp)){
		  return redirect()->route('auth.login-register-form',$token)->with('swal-error', 'کد وارد شده صحیح نمیباشد, لطفا دوباره امتحان کنید');
        //   ->withErrors(['id'=>'لطفا کد ارسال شده را بصورت صحیح وارد نمایید']);
		}
		
		$user=$otp->user()->first();
		 //create otp code

        $otpCode=rand(111111,999999);
        $token=Str::random(60);
        $otpInputs=[
            'token'=>$token,
            'user_id'=>$user->id,
            'otp_code'=>$otpCode,
            'login_id'=>$otp->login_id,
			'type'=>$otp->type,
        ];

        Otp::create($otpInputs);

        //send sms or email

        //send sms
        if($otp->type == 0){

            // az inja jadide va khodam ba log minevisam chon service sms nadaram

            //Log::info('کد تایید:'.' '.$otpCode .' '.'برای کاربر:'.' '.$user->id);
            Log::info("your code is : $otpCode and is sent to your mobile");
        }
		
        //send email
         elseif($otp->type === 1){
            $emailService = new EmailService();
            $details = [
                'title' => 'ایمیل فعال سازی',
                'body' => "کد فعال سازی شما : $otpCode"
            ];
            $emailService->setDetails($details);
            $emailService->setFrom('noreply@example.com', 'example');
            $emailService->setSubject('کد احراز هویت');
            $emailService->setTo($otp->login_id);

            $messagesService = new MessageService($emailService);

        }

        $messagesService->send();
		
		return redirect()->route('auth.login-register-confirm-form',$token);
    
	}
	
	public function logout()
	{
		Auth::logout();
		return redirect()->route('admin.home');
	}
	
	
	
}
