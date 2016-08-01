<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Listener;

use InteractiveSolutions\PushNotification\Background\Message\SendPushNotificationMessage;
use InteractiveSolutions\Bernard\Middleware\Producer;
use Isis\Notification\NotificationEvent;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateTrait;

final class PushNotificationListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    /**
     * @var Producer
     */
    private $producer;

    /**
     * PushNotificationListener constructor.
     *
     * @param Producer $producer
     */
    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
    }

    /**
     * @inheritDoc
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(NotificationEvent::NEW_USER_NOTIFICATION, [$this, 'onNotificationCreated']);
        $this->listeners[] = $events->attach(NotificationEvent::NEW_SYSTEM_NOTIFICATION, [$this, 'onNotificationCreated']);
    }

    /**
     * @param NotificationEvent $event
     */
    public function onNotificationCreated(NotificationEvent $event)
    {
        $this->producer->produce(new SendPushNotificationMessage($event->getNotification()->getId()));
    }
}
