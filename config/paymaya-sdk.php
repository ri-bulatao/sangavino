<?php

use Lloricode\Paymaya\PaymayaClient;
use Lloricode\Paymaya\Request\Webhook\Webhook;

/**
 * @todo: Manage Exception using laravel logs, allow set config log files
 */

return [
    'mode' => env('PAYMAYA_MODE', PaymayaClient::ENVIRONMENT_SANDBOX),
    'keys' => [
        'public' => env('PAYMAYA_PUBLIC_KEY'),
        'secret' => env('PAYMAYA_SECRET_KEY'),
    ],

    /**
     *
     * Webhooks
     *
     */
    'webhooks' => [
        # Test webhook
        // Webhook::CHECKOUT_SUCCESS => 'cb010ae2-b220-4227-b4b8-917cc7ffd73f',

        Webhook::CHECKOUT_SUCCESS => 'api/resident/payment-success',
        Webhook::CHECKOUT_FAILURE => 'api/resident/failed-payment',
        Webhook::CHECKOUT_DROPOUT => 'api/resident/cancel-payment',
    ],

    # TODO: Customize Checkout
    'checkout' => [
        'customization' => [
            'logoUrl' => 'https://image1.png',
            'iconUrl' => 'https://image2.png',
            'appleTouchIconUrl' => 'https://image3.png',
            'customTitle' => config('app.url'),
            'colorScheme' => '#e01c44',            
            'redirectTimer'=> 3,
        ],
    ],
];
