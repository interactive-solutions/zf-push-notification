<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification;

use ZendService\Apple\Apns\Client\Message;
use ZendService\Apple\Apns\Message as ApnsMessage;
use ZendService\Apple\Apns\Response\Message as MessageResponse;

/**
 * Class ApnsClient
 *
 * Proxy class because of shitty implementation
 */
final class ApnsClient
{
    const SANDBOX_URI    = 0;
    const PRODUCTION_URI = 1;

    /**
     * @var string
     */
    private $environment;

    /**
     * @var string
     */
    private $certificate;

    /**
     * @var null|string
     */
    private $passPhrase;

    /**
     * ApnsClient constructor.
     *
     * @param string      $environment
     * @param string      $certificate
     * @param string|null $passPhrase
     */
    public function __construct(string $environment, string $certificate, string $passPhrase = null)
    {
        $this->environment = $environment;
        $this->certificate = $certificate;
        $this->passPhrase  = $passPhrase;

        $this->client = new Message();
    }

    public function open()
    {
        $this->client->open($this->environment, $this->certificate, $this->passPhrase);
    }

    public function send(ApnsMessage $message): MessageResponse
    {
        return $this->client->send($message);
    }

    public function close()
    {
        $this->client->close();
    }
}
