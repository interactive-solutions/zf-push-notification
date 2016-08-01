<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Entity;

use Canine\User\Entity\UserEntity;
use DateTime;

abstract class AbstractDeviceEntity
{
    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $deviceId;

    /**
     * @var DateTime
     */
    protected $createdAt;

    /**
     * @var UserEntity
     */
    protected $owner;

    /**
     * @return string
     */
    public function getUuid():string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name = null)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDeviceId():string
    {
        return $this->deviceId;
    }

    /**
     * @param string $deviceId
     */
    public function setDeviceId(string $deviceId)
    {
        $this->deviceId = $deviceId;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt():DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return UserEntity
     */
    public function getOwner():UserEntity
    {
        return $this->owner;
    }

    /**
     * @param UserEntity $owner
     */
    public function setOwner(UserEntity $owner)
    {
        $this->owner = $owner;
    }

    abstract public function getType():string;
}
