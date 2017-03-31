<?php

namespace OmekaModuleStarterKit;

use LogicException;
use Omeka\Entity\Job;
use Omeka\Module\AbstractModule;
use Zend\ServiceManager\ServiceLocatorInterface;

class Module extends AbstractModule
{
    public function getConfig()
    {
        if (file_exists(__DIR__ . '/vendor/autoload.php')) {
            require_once __DIR__ . '/vendor/autoload.php';
        }
//        if (file_exists(__DIR__ . '/config/module.config.yaml')) {
//            $yaml = new Yaml(new Decoder);
//            return $yaml->fromFile(__DIR__ . '/config/module.config.yaml');
//        }
        if (file_exists(__DIR__ . '/config/module.config.php')) {
            return include __DIR__ . '/config/module.config.php';
        }
        throw new LogicException('Configuration not found.');
    }

    public function install(ServiceLocatorInterface $serviceLocator)
    {
        $connection = $serviceLocator->get('Omeka\Connection');
        $sqlToRunOnInstall = file_get_contents(__DIR__ . '/config/install.sql');;
        if ($sqlToRunOnInstall) {
            $connection->exec($sqlToRunOnInstall);
        }
    }

    public function uninstall(ServiceLocatorInterface $serviceLocator)
    {
        $connection = $serviceLocator->get('Omeka\Connection');
        $sqlToRunOnUninstall = file_get_contents(__DIR__ . '/config/uninstall.sql');;
        if ($sqlToRunOnUninstall) {
            $connection->exec($sqlToRunOnUninstall);
        }
    }
}
