<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\PushNotification;

use Zend\Loader\StandardAutoloader;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface, AutoloaderProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getAutoloaderConfig():array
    {
        return [
            StandardAutoloader::class => [
                StandardAutoloader::LOAD_NS => [
                    __NAMESPACE__ => __DIR__ . '/src'
                ]
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    public function getConfig():array
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
