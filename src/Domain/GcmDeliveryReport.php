<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Domain;

use ZendService\Google\Gcm\Response;

final class GcmDeliveryReport
{
    /**
     * @var int
     */
    private $success;

    /**
     * @var int
     */
    private $failure;

    /**
     * @var int
     */
    private $canonical;

    /**
     * GcmDeliveryReport constructor.
     *
     * @param int $success
     * @param int $failure
     * @param int $canonical
     */
    public function __construct(int $success, int $failure, int $canonical)
    {
        $this->success   = $success;
        $this->failure   = $failure;
        $this->canonical = $canonical;
    }

    public static function fromResponse(Response $response): self
    {
        return new self($response->getSuccessCount(), $response->getFailureCount(), $response->getCanonicalCount());
    }
}
