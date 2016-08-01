<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

use InteractiveSolutions\PushNotification\Controller\DeviceCollectionController;

return [
    'user-devices' => [
        'type'    => 'segment',
        'options' => [
            'route'    => '/users/:user_id/mobile-devices',
            'defaults' => [
                'controller' => DeviceCollectionController::class
            ],

            'constraints' => [
                'user_id' => '\d+'
            ]
        ],
    ],
];
