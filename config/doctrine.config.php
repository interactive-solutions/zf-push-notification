<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

return [
    'driver' => [
        'canine_mobile_driver' => [
            'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
            'paths' => [
                'default' => __DIR__ . '/doctrine',
            ],
        ],

        'orm_default' => [
            'drivers' => [
                'InteractiveSolutions\PushNotification\Entity' => 'canine_mobile_driver',
            ],
        ],
    ],
];
