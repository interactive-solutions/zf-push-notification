<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification\Factory;

use InteractiveSolutions\PushNotification\ApnsOptions;
use Interop\Container\ContainerInterface;

final class ApnsOptionsFactory
{
    public function __invoke(ContainerInterface $container): ApnsOptions
    {
        /* @var $config array */
        $config = $container->get('config');
        $config = $config['canine']['options'][ApnsOptions::class];

        return new ApnsOptions($config);
    }
}
