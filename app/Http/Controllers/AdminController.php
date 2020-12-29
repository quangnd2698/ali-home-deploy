<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Services\AdminServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(
        AdminServiceInterface $adminService,
        Admin $admin
    ) {
        // $this->middleware('superAdmin')->except('index');
        $this->adminService = $adminService;
        $this->admin = $admin;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/admins/index', [
            'admins' => $this->admin->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Gate::allows('isAdmin')) {
            return view('admin/admins/create');
        }
        return redirect()->to('403');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Gate::allows('isAdmin')) {
            list($success, $errors) = $this->adminService->storeAdmin($request);
            if (!$success) {
                return redirect()->route('admins.create')->withErrors($errors);
            }
            alert()->success('Thêm mới admin', 'thành công');
            return redirect()->route('admins.index');
        }
        return redirect()->to('403');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (\Gate::allows('isAdmin') || (\Gate::allows('itMe', Auth::guard('admins')->user()))) {
            $admin = Admin::findOrFail($id);
            return view('admin.admins.edit', ['admin' => $admin]);
        }
        return redirect()->to('403');
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
        if (\Gate::allows('isAdmin') || (\Gate::allows('itMe', Auth::guard('admins')->user()))) {
            list($success, $errors) = $this->adminService->updateAdmin($request, $id);
            if (!$success) {
                return redirect()->route('admins.edit',$id)->withErrors($errors);
            }
            alert()->success('Sửa admin', 'thành công');
            return redirect()->route('admins.index');
        }
        return redirect()->to('403');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Gate::allows('isAdmin')) {
            $admin = Admin::findOrFail($id);
            $image_path = public_path('images/admins/' . $admin->image);
            if ($admin->image && file_exists($image_path)) {
                unlink($image_path);
            }
            $admin->delete();
            alert()->success('Xóa admin', 'thành công');
            return redirect()->route('admins.index');
        }
        return redirect()->to('403');
    }

    /**
     * Remove more the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteMore(Request $request)
    {
        if (\Gate::allows('isAdmin')) {
            $this->adminService->deleteMoreAdmin($request);
            alert()->success('Xóa admin', 'thành công');
            return redirect()->route('admins.index');
        }
        return redirect()->to('403');
    }


    /**
     * Remove more the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProfile($id)
    {
        $admin = Admin::findOrFail($id);
        // dd($admin);
        return view('admin/admins/profile', ['admin' => $admin]);
    }
}
