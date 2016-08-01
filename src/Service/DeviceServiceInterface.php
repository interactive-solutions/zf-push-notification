<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Service;

use InteractiveSolutions\PushNotification\Domain\DeviceRegistration;
use Canine\User\Entity\UserEntity;

interface DeviceServiceInterface
{
    /**
     * @param DeviceRegistration $device
     * @param UserEntity         $user
     *
     * @return void
     */
    public function register(DeviceRegistration $device, UserEntity $user);
}
