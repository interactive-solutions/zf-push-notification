<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Factory;

use InteractiveSolutions\PushNotification\Listener\PushNotificationListener;
use Isis\Notification\Service\NotificationService;
use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

final class NotificationServiceDelegateFactory implements DelegatorFactoryInterface
{
    public function createDelegatorWithName(
        ServiceLocatorInterface $serviceLocator,
        $name,
        $requestedName,
        $callback
    ): NotificationService
    {

        /* @var $service NotificationService */
        $service = $callback();
        $service
            ->getEventManager()
            ->attach($serviceLocator->get(PushNotificationListener::class));

        return $service;
    }
}
