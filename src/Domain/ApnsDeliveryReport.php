<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Domain;

final class ApnsDeliveryReport
{
    /**
     * @var array
     */
    private $codes;

    /**
     * ApnsDeliveryReport constructor.
     *
     * @param array $codes
     */
    public function __construct(array $codes)
    {
        $this->codes = $codes;
    }

    /**
     * @return array
     */
    public function getCodes()
    {
        return $this->codes;
    }
}
