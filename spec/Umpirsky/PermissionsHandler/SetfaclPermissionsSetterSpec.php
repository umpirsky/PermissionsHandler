<?php

namespace Spec\Umpirsky\PermissionsHandler;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Process\Process;

class SetfaclPermissionsSetterSpec extends ObjectBehavior
{
    function let(Process $process)
    {
        $this->beConstructedWith($process);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('APP\PermissionsHandler\SetfaclPermissionsSetter');
    }

    function it_is_permissions_setter()
    {
        $this->shouldHaveType('APP\PermissionsHandler\PermissionsSetterInterface');
    }
}
