<?php

namespace Umpirsky\PermissionsHandler;

use Composer\Script\CommandEvent;
use Umpirsky\PermissionsHandler\Exception\InvalidConfigurationException;

class Configuration
{
    private $configuration;

    public function __construct(CommandEvent $event)
    {
        $this->configuration = $event->getComposer()
            ->getPackage()
            ->getExtra()
        ;
    }

    public function getWritableDirs()
    {
        if (!isset($this->configuration['writable-dirs'])) {
            throw new InvalidConfigurationException('The writable-dirs must be specified in composer srbitrary extra data.');
        }

        if (!is_array($this->configuration['writable-dirs'])) {
            throw new InvalidConfigurationException('The writable-dirs must be an array.');
        }

        return $this->configuration['writable-dirs'];
    }
}
