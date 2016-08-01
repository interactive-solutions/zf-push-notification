<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Domain;

final class DeviceRegistration
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $deviceId;

    /**
     * DeviceRegistration constructor.
     *
     * @param string $type
     * @param string $name
     * @param string $deviceId
     */
    public function __construct(string $type, string $name, string $deviceId)
    {
        $this->type     = $type;
        $this->name     = $name;
        $this->deviceId = $deviceId;
    }

    /**
     * @return string
     */
    public function getType():string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDeviceId():string
    {
        return $this->deviceId;
    }
}
