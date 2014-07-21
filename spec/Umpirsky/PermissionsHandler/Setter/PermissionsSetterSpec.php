<?php

namespace spec\Umpirsky\PermissionsHandler\Setter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PermissionsSetterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Umpirsky\PermissionsHandler\Setter\PermissionsSetter');
    }

    function it_is_permissions_setter()
    {
        $this->shouldHaveType('Umpirsky\PermissionsHandler\Setter\PermissionsSetterInterface');
    }
}
