<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserServiceInterface;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserServiceInterface $userService, User $user)
    {
        
        // dd(2);
        // $userLogin = Auth::guard('admins')->user();
        $this->userService = $userService;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query()->with('invoice')->get();
        return view('admin/users/index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/users/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        list($success, $errors) = $this->userService->storeUser($request);
        if (!$success) {
            return redirect()->route('users.sign_up')->withErrors($errors);
        }
        alert()->success('Đăng ký', 'thành công');

        return redirect()->route('users.login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        list($success, $errors) = $this->userService->updateUser($id, $request);
        if (!$success) {
            return redirect()->route('users.profile', $id)->withErrors($errors);
        }
        alert()->success('Cập nhật', 'thành công');

        return redirect()->route('users.profile', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::findOrFail($id);
        $image_path = public_path('images/users/' . $user->avatar);
        if ($user->avatar && file_exists($image_path)) {
            unlink($image_path);
        }
        $user->delete();
        alert()->success('Xóa user', 'thành công');
        return redirect()->route('users.index');
    }

    // public function userLogin($request)
    // {
    //     $param = $request->all();
    //     $email = $param['email'];
    //     $password = $param['password'];
    //     // $admin = Admin::where('email', $email)->where('password', $password)->get();
    //     if (isset($admin)) {
    //         $admin = 
    //     }
    // }
}
