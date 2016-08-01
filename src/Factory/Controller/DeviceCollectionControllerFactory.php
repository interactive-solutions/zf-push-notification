<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Factory\Controller;

use InteractiveSolutions\PushNotification\Controller\DeviceCollectionController;
use InteractiveSolutions\PushNotification\Entity\AbstractDeviceEntity;
use InteractiveSolutions\PushNotification\Service\DeviceService;
use Canine\User\Entity\UserEntity;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\ControllerManager;

final class DeviceCollectionControllerFactory
{
    public function __invoke(ControllerManager $controllerManager): DeviceCollectionController
    {
        $sl = $controllerManager->getServiceLocator();

        return new DeviceCollectionController(
            $sl->get(DeviceService::class),
            $sl->get(EntityManager::class)->getRepository(UserEntity::class),
            $sl->get(EntityManager::class)->getRepository(AbstractDeviceEntity::class)
        );
    }
}
