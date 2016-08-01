<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification;

use Zend\Stdlib\AbstractOptions;

final class ApnsOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $uri;

    /**
     * @var string
     */
    protected $certificate;

    /**
     * @var null
     */
    protected $passphrase = null;

    /**
     * @return string
     */
    public function getUri():string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getCertificate():string
    {
        return $this->certificate;
    }

    /**
     * @param string $certificate
     */
    public function setCertificate(string $certificate)
    {
        $this->certificate = $certificate;
    }

    /**
     * @return null
     */
    public function getPassphrase()
    {
        return $this->passphrase;
    }

    /**
     * @param null $passphrase
     */
    public function setPassphrase($passphrase)
    {
        $this->passphrase = $passphrase;
    }
}
