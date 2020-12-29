<?php

namespace App\Services;

interface AjaxServiceInterface
{
    public function validateStoreProductModelRequest(array $param);
    public function storeProductModel($request);
    public function storeBrand($params);
    public function changeOrderStatus(array $params);
}