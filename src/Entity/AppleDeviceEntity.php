<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Entity;

class AppleDeviceEntity extends AbstractDeviceEntity
{
    const DEVICE_TYPE = 'apple';

    public function getType():string
    {
        return self::DEVICE_TYPE;
    }
}
