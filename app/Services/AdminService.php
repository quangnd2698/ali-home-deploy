<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\Validator;

class AdminService implements AdminServiceInterface
{
    /**
     * validate store Admin request
     *
     * @param array $params
     * @return array
     */
    public function validateStoreAdminRequest(array $params)
    {
        $validator = Validator::make($params, [
            'email' => 'required|unique:admins|string',
            'name' => 'required|string|max:64',
            'address' => 'required|string|max:124',
            'phone' => 'required|numeric|unique:admins|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
            'date_of_birth' => 'required|string',
            'basic_salary' => 'nullable|numeric',
            'gender' => 'required|string',
            'permission' => 'required|numeric',
            'password' => 'required|string|min:8',
        ]);
        return [$validator->passes(), $validator->errors()];
    }

    /**
     * validate update block request
     *
     * @param array $params
     * @param int $id
     * @return array
     */
    public function validateUpdateAdminRequest(array $params, int $id)
    {
        $validator = Validator::make($params, [
            'email' => sprintf('sometimes|unique:admins,email,%s|string', $id),
            'name' => 'sometimes|string|max:64',
            'address' => 'sometimes|string|max:124',
            'phone' => 'sometimes|numeric|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9|unique:admins,phone,'.$id,
            'date_of_birth' => 'sometimes|string',
            'gender' => 'sometimes|string',
            'basic_salary' => 'nullable|numeric',
            'permission' => 'sometimes|numeric',
            'password' => 'sometimes|string|min:8',
        ]);
        return [$validator->passes(), $validator->errors()];
    }

    public function storeAdmin($request)
    {
        $param = $request->all();
        list($success, $errors) = $this->validateStoreAdminRequest($param);
        if (!$success) {
            return [false, $errors];
            // return redirect()->route('admins.create')->withErrors($errors);
        }
        $param['password'] = bcrypt($param['password']);
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $param['image']->getClientOriginalExtension();
            $param['image']->move(public_path('images/admins'), $filename);
            $param['image'] = $filename;
        }
        Admin::create($param);

        return [true,''];
    }

    public function updateAdmin($request, $id)
    {
        $admin = Admin::findOrFail($id);
        $image_path = public_path('images/admins/' . $admin->image);
        if ($admin->image && file_exists($image_path)) {
            unlink($image_path);
        }
        $param = $request->all();
        list($success, $errors) = $this->validateUpdateAdminRequest($param, $id);
        if (!$success) {
            return [false, $errors];
        }

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $param['image']->getClientOriginalExtension();
            $param['image']->move(public_path('images/admins'), $filename);
            $param['image'] = $filename;
        }

        $admin->update($param);
        return [true,''];
    }

    public function deleteMoreAdmin($request)
    {
        $param = $request->all();
        $listId = explode(',', $param['checkbox_selected']);
        $admins = Admin::whereIn('id', $listId)->get();
        foreach ($admins as $admin) {
            $image_path = public_path('images/admins/' . $admin->image);
            if ($admin->image && file_exists($image_path)) {
                unlink($image_path);
            }
            $admin->delete();
        }
    }
}
