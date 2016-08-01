<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Factory\Service;

use InteractiveSolutions\PushNotification\ApnsClient;
use InteractiveSolutions\PushNotification\GcmClient;
use InteractiveSolutions\PushNotification\Service\PushNotificationService;
use Interop\Container\ContainerInterface;

final class PushNotificationServiceFactory
{
    public function __invoke(ContainerInterface $container): PushNotificationService
    {
        return new PushNotificationService(
            $container->get(ApnsClient::class),
            $container->get(GcmClient::class)
        );
    }
}
