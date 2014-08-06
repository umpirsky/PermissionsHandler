<?php

namespace Umpirsky\PermissionsHandler\Command;

interface PermissionsCommandInterface
{
    const USER_PLACEHOLDER = '{user}';
    const PATH_PLACEHOLDER = '{path}';

    /**
     * @return string
     */
    public function getDefinition();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return integer
     */
    public function getPriority();
}
