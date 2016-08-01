<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Factory\Background\Task;

use InteractiveSolutions\PushNotification\Background\Task\SendPushNotification;
use InteractiveSolutions\PushNotification\Service\PushNotificationService;
use Doctrine\ORM\EntityManager;
use InteractiveSolutions\Bernard\Router\ConsumerTaskManager;
use Isis\Notification\Entity\NotificationEntity;

final class SendPushNotificationFactory
{
    public function __invoke(ConsumerTaskManager $manager): SendPushNotification
    {
        $container = $manager->getServiceLocator();

        return new SendPushNotification(
            $container->get(EntityManager::class)->getRepository(NotificationEntity::class),
            $container->get(PushNotificationService::class)
        );
    }
}
