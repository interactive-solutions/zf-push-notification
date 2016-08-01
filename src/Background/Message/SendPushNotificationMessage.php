<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Background\Message;

use InteractiveSolutions\PushNotification\Background\Task\SendPushNotification;
use InteractiveSolutions\Bernard\Serializer\AbstractExplicitMessage;

final class SendPushNotificationMessage extends AbstractExplicitMessage
{
    /**
     * @var int
     */
    private $id;

    /**
     * SendPushNotificationMessage constructor.
     *
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return SendPushNotification::class;
    }

    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    public function getQueue(): string
    {
        return 'canine:push-notifications';
    }
}
