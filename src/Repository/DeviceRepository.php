<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Repository;

use Canine\User\Entity\UserEntity;
use Doctrine\ORM\EntityRepository;

final class DeviceRepository extends EntityRepository
{
    public function getAllForUser(UserEntity $user):array
    {
        $builder = $this->createQueryBuilder('device');
        $builder
            ->andWhere('device.owner = :owner')
            ->setParameter('owner', $user);

        return $builder->getQuery()->getResult();
    }
}
