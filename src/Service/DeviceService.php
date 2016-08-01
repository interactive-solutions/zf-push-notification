<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Service;

use InteractiveSolutions\PushNotification\Domain\DeviceRegistration;
use InteractiveSolutions\PushNotification\Entity\AbstractDeviceEntity;
use InteractiveSolutions\PushNotification\Entity\AndroidDeviceEntity;
use InteractiveSolutions\PushNotification\Entity\AppleDeviceEntity;
use Canine\User\Entity\UserEntity;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;

final class DeviceService implements DeviceServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * DeviceService constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Convert a device type to it's entity class name
     *
     * @param string $type
     *
     * @return string
     */
    private function deviceTypeToClassName(string $type):string
    {
        switch ($type) {
            case 'apple':
                return AppleDeviceEntity::class;

            case 'android':
                return AndroidDeviceEntity::class;

            default:
                throw new InvalidArgumentException(sprintf('Unknown device type %s', $type));
        }
    }

    /**
     * @inheritDoc
     */
    public function register(DeviceRegistration $device, UserEntity $user)
    {
        $className = $this->deviceTypeToClassName($device->getType());

        /* @var $entity AbstractDeviceEntity */
        $entity = new $className;
        $entity->setName($device->getName());
        $entity->setDeviceId($device->getDeviceId());
        $entity->setCreatedAt(new DateTime());
        $entity->setOwner($user);

        $user->getDevices()->add($entity);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}
