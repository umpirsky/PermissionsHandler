<?php

namespace spec\Umpirsky\PermissionsHandler;

use PhpSpec\ObjectBehavior;
use Composer\Script\CommandEvent;
use Composer\Composer;
use Composer\Package\PackageInterface;

class ConfigurationSpec extends ObjectBehavior
{
    function let(CommandEvent $event, Composer $composer, PackageInterface $package)
    {
        $this->beConstructedWith($event);

        $event->getComposer()->shouldBeCalled()->willReturn($composer);
        $composer->getPackage()->shouldBeCalled()->willReturn($package);
        $package->getExtra()->shouldBeCalled()->willReturn([
            'writable-dirs' => ['app/cache', 'app/logs']
        ]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Umpirsky\PermissionsHandler\Configuration');
    }

    function it_gets_writable_dirs()
    {
        $this->getWritableDirs()->shouldReturn(['app/cache', 'app/logs']);
    }

    function it_throws_exception_if_writable_dirs_are_not_configured($package)
    {
        $package->getExtra()->shouldBeCalled()->willReturn([]);

        $this->shouldThrow('Umpirsky\PermissionsHandler\Exception\InvalidConfigurationException')->duringGetWritableDirs();
    }
}
