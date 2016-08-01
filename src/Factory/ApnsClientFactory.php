<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Factory;

use InteractiveSolutions\PushNotification\ApnsClient;
use InteractiveSolutions\PushNotification\ApnsOptions;
use Interop\Container\ContainerInterface;

final class ApnsClientFactory
{
    public function __invoke(ContainerInterface $container): ApnsClient
    {
        /* @var $options ApnsOptions */
        $options = $container->get(ApnsOptions::class);

        return new ApnsClient($options->getUri(), $options->getCertificate(), $options->getPassphrase());
    }
}
