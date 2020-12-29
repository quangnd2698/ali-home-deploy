<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;

interface ProductServiceInterface
{
    public function validateStoreProductRequest(array $param);
    public function validateUpdateProductRequest(array $param, int $id);
    public function createProduct(Request $request);
    public function deleteMoreProduct($request);
}