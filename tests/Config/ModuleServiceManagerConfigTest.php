<?php

namespace AssetManager\Core\Test\Config;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

/**
 * Test to ensure config file is properly setup and all services are retrievable
 *
 * @package AssetManager\Test\Config
 */
class ModuleServiceManagerConfigTest extends TestCase
{
    /**
     * Test the Service Managers Factories.
     *
     * @coversNothing
     */
    public function testServiceManagerFactories()
    {
        $config = include __DIR__ . '/../../config/module.config.php';

        $serviceManagerConfig = new Config($config['service_manager']);
        $serviceManager = new ServiceManager();
        $serviceManagerConfig->configureServiceManager($serviceManager);
        $serviceManager->setService('config', $config);

        foreach ($config['service_manager']['factories'] as $serviceName => $service) {
            $this->assertTrue($serviceManager->has($serviceName));

            //Make sure we can fetch the service
            $service = $serviceManager->get($serviceName);

            $this->assertTrue(is_object($service));
        }
    }

    /**
     * Test the Service Managers Invokables.
     *
     * @coversNothing
     */
    public function testServiceManagerInvokables()
    {
        $config = include __DIR__ . '/../../config/module.config.php';

        $serviceManagerConfig = new Config($config['service_manager']);
        $serviceManager = new ServiceManager();
        $serviceManagerConfig->configureServiceManager($serviceManager);
        $serviceManager->setService('config', $config);

        foreach ($config['service_manager']['invokables'] as $serviceName => $service) {
            $this->assertTrue($serviceManager->has($serviceName));

            //Make sure we can fetch the service
            $service = $serviceManager->get($serviceName);

            $this->assertTrue(is_object($service));
        }
    }
}
