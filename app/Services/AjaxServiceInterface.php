<?php

namespace App\Services;

interface AjaxServiceInterface
{
    public function validateStoreProductModelRequest(array $param);
    public function storeProductModel($request);
    public function storeBrand($params);
    public function changeOrderStatus(array $params);
    public function checkQuantity($id, $quantity);
    public function userLogin($credentials);

}