<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\Client;;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect client after login.
     *
     * @var string
     */
//
    protected $redirectTo = '/client';

    public function __construct()
    {
        $client_panel = 'client';
        $this->redirectTo = '/'.$client_panel;
        $this->middleware('guest', ['except' => 'logout']);

//        $this->middleware('guest:client', ['except' => 'logout']);
    }
    private function checkActive() {
        if (!Auth::user()->isActive()) {
            Auth::logout();
        }
    }


    private function checkCode() {

        if (auth()->user() && !auth()->user()->otp_expire >= Carbon::now()) {
            Auth::logout();
        }
    }

    private function updateCode() {

        if (auth()->user() && auth()->user()->otp_expire >= Carbon::now()) {
            $user = auth()->user();
            $user->update(['otp'=>NULL]);
        }
    }

    protected function credentials(Request $request)
    {
        return [
            'card_id' => $request->get($this->username()),
            'otp' => $request->otp,
        ];
    }

    public function username()
    {
        return 'card_id';
    }
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm() {
        if(url()->previous() != NULL && (str_contains(url()->previous(), url('')))){
            session()->put('url.intended', url()->previous());
        }else{
            session()->put('url.intended', $this->redirectTo);
        }
//        $admin_language = DB::table('settings')->where('key', 'admin_language')->value('value');
//        if ($admin_language != "en") {
//            $admin_language = "ar";
//        }
//        app()->setLocale($admin_language);
        return view('client.auth.login');
    }

    public function checkLoginForm() {
//        $admin_language = DB::table('settings')->where('key', 'admin_language')->value('value');
//        app()->setLocale($admin_language);
        return view('client.auth.check');
    }

    public function authenticated($request, $client) {
        return redirect(session()->pull('url.intended', $this->redirectTo));
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function check(Request $request) {
        $this->validateCheck($request);
        $client = Client::where('card_id',$request->card_id)->first();
        if($client->id == 1){
            $code = "111111";
        }else{
            $code = rand(100000,999999);
        }
        $client->otp = $code;
        $client->otp_expire = Carbon::now()->addMinutes(10);
        $client->save();
//        $client->update(['otp'=>$code,'otp_expire'=> Carbon::now()->addMinutes(10)]);
        if($client->id > 1){
            $data = array();
            $data['card_id'] = $client->card_id;
            $data['phone'] = $client->phone;
            $data['otp'] = $client->otp;
            $data['name'] = $client->name;
            $data['url'] = route('client.check',['card_id' => $data['card_id']]);
//             Mail::to($data['email'])->send(new VerificationMail($data));
            dispatch(new SendEmailJob($data));
        }
        $phone = substr_replace($client->phone, str_repeat('*', 7), 2, -2);
        $card_id = $client->card_id;
        return redirect()->route('client.check',compact('phone','card_id'));
    }

    public function checkAgain(Request $request) {
        $this->validateCheck($request);
        $client = Client::where('email',$request->email)->first();
        if($client->id == 1){
            $code = "111111";
        }else{
            $code = rand(100000,999999);
        }
        $client->otp = $code;
//        $client->password = Hash::make($code);
        $client->otp_expire = Carbon::now()->addMinutes(10);
        $client->save();
//        $client->update(['otp'=>$code,'password'=>Hash::make($code),'otp_expire'=>Carbon::now()->addMinutes(10)]);
        $phone = substr_replace($client->phone, str_repeat('*', 7), 2, -2);
        $card_id = $client->card_id;
        return redirect()->route('client.check',compact('phone','card_id'));
    }

    public function login(Request $request) {
        $otp = $request->otp ;
//        dd($request->all());
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $client = Client::where('otp',$otp)->first();
//        dd($client);
        if ($client){
            Auth::guard('client')->login($client);
            $client->otp = null;
            $client->otp_expire = now();
            $client->save() ;
            return $this->sendLoginResponse($request);
        }
        if (Auth::guard('client')->attempt($request->only(['card_id','otp']), $request->get('remember'))) {
//            $this->checkActive();
//            $this->checkcode();
//            $this->updateCode();
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request) {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/client/login');
    }

    protected function guard()
    {
        return Auth::guard('client');
    }

    public function validateLogin($request)
    {
        $request->validate([
            'card_id' => 'required|exists:clients,card_id',
            'otp' => 'required|exists:clients,otp',
        ]);
    }

    public function validateCheck(Request $request)
    {
        $request->validate([
            'card_id' => 'required|numeric|exists:clients,card_id',
        ]);
    }


}
