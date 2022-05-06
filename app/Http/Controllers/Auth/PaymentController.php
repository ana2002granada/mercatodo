<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Payment\CloneProductsAction;
use App\Actions\Payment\PaymentRequestStoreAction;
use App\Actions\Payment\PaymentStoreAction;
use App\Actions\Payment\PaymentUpdateAction;
use App\Constants\PaymentStatus;
use App\Exceptions\GatewayException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StorePaymentRequest;
use App\Http\Requests\Auth\UpdatePaymentRequest;
use App\Models\Payment;
use App\Services\Contracts\GatewayPaymentContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * @return Application|Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function show(Payment $payment, GatewayPaymentContract $gateway)
    {
        if ($payment->isProcessing()) {
            return response()->redirectTo($payment->showRoute());
        }
        if ($payment->isPending()) {
            $payment = $gateway->query($payment);
        }
        return view('auth.payment.user.show', compact('payment'));
    }

    public function store(StorePaymentRequest $request): JsonResponse
    {
        $payment = auth()->user()->payments()->where('status', PaymentStatus::PROCESSING)->first() ?? PaymentStoreAction::execute();
        $payment = PaymentRequestStoreAction::execute($request, $payment);

        return response()->json([
            'payment' => $payment,
        ]);
    }

    public function update(UpdatePaymentRequest $request, Payment $payment, GatewayPaymentContract $gateway)
    {
        $payment = PaymentUpdateAction::execute($request, $payment);

        try {
            $payment = $gateway->request($payment, $request);
            return $payment->isPending() ? redirect($payment->process_url) : redirect()->back()->with('error', 'No es posible realizar el pago (TRADUCIR)');
        } catch (GatewayException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function index(): View
    {
        $payments = auth()->user()->payments()->orderBy('created_at', 'DESC')->paginate(4);
        $user = auth()->user();
        return view('auth.payment.user.my-payments', compact('payments', 'user'));
    }

    /**
     * @param Payment $payment
     * @return View|RedirectResponse
     */
    public function continuousWithPayment(Payment $payment)
    {
        if ($payment->isProcessing()) {
            return view('auth.payment.index', compact('payment'));
        }
        return response()->redirectTo($payment->myPaymentRoute());
    }

    public function reload(Payment $payment)
    {
        $hasPendingTransaction = auth()->user()->payments()->where('status', PaymentStatus::PROCESSING)->count();
        if ($payment->isRejected() && !$hasPendingTransaction) {
            $newPayment = PaymentStoreAction::execute();
            $newPayment = CloneProductsAction::execute($payment, $newPayment);

            return view('auth.payment.index', [
                'payment' => $newPayment,
            ]);
        }
        return response()->redirectTo($payment->myPaymentRoute())->with('error', 'En este momento tienes una transaccion en proceso c:');
    }
}
