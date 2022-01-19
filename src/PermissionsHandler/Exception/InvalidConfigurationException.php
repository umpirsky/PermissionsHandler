<?php

declare(strict_types=1);

namespace Umpirsky\PermissionsHandler\Exception;

use InvalidArgumentException;

class InvalidConfigurationException extends InvalidArgumentException implements ExceptionInterface
{
}
