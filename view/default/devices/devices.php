<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

use InteractiveSolutions\PushNotification\Entity\AbstractDeviceEntity;

$result = [];

$result['data'] = array_map(function (AbstractDeviceEntity $device) {
    return [
        'type'      => $device->getType(),
        'uuid'      => $device->getUuid(),
        'name'      => $device->getName(),
        'deviceId'  => $device->getDeviceId(),
        'createdAt' => $device->getCreatedAt()->format(DateTime::ISO8601),
    ];
}, $this->devices);

return $data;
