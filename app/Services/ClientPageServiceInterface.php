<?php

namespace App\Services;

interface ClientPageServiceInterface
{
    // public function validateStoreOrderRequest(array $param);
    // public function validateUpdateUserRequest(array $param, int $id);
    public function getProducts($params, $request);
    // public function getPaginate(array $params);
    public function validateContactRequest(array $params);
}