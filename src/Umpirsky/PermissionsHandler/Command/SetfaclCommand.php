<?php

namespace Umpirsky\PermissionsHandler\Command;

class SetfaclCommand implements PermissionsCommandInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDefinition()
    {
        return sprintf(
            '%s -Rm u:%s:rwX,d:u:%s:rwX,g:%s:rwX,d:g:%s:rwX %s',
            $this->getName(),
            PermissionsCommandInterface::USER_PLACEHOLDER,
            PermissionsCommandInterface::USER_PLACEHOLDER,
            PermissionsCommandInterface::USER_PLACEHOLDER,
            PermissionsCommandInterface::USER_PLACEHOLDER,
            PermissionsCommandInterface::PATH_PLACEHOLDER
        );
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'setfacl';
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return 20;
    }
}
