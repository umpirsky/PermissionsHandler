<?php

namespace Umpirsky\PermissionsHandler;

use Composer\Script\CommandEvent;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ScriptHandler
{
    public static function setPermissions(CommandEvent $event)
    {
        if ('WIN' === strtoupper(substr(PHP_OS, 0, 3))) {
            $event->getIO()->write('No permissions setup is required on Windows.');
            return;
        }
        
        $event->getIO()->write('Setting up permissions.');

        try {
            self::setPermissionsSetfacl($event);

            return;
        } catch (ProcessFailedException $setfaclException) {
        }

        try {
            self::setPermissionsChmod($event);

            return;
        } catch (ProcessFailedException $chmodException) {
        }

        throw $setfaclException;
    }

    public static function setPermissionsSetfacl(CommandEvent $event)
    {
        self::setPermissionsWithSetter($event, new SetfaclPermissionsSetter());
    }

    public static function setPermissionsChmod(CommandEvent $event)
    {
        self::setPermissionsWithSetter($event, new ChmodPermissionsSetter());
    }

    private static function setPermissionsWithSetter(CommandEvent $event, PermissionsSetterInterface $permissionsSetter)
    {
        foreach ((new Configuration($event))->getWritableDirs() as $path) {
            $permissionsSetter->setPermissions($path);
        }
    }
}
