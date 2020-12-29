<?php

namespace App\Services;

interface AdminServiceInterface
{
    public function validateStoreAdminRequest(array $param);
    public function validateUpdateAdminRequest(array $param, int $id);
    public function storeAdmin($param);
    public function updateAdmin($request, $id);
    public function deleteMoreAdmin($request);
    // public function getPaginate(array $params);
}