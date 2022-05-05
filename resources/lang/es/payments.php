<?php

return [
    'myPayments' => 'Mis Pagos',
    'continuous' => 'Continuar',
    'continuousShopping' => 'Continuar compra',
    'reload' => 'Reintentar compra',
    'purchase' => 'Mi Compra',
    'total' => 'Total',
    'bag' => 'Bolsa',
    'count' => 'Cantidad',
    'status' => [
         \App\Constants\PaymentStatus::SUCCESSFUL => 'Completado',
         \App\Constants\PaymentStatus::PENDING => 'Pendiente',
         \App\Constants\PaymentStatus::REJECTED => 'Rechazado',
    ],
    'invoice' => [
        'invoice' => 'Factura',
        'price' => 'Precio unitario',
        'billed_to' => 'Facturado a ',
        'note' => 'Nota',
        'thanks' => 'Gracias por usar nuestros servicios',
        'total_amount' => 'Monto total',
        'approved' => 'Aprobado',
        'rejected' => 'Rechazado',
        'pending' => 'Pendiente',
    ],
    'no_transactions' => 'No hay transacciones',
    'continue_payment' => 'Continuar con el pago',
];
