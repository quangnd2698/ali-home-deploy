<?php

namespace App\Services;

interface UserServiceInterface
{
    public function validateStoreUserRequest(array $param);
    public function validateUpdateUserRequest(array $param);
    public function storeUser($request);
    public function updateUser($id, $request);
    // public function getPaginate(array $params);
}