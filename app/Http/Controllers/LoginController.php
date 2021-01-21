<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Str;
use App\Mail\SendResetPassword;
use App\Jobs\SendResetPasswordJob;
use App\Models\User;
use App\Jobs\SendEmailJob;
// use Mail;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {

        $credentials = $request->only('email', 'password');
        $admin = Admin::where('email', $credentials['email'])->where('password', $credentials['password'])->get();

        if (Auth::guard('admins')->attempt($credentials)) {

            switch (Auth::guard('admins')->user()->permission) {
                case 1:
                    return redirect()->route('home');
                break;
                case 2:
                    return redirect()->route('invoices.create');
                break;
                case 3:
                    return redirect()->route('importInvoices.create');
                break;
                case 4:
                    return redirect()->route('admins.index');
                break;
                default;
            }
        }
        return redirect()->route('login')->with('thongbaoloi', 'Tài khoản hoặc mật khẩu không đúng');;
    }

    public function logout() {
        Auth::guard('admins')->logout();
        return redirect()->route('login');
    }



    public function userAuthenticate(Request $request)
    {
        $credentials = $request->only('phone', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('client.home');
        }
        return redirect()->route('users.login')->with('thongbaoloi', 'Tài khoản hoặc mật khẩu không đúng');
    }

    public function userlogout() {
        Auth::guard('web')->logout();
        return redirect()->route('client.home');
    }

    public function userLogin() {
        if(Auth::guard('web')->check()) {
            return redirect()->route('client.home');
        }
        return view('client/login');
    }

    public function getResetPass()
    {
        return view('client/reset_pass');
    }

    public function resetPass(Request $request)
    {
        $phone = $request->phone;
        $user = User::where('phone', $phone)->first();
        if (!$user) {
            return redirect()->route('users.reset_pass')->with('thongbaoloi', 'Số điện thoại không tồn tại');
        }
        $newPassword = Str::random(8);
        $password = bcrypt($newPassword);
        $user->password = $password;
        $user->save();
        $params['email'] = $user->email;
        $params['password'] = $newPassword;
        $resetMail = new SendResetPassword($params);
        $sendResetJob = new SendResetPasswordJob($resetMail,  $params['email']);
        dispatch($sendResetJob);
        alert()->success('Reset mật khẩu thành công', 'Vào email để lấy mật khẩu mới');
        return redirect()->route('users.login');

    }

}
