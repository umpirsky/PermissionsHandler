<?php

namespace Umpirsky\PermissionsHandler;

use Composer\Script\CommandEvent;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Umpirsky\PermissionsHandler\Command\ChmodCommand;
use Umpirsky\PermissionsHandler\Command\PermissionsCommandInterface;
use Umpirsky\PermissionsHandler\Command\SetfaclCommand;
use Umpirsky\PermissionsHandler\Setter\PermissionsSetter;
use Umpirsky\PermissionsHandler\Setter\PermissionsSetterInterface;

class ScriptHandler
{
    /**
     * @param CommandEvent $event
     */
    public static function setPermissions(CommandEvent $event)
    {
        $permissionsSetter = new PermissionsSetter();
        foreach (self::getCommands() as $command) {
            try {
                self::setPermissionsWithCommand(
                    $event,
                    $permissionsSetter,
                    $command
                );

                $event->getIO()->write(
                    sprintf('Setting up permissions using "%s"', $command->getName())
                );

                return;
            } catch (ProcessFailedException $exception) {
                // nothing to do
            }
        }

        $event->getIO()->write(
            sprintf('Setting up permissions failed')
        );
    }

    /**
     * @param CommandEvent                $event
     * @param PermissionsSetterInterface  $permissionsSetter
     * @param PermissionsCommandInterface $command
     */
    protected static function setPermissionsWithCommand(
        CommandEvent $event,
        PermissionsSetterInterface $permissionsSetter,
        PermissionsCommandInterface $command
    ) {
        $configuration = new Configuration($event);

        foreach ($configuration->getWritableDirs() as $path) {
            $permissionsSetter->setPermissions($command, $path);
        }
    }

    /**
     * @return PermissionsCommandInterface[]
     */
    protected static function getCommands()
    {
        $commands = array(
            new SetfaclCommand(),
            new ChmodCommand()
        );

        usort(
            $commands,
            function (PermissionsCommandInterface $a, PermissionsCommandInterface $b) {
                return $a->getPriority() < $b ->getPriority();
            }
        );


        return $commands;
    }
}
