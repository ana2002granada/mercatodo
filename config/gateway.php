<?php

return [
    'services' => [
        'current' => env('CURRENT_GATEWAY', 'placetopay'),
        'placetopay' => [
            'class' => \App\Services\Gateways\PlaceToPayGateway::class,
            'settings' => [
                'login' => env('PTP_LOGIN'),
                'tranKey' => env('PTP_TRANKEY'),
                'baseUrl' => env('PTP_URL')
            ]
        ],
    ]
];
