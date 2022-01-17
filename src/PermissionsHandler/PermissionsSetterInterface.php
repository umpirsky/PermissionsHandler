<?php

declare(strict_types=1);

namespace Umpirsky\PermissionsHandler;

interface PermissionsSetterInterface
{
    public function setPermissions($path);
}
