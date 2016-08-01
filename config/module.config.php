<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

use InteractiveSolutions\PushNotification\ApnsClient;
use InteractiveSolutions\PushNotification\ApnsOptions;
use InteractiveSolutions\PushNotification\Controller\ConsoleController;
use InteractiveSolutions\PushNotification\Controller\DeviceCollectionController;
use InteractiveSolutions\PushNotification\Factory\ApnsClientFactory;
use InteractiveSolutions\PushNotification\Factory\ApnsOptionsFactory;
use InteractiveSolutions\PushNotification\Factory\Controller\ConsoleControllerFactory;
use InteractiveSolutions\PushNotification\Factory\Controller\DeviceCollectionControllerFactory;
use InteractiveSolutions\PushNotification\Factory\GcmClientFactory;
use InteractiveSolutions\PushNotification\Factory\GcmOptionsFactory;
use InteractiveSolutions\PushNotification\Factory\Listener\PushNotificationListenerFactory;
use InteractiveSolutions\PushNotification\Factory\Service\DeviceServiceFactory;
use InteractiveSolutions\PushNotification\Factory\Service\PushNotificationServiceFactory;
use InteractiveSolutions\PushNotification\Factory\Validator\DeviceDoesNotExistFactory;
use InteractiveSolutions\PushNotification\GcmClient;
use InteractiveSolutions\PushNotification\GcmOptions;
use InteractiveSolutions\PushNotification\Listener\PushNotificationListener;
use InteractiveSolutions\PushNotification\Service\DeviceService;
use InteractiveSolutions\PushNotification\Service\PushNotificationService;
use InteractiveSolutions\PushNotification\Validator\DeviceDoesNotExist;

return [
    'service_manager' => [
        'factories' => [
            ApnsClient::class  => ApnsClientFactory::class,
            ApnsOptions::class => ApnsOptionsFactory::class,

            GcmClient::class  => GcmClientFactory::class,
            GcmOptions::class => GcmOptionsFactory::class,

            DeviceService::class           => DeviceServiceFactory::class,
            PushNotificationService::class => PushNotificationServiceFactory::class,

            PushNotificationListener::class => PushNotificationListenerFactory::class,
        ],
    ],

    'controllers' => [
        'factories' => [
            ConsoleController::class          => ConsoleControllerFactory::class,
            DeviceCollectionController::class => DeviceCollectionControllerFactory::class,
        ],
    ],

    'validators' => [
        'factories' => [
            DeviceDoesNotExist::class => DeviceDoesNotExistFactory::class,
        ],
    ],

    'doctrine' => include __DIR__ . '/doctrine.config.php',
    'router'   => [
        'routes' => include __DIR__ . '/route.config.php',
    ],

    'console' => [
        'router' => [
            'routes' => include __DIR__ . '/console.config.php',
        ],
    ],
];
