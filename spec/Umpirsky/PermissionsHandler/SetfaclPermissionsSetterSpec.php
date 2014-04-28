<?php

namespace spec\Umpirsky\PermissionsHandler;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Process\Process;
use PhpSpec\Exception\Example\FailureException;

class SetfaclPermissionsSetterSpec extends ObjectBehavior
{
    function let(Process $process)
    {
        $this->beConstructedWith($process);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Umpirsky\PermissionsHandler\SetfaclPermissionsSetter');
    }

    function it_is_permissions_setter()
    {
        $this->shouldHaveType('Umpirsky\PermissionsHandler\PermissionsSetterInterface');
    }
}
