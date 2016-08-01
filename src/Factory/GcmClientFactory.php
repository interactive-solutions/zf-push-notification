<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Factory;

use InteractiveSolutions\PushNotification\GcmClient;
use InteractiveSolutions\PushNotification\GcmOptions;
use Interop\Container\ContainerInterface;

final class GcmClientFactory
{
    public function __invoke(ContainerInterface $container): GcmClient
    {
        /* @var $options GcmOptions */
        $options = $container->get(GcmOptions::class);

        return new GcmClient($options->getApiKey());
    }
}
