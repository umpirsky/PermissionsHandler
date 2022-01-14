<?php

namespace Umpirsky\PermissionsHandler;

use Umpirsky\PermissionsHandler\Exception\PathNotFoundException;

class ChmodPermissionsSetter extends PermissionsSetter
{
    public function setPermissions($path)
    {
        if (!is_dir($path)) {
            throw new PathNotFoundException($path);
        }

        $this->runCommand('chmod +a "%httpduser% allow delete,write,append,file_inherit,directory_inherit" %path%', $path);
        $this->runCommand('chmod +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" %path%', $path);
    }
}
