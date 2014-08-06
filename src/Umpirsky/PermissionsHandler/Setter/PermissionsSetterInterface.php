<?php

namespace Umpirsky\PermissionsHandler\Setter;

use Umpirsky\PermissionsHandler\Command\PermissionsCommandInterface;

interface PermissionsSetterInterface
{
    /**
     * @param PermissionsCommandInterface $command
     * @param string                      $path
     *
     * @return void
     */
    public function setPermissions(PermissionsCommandInterface $command, $path);
}
