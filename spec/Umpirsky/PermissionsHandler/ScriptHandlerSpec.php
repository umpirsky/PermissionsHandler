<?php

namespace spec\Umpirsky\PermissionsHandler;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Composer\Script\CommandEvent;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ScriptHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Umpirsky\PermissionsHandler\ScriptHandler');
    }

    function it_should_set_permissions(
        CommandEvent $event,
        Composer $composer,
        PackageInterface $package,
        IOInterface $io
    ) {
        $event->getComposer()->shouldBeCalled()->willReturn($composer);
        $event->getIO()->shouldBeCalled()->willReturn($io);

        $composer->getPackage()->shouldBeCalled()->willReturn($package);
        $package->getExtra()->shouldBeCalled()->willReturn(
            array(
                'writable-dirs' => array(
                    sys_get_temp_dir() . DIRECTORY_SEPARATOR . time()
                )
            )
        );

        $this->setPermissions($event);
    }
}
