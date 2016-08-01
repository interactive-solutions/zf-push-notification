<?php

use InteractiveSolutions\PushNotification\Controller\ConsoleController;

return [
    'push-notification' => [
        'options' => [
            'route'    => 'canine push-notification <id>',
            'defaults' => [
                'controller' => ConsoleController::class,
                'action'     => 'send-notification',
            ],
        ],
    ],
];
