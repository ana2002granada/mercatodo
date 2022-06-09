<?php

namespace App\Http\Controllers\Admin;

use App\Constants\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMetricResource;
use App\Http\Resources\ProductMetricResource;
use App\Models\Payment;
use App\Models\PaymentProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReportsController extends Controller
{
    public function report(): view
    {
        $this->authorize('reports');
        $products = ProductMetricResource::collection(PaymentProduct::mostPurchasedProducts());
        $payments = PaymentMetricResource::collection(Payment::paymentsReport());
        $this->authorize('viewAny', Payment::class);
        $allPayments = Payment::whereRaw('payer_document is not null')->orderBy('created_at', 'DESC')->paginate(4);
        $paymentsCharts = Payment::orderBy('created_at', 'ASC')
            ->select(DB::raw('count(*) as total'), DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as date"), 'status')
            ->whereIn('status', [PaymentStatus::SUCCESSFUL, PaymentStatus::REJECTED, PaymentStatus::PENDING])
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->subDays(1)->endOfDay()])
            ->groupBy(['status', 'created_at'])
            ->get()
            ->groupBy('status');
        return view('admin.reports', compact('products', 'payments', 'allPayments', 'paymentsCharts'));
    }
}
