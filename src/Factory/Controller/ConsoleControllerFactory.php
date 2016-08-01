<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Factory\Controller;

use InteractiveSolutions\PushNotification\Controller\ConsoleController;
use InteractiveSolutions\PushNotification\Service\PushNotificationService;
use Doctrine\ORM\EntityManager;
use Isis\Notification\Entity\NotificationEntity;
use Zend\Mvc\Controller\ControllerManager;

final class ConsoleControllerFactory
{
    public function __invoke(ControllerManager $manager): ConsoleController
    {
        $sl = $manager->getServiceLocator();

        return new ConsoleController(
            $sl->get(EntityManager::class)->getRepository(NotificationEntity::class),
            $sl->get(PushNotificationService::class)
        );
    }
}
