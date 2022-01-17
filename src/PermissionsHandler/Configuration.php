<?php

declare(strict_types=1);

namespace Umpirsky\PermissionsHandler;

use Umpirsky\PermissionsHandler\Exception\InvalidConfigurationException;
use Composer\Script\Event;

class Configuration
{
    private $configuration;

    /**
     * @param Event $event
     */
    public function __construct(Event $event)
    {
        $this->configuration = $event->getComposer()
            ->getPackage()
            ->getExtra();
    }

    /**
     * @return array
     */
    public function getWritableDirs(): array
    {
        if (!isset($this->configuration['writable-dirs'])) {
            throw new InvalidConfigurationException('The writable-dirs must be specified in composer arbitrary extra data.');
        }

        if (!is_array($this->configuration['writable-dirs'])) {
            throw new InvalidConfigurationException('The writable-dirs must be an array.');
        }

        return $this->configuration['writable-dirs'];
    }
}
