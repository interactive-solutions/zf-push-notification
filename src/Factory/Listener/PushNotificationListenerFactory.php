<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Factory\Listener;

use InteractiveSolutions\PushNotification\Listener\PushNotificationListener;
use InteractiveSolutions\Bernard\Middleware\Producer;
use Interop\Container\ContainerInterface;

final class PushNotificationListenerFactory
{
    public function __invoke(ContainerInterface $container): PushNotificationListener
    {
        return new PushNotificationListener($container->get(Producer::class));
    }
}
