<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;

interface ImportInvoiceServiceInterface
{
    public function validateStoreImportInvoiceRequest(array $params);
    public function storeImportInvoice(Request $request, int $count);
    public function updateImportInvoice(Request $request, int $count, int $id);
    public function validateStoreImportInvoiceDetailRequest(array $params);
    public function validateUpdateImportInvoiceRequest(array $params, int $id);
    public function validateUpdateImportInvoiceDetailRequest(array $params);
    public function deleteMoreImportInvoice($request);
}