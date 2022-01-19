<?php

declare(strict_types=1);

namespace Umpirsky\PermissionsHandler\Exception;

use InvalidArgumentException;

class PathNotFoundException extends InvalidArgumentException implements ExceptionInterface
{
    public function __construct(Process $process)
    {
        parent::__construct(sprintf('Path "%s" not found.', $path));
    }
}
