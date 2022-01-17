<?php

declare(strict_types=1);

namespace Spec\Umpirsky\PermissionsHandler;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Process\Process;

class SetfaclPermissionsSetterSpec extends ObjectBehavior
{
    public function let(Process $process)
    {
        $this->beConstructedWith($process);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('APP\PermissionsHandler\SetfaclPermissionsSetter');
    }

    public function it_is_permissions_setter()
    {
        $this->shouldHaveType('APP\PermissionsHandler\PermissionsSetterInterface');
    }
}
