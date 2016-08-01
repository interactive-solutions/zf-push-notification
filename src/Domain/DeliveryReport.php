<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Domain;

final class DeliveryReport
{
    /**
     * @var GcmDeliveryReport
     */
    private $gcmDeliveryReport;

    /**
     * @var ApnsDeliveryReport
     */
    private $apnsDeliveryReport;

    /**
     * DeliveryReport constructor.
     *
     * @param GcmDeliveryReport  $gcmDeliveryReport
     * @param ApnsDeliveryReport $apnsDeliveryReport
     */
    public function __construct(GcmDeliveryReport $gcmDeliveryReport, ApnsDeliveryReport $apnsDeliveryReport)
    {
        $this->gcmDeliveryReport  = $gcmDeliveryReport;
        $this->apnsDeliveryReport = $apnsDeliveryReport;
    }

    /**
     * @return GcmDeliveryReport
     */
    public function getGcmDeliveryReport(): GcmDeliveryReport
    {
        return $this->gcmDeliveryReport;
    }

    /**
     * @return ApnsDeliveryReport
     */
    public function getApnsDeliveryReport(): ApnsDeliveryReport
    {
        return $this->apnsDeliveryReport;
    }
}
