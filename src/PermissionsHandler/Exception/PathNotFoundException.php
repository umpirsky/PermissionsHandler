<?php

namespace Umpirsky\PermissionsHandler\Exception;

use InvalidArgumentException;
use Umpirsky\PermissionsHandler\Exception\ExceptionInterface;
use Umpirsky\PermissionsHandler\Exception\Process;

class PathNotFoundException extends InvalidArgumentException implements ExceptionInterface
{
    public function __construct(Process $process)
    {
        parent::__construct(sprintf('Path "%s" not found.', $path));
    }
}
