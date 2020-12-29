<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;

interface InvoiceServiceInterface
{
    public function validateStoreInvoiceRequest(array $params);
    public function storeExportInvoice(Request $request, int $count);
    public function setAccumulatePoint($customerPhone, int $totalCost, int $pointUsed, $customerName);
    public function updateImportInvoice(Request $request, int $count, int $id);
    public function validateStoreInvoiceDetailRequest(array $params);
    public function validateUpdateInvoiceRequest(array $params, int $id);
    public function validateUpdateInvoiceDetailRequest(array $params);
}