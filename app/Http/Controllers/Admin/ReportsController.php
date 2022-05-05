<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMetricResource;
use App\Http\Resources\ProductMetricResource;
use App\Models\Payment;
use App\Models\PaymentProduct;
use Illuminate\View\View;

class ReportsController extends Controller
{
    public function report(): view
    {
        $this->authorize('reports');
        $products = ProductMetricResource::collection(PaymentProduct::mostPurchasedProducts());
        $payments = PaymentMetricResource::collection(Payment::paymentsReport());
        return view('admin.reports', compact('products', 'payments'));
    }
}
