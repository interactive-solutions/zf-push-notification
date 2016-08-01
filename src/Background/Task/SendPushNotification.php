<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Background\Task;

use InteractiveSolutions\PushNotification\Background\Message\SendPushNotificationMessage;
use InteractiveSolutions\PushNotification\Service\PushNotificationService;
use Isis\Notification\Repository\NotificationRepository;

final class SendPushNotification
{
    /**
     * @var PushNotificationService
     */
    private $pushNotificationService;

    /**
     * @var NotificationRepository
     */
    private $notificationRepository;

    /**stop
     * SendPushNotification constructor.
     *
     * @param NotificationRepository  $notificationRepository
     * @param PushNotificationService $pushNotificationService
     */
    public function __construct(
        NotificationRepository $notificationRepository,
        PushNotificationService $pushNotificationService
    ) {
        $this->notificationRepository  = $notificationRepository;
        $this->pushNotificationService = $pushNotificationService;
    }

    /**
     * @param SendPushNotificationMessage $message
     */
    public function __invoke(SendPushNotificationMessage $message)
    {
        $notification = $this->notificationRepository->getById($message->getId());

        try {
            var_dump($this->pushNotificationService->send($notification));
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
            echo $e->getTraceAsString();
        }
    }
}
