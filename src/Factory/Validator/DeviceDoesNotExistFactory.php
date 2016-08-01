<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Factory\Validator;

use InteractiveSolutions\PushNotification\Entity\AbstractDeviceEntity;
use InteractiveSolutions\PushNotification\Validator\DeviceDoesNotExist;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManager;
use Zend\Validator\ValidatorPluginManager;

final class DeviceDoesNotExistFactory
{
    public function __invoke(ValidatorPluginManager $manager): DeviceDoesNotExist
    {
        /* @var $repository ObjectRepository */
        $repository = $manager->getServiceLocator()
            ->get(EntityManager::class)
            ->getRepository(AbstractDeviceEntity::class);

        return new DeviceDoesNotExist([
            'fields'            => 'deviceId',
            'object_repository' => $repository,
        ]);
    }
}
