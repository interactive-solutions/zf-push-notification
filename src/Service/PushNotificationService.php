<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Service;

use InteractiveSolutions\PushNotification\ApnsClient;
use InteractiveSolutions\PushNotification\Domain\ApnsDeliveryReport;
use InteractiveSolutions\PushNotification\Domain\DeliveryReport;
use InteractiveSolutions\PushNotification\Domain\GcmDeliveryReport;
use InteractiveSolutions\PushNotification\Entity\AbstractDeviceEntity;
use InteractiveSolutions\PushNotification\Entity\AndroidDeviceEntity;
use InteractiveSolutions\PushNotification\Entity\AppleDeviceEntity;
use InteractiveSolutions\PushNotification\GcmClient;
use Doctrine\Common\Collections\Collection;
use Isis\Notification\Entity\NotificationEntity;
use ZendService\Apple\Apns\Message as ApnsMessage;
use ZendService\Google\Gcm\Message as GcmMessage;

final class PushNotificationService
{
    /**
     * @var ApnsClient
     */
    private $apnsClient;

    /**
     * @var GcmClient
     */
    private $gcmClient;

    /**
     * @param ApnsClient $apnsClient
     * @param GcmClient  $gcmClient
     */
    public function __construct(ApnsClient $apnsClient, GcmClient $gcmClient)
    {
        $this->gcmClient  = $gcmClient;
        $this->apnsClient = $apnsClient;
    }

    /**
     * @param NotificationEntity $notification
     *
     * @return DeliveryReport
     */
    public function send(NotificationEntity $notification): DeliveryReport
    {
        // todo: check receiver settings

        /* @var $devices Collection */
        $devices = $notification->getReceiver()->getDevices();

        $apnsDeliveryReport = $this->apns($notification, $devices->filter(function (AbstractDeviceEntity $device) {
            return $device instanceof AppleDeviceEntity;
        }));

        $gcmDeliveryReport = $this->gsm($notification, $devices->filter(function (AbstractDeviceEntity $device) {
            return $device instanceof AndroidDeviceEntity;
        }));

        return new DeliveryReport($gcmDeliveryReport, $apnsDeliveryReport);
    }

    /**
     * Send the notifications to all apple devices
     *
     * @param NotificationEntity             $notification
     * @param Collection|AppleDeviceEntity[] $devices
     *
     * @return ApnsDeliveryReport
     */
    private function apns(NotificationEntity $notification, Collection $devices): ApnsDeliveryReport
    {
        $this->apnsClient->open();

        $alert = new ApnsMessage\Alert();
        $alert->setLocKey($notification->getAdditionalInformation()->getLocKey());
        $alert->setLocArgs($notification->getAdditionalInformation()->getLocArgs());
        $alert->setBody($notification->getType());

        $message = new ApnsMessage();
        $message->setAlert($alert);
        $message->setCustom([
            'payload' => $notification->getAdditionalInformation()->toArray(),
        ]);

        $codes = [];

        foreach ($devices as $device) {
            $msg = clone $message;
            $msg->setToken($device->getDeviceId());

            // todo: handle exceptions
            $response = $this->apnsClient->send($msg);

            $codes[] = $response->getCode();
        }

        $this->apnsClient->close();

        return new ApnsDeliveryReport($codes);
    }

    /**
     * Gcm delivery report
     *
     * @param NotificationEntity $notification
     * @param Collection         $devices
     *
     * @return GcmDeliveryReport
     */
    private function gsm(NotificationEntity $notification, Collection $devices): GcmDeliveryReport
    {
        $registrationIds = $devices->map(function (AndroidDeviceEntity $device) {
            return $device->getDeviceId();
        });

        if ($registrationIds->count() === 0) {
            return new GcmDeliveryReport(0, 0, 0);
        }

        $message = new GcmMessage();
        $message->setRegistrationIds($registrationIds->toArray());
        $message->setData([
            'type'    => $notification->getType(),
            'payload' => $notification->getAdditionalInformation(),
        ]);

        $response = $this->gcmClient->send($message);

        return GcmDeliveryReport::fromResponse($response);
    }
}
