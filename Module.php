<?php

namespace OmekaModuleStarterKit;

use Omeka\Module\AbstractModule;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;
use Zend\Config\Factory;
use Zend\Config\Reader\Yaml as YamlConfig;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Module extends AbstractModule implements DependencyIndicatorInterface
{
    private $config;

    public function loadVendor() {
        if (file_exists(__DIR__ . '/vendor/autoload.php')) {
            require_once __DIR__ . '/vendor/autoload.php';
        }
    }

    public function getConfig()
    {
        if ($this->config) {
            return $this->config;
        }
        // Load our composer dependencies.
        $this->loadVendor();
        // Load our configuration.
        Factory::registerReader('yaml', new YamlConfig([SymfonyYaml::class, 'parse']));
        $this->config = Factory::fromFiles(
            glob(__DIR__ . '/config/*.config.*')
        );
        return $this->config;
    }

    public function install(ServiceLocatorInterface $serviceLocator)
    {
        $connection = $serviceLocator->get('Omeka\Connection');
        $sqlToRunOnInstall = file_get_contents(__DIR__ . '/config/sql/install.sql');;
        if ($sqlToRunOnInstall) {
            $connection->exec($sqlToRunOnInstall);
        }
    }

    public function uninstall(ServiceLocatorInterface $serviceLocator)
    {
        $connection = $serviceLocator->get('Omeka\Connection');
        $sqlToRunOnUninstall = file_get_contents(__DIR__ . '/config/sql/uninstall.sql');;
        if ($sqlToRunOnUninstall) {
            $connection->exec($sqlToRunOnUninstall);
        }
    }

    public function getModuleDependencies()
    {
        // You can use this to enforce Twig in an installation if its required.
        // See open bug (https://github.com/omeka/omeka-s/issues/868)
        // return ['ZfcTwig'];
        return [];
    }
}
