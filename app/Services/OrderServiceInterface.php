<?php

namespace App\Services;

interface OrderServiceInterface
{
    public function validateStoreOrderRequest(array $param);
    // public function validateUpdateUserRequest(array $param, int $id);
    public function storeOrder($request);
    // public function getPaginate(array $params);
}