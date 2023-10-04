<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Mail\VerificationMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/admin';
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
    // protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$admin_panel = DB::table('settings')->where('key', 'admin_url')->value('value');
        // if($admin_panel == '' || $admin_panel == NULL){
        $admin_panel = 'admin';
        // }
        $this->redirectTo = '/'.$admin_panel;
        $this->middleware('guest', ['except' => 'logout']);

    }

    protected function credentials(Request $request)
    {
        //       $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
        //    ? $this->username()
        //    : 'phone';
        return [
            'email' => $request->get($this->username()),
            'password' => $request->otp,
        ];
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
        $admin_language = DB::table('settings')->where('key', 'admin_language')->value('value');
        if ($admin_language != "en") {
            $admin_language = "ar";
        }
        app()->setLocale($admin_language);
        return view('admin.auth.login');
    }

    public function checkLoginForm() {
        $admin_language = DB::table('settings')->where('key', 'admin_language')->value('value');
        app()->setLocale($admin_language);
        return view('admin.auth.check');
    }

    public function authenticated($request, $user) {
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
        $user = User::where('email',$request->email)->first();

        if($user->id == 1){
            $code = "11111";
        }else{
            $code = rand(10000,99999);
        }
        $minutes = 15 ;
        $user->otp = $code;
        $user->otp_expire = Carbon::now()->addMinutes($minutes);
        $user->save();
//        $user->update(['otp'=>$code,'otp_expire'=> Carbon::now()->addMinutes(10)]);
         if($user->id > 1){
             $data = array();
             $data['email'] = $user->email;
             $data['otp'] = $user->otp;
             $data['name'] = $user->name;
             $data['minutes'] =  $minutes;
             $data['url'] = route('admin.check',['email' => $data['email']]);
             Mail::to($data['email'])->send(new VerificationMail($data));
//             dispatch(new SendEmailJob($data));
         }
        return redirect()->route('admin.check',['email'=>$user->email]);
    }

    public function checkAgain(Request $request) {
        $this->validateCheck($request);
        $user = User::where('email',$request->email)->first();
        if($user->id == 1){
            $code = "11111";
        }else{
            $code = rand(10000,99999);
        }
        $user->otp = $code;
//        $user->password = Hash::make($code);
        $user->otp_expire = Carbon::now()->addMinutes(10);
        $user->save();
//        $user->update(['otp'=>$code,'password'=>Hash::make($code),'otp_expire'=>Carbon::now()->addMinutes(10)]);
        $email = $request->email;
        return redirect()->route('admin.check',['email'=>$email]);
    }

    public function login(Request $request) {

        // $code = strrev(implode("", $request->code));
        $otp =  $request->otp;
        $request->password = $otp;
        $request->otp = $otp;
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $user = User::where('otp',$otp)->first();
        if ($user){
            Auth::login($user);
            $user->otp = null;
            $user->otp_expire = now();
            $user->save() ;
            return $this->sendLoginResponse($request);
        }
        if ($this->attemptLogin($request)) {
            $this->checkActive();
            $this->checkcode();
            $this->updateCode();
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request) {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/admin/login');
    }

//    public function logout(Request $request)
//    {
////       return dd('logout');
////        Auth::guard('web')->logout();
//        $this->guard()->logout();
//
//        $request->session()->invalidate();
//        $request->session()->regenerateToken();
//         $request->session()->flush();
//        $request->session()->regenerate();
//
//        if ($response = $this->loggedOut($request)) {
//            return $response;
//        }
//
//        return $request->wantsJson()
//            ? new JsonResponse([], 204)
//            : redirect('/');
//    }

    public function validateLogin($request)
    {
        $request->validate([
            // $this->username() => 'required|email|string',
            'email' => 'required|email|exists:users,email',
            // 'password' => 'required',
            'otp' => 'required',
        ]);
    }

    public function validateCheck(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
    }
}
