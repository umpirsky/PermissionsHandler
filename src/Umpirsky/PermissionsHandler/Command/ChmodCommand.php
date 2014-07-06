<?php

namespace Umpirsky\PermissionsHandler\Command;

class ChmodCommand implements PermissionsCommandInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDefinition()
    {
        return sprintf(
            '%s +a "%s allow delete,write,append,file_inherit,directory_inherit" %s',
            $this->getName(),
            PermissionsCommandInterface::USER_PLACEHOLDER,
            PermissionsCommandInterface::PATH_PLACEHOLDER
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'chmod';
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return 10;
    }
}
