<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Entity;

class AndroidDeviceEntity extends AbstractDeviceEntity
{
    const DEVICE_TYPE = 'android';

    public function getType():string
    {
        return self::DEVICE_TYPE;
    }
}
