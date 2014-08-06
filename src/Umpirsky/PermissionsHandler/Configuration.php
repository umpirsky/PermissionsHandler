<?php

namespace Umpirsky\PermissionsHandler;

use Composer\Script\CommandEvent;
use Umpirsky\PermissionsHandler\Exception\InvalidConfigurationException;

class Configuration
{
    /**
     * @var array
     */
    protected $configuration;

    /**
     * @param CommandEvent $event
     */
    public function __construct(CommandEvent $event)
    {
        $this->configuration = $event
            ->getComposer()
            ->getPackage()
            ->getExtra();
    }

    /**
     * @return array
     */
    public function getWritableDirs()
    {
        if (!isset($this->configuration['writable-dirs'])) {
            throw new InvalidConfigurationException(
                'The writable-dirs must be specified in composer arbitrary extra data.'
            );
        }

        if (!is_array($this->configuration['writable-dirs'])) {
            throw new InvalidConfigurationException('The writable-dirs must be an array.');
        }

        return $this->configuration['writable-dirs'];
    }
}
