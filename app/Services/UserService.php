<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserService implements UserServiceInterface
{
    /**
     * validate store Admin request
     *
     * @param array $params
     * @return array
     */
    public function validateStoreUserRequest(array $params)
    {
        $validator = Validator::make($params, [
            'email' => 'required|unique:users|string',
            'name' => 'required|string|max:64',
            'address' => 'required|string|max:124',
            'phone' => 'required|numeric|between:10000000,99999999999|unique:users|string',
            'date_of_birth' => 'required|string',
            'gender' => 'required|string',
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
    public function validateUpdateUserRequest(array $params)
    {
        $validator = Validator::make($params, [
            // 'email' => sprintf('sometimes|unique:users,email,%s|string', $id),
            'name' => 'sometimes|string|max:64',
            'address' => 'sometimes|string|max:124',
            // 'phone' => sprintf('sometimes|numeric|between:10000000,99999999999|unique:users,phone,%s|string', $id),
            'date_of_birth' => 'sometimes|string',
            'gender' => 'sometimes|string',
            'password' => 'sometimes|string|min:8',
        ]);
        return [$validator->passes(), $validator->errors()];
    }

    public function storeUser($request)
    {
        $param = $request->all();
        $address = $param['address']. ' ' . $param['ward'] . ' ' . $param['district'] . ' ' . $param['province'];
        $param['address'] = $address;
        list($success, $errors) = $this->validateStoreUserRequest($param);
        if(!$success) {
            return [false, $errors];
        }

        $param['password'] = bcrypt($param['password']);
        User::create($param);

        return [true, ''];
    }

    public function updateUser($id, $request)
    {
        $user = User::findOrFail($id);
        $param = $request->all();
        list($success, $errors) = $this->validateUpdateUserRequest($param);
        if(!$success) {
            return [false, $errors];
        }

        $param['password'] = bcrypt($param['password']);
        $user->update($param);

        return [true, ''];
    }
}
