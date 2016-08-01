<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Controller;

use InteractiveSolutions\PushNotification\Service\PushNotificationService;
use Isis\Notification\Repository\NotificationRepository;
use Zend\Console\Request;
use Zend\Mvc\Controller\AbstractConsoleController;

/**
 * Class ConsoleController
 *
 * @method Request getRequest()
 */
final class ConsoleController extends AbstractConsoleController
{
    /**
     * @var NotificationRepository
     */
    private $notificationRepository;

    /**
     * @var PushNotificationService
     */
    private $pushNotificationService;

    /**
     * ConsoleController constructor.
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

    public function sendNotificationAction()
    {
        $notification = $this->notificationRepository->getById((int) $this->getRequest()->getParam('id'));

        $report = $this->pushNotificationService->send($notification);

        print_r($report->getApnsDeliveryReport()->getCodes());
    }
}
