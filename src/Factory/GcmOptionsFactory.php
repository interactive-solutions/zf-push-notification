<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Factory;

use InteractiveSolutions\PushNotification\GcmOptions;
use Interop\Container\ContainerInterface;

final class GcmOptionsFactory
{
    public function __invoke(ContainerInterface $container): GcmOptions
    {
        /* @var $config array */
        $config = $container->get('config');
        $config = $config['canine']['options'][GcmOptions::class];

        return new GcmOptions($config);
    }
}
