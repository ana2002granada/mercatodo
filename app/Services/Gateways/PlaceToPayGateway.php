<?php

namespace App\Services\Gateways;

use App\Constants\PaymentStatus;
use App\Events\TransactionIsApproved;
use App\Exceptions\GatewayException;
use App\Models\Payment;
use App\Services\Contracts\GatewayPaymentContract;
use Carbon\Carbon;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PlaceToPayGateway implements GatewayPaymentContract
{
    protected PlacetoPay $placetopay;

    public function __construct(array $settings)
    {
        $this->placetopay = new PlacetoPay([
            'login' => Arr::get($settings, 'login'),
            'tranKey' => Arr::get($settings, 'tranKey'),
            'baseUrl' => Arr::get($settings, 'baseUrl'),
            'timeout' => 10,
        ]);
    }

    public function request(Payment $payment, Request $request): Payment
    {
        try {
            $reference = $payment->id;
            $request = [
                'payment' => [
                    'reference' => $reference,
                    'description' => trans(
                        'COMPRA MERCATODO'
                    ),
                    'amount' => [
                        'currency' => 'COP',
                        'total' => $payment->amount,
                    ],
                ],
                'payer' => [
                    'document' => $payment->payer_document,
                    'documentType' => 'CC',
                    'name' => $payment->user->name,
                    'surname' => $payment->user->last_name,
                    'email' => $payment->user->email,
                    'mobile' => $payment->user->phone_number,
                ],
                'expiration' => date('c', strtotime('+30 minutes')),
                'returnUrl' => route('payment.show', $payment),
                'ipAddress' => $request->ip(),
                'userAgent' => $request->userAgent(),
            ];

            $response = $this->placetopay->request($request);
            if ($response->isSuccessful()) {
                $payment->process_url = $response->processUrl();
                $payment->request_id = $response->requestId();
                $payment->status = PaymentStatus::PENDING;
            } else {
                $payment->status = PaymentStatus::REJECTED;
            }
        } catch (\Throwable $exception) {
            $payment->status = PaymentStatus::REJECTED;
        }

        $payment->save();
        return $payment;
    }

    public function query(Payment $payment): Payment
    {
        info('payment', $payment->toArray());
        $response = $this->placetopay->query($payment->request_id);

        if ($response->isSuccessful()) {
            if ($response->status()->isApproved()) {
                $payment->status = PaymentStatus::SUCCESSFUL;
                $payment->paid_at = new Carbon($response->status()->date());
                $payment->receipt = $response->lastTransaction()->receipt();
                TransactionIsApproved::dispatch($payment);
            } elseif ($response->status()->isRejected()) {
                $payment->status = PaymentStatus::REJECTED;
            }
            $payment->save();
            return $payment;
        }

        throw new GatewayException($response->status()->message());
    }
}
