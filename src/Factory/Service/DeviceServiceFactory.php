<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Factory\Service;

use InteractiveSolutions\PushNotification\Service\DeviceService;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

final class DeviceServiceFactory
{
    public function __invoke(ContainerInterface $container): DeviceService
    {
        return new DeviceService($container->get(EntityManager::class));
    }
}
