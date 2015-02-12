<?php

namespace Umpirsky\PermissionsHandler;

use Umpirsky\PermissionsHandler\Exception\PathNotFoundException;

class SetfaclPermissionsSetter extends PermissionsSetter
{
    public function setPermissions($path)
    {
        if (!is_dir($path)) {
            throw new PathNotFoundException($path);
        }

        $this->runCommand('setfacl -m u:"%httpduser%":rwX -m u:`whoami`:rwX %path%', $path);
        $this->runCommand('setfacl -d -m u:"%httpduser%":rwX -m u:`whoami`:rwX %path%', $path);
    }
}
