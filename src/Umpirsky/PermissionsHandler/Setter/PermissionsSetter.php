<?php

namespace Umpirsky\PermissionsHandler\Setter;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Umpirsky\PermissionsHandler\Command\PermissionsCommandInterface;

class PermissionsSetter implements PermissionsSetterInterface
{
    /**
     * @var Process
     */
    protected $process;

    /**
     * @param Process $process
     */
    public function __construct(Process $process = null)
    {
        $this->process = $process;
    }

    /**
     * {@inheritdoc}
     */
    public function setPermissions(PermissionsCommandInterface $command, $path)
    {
        $fs = new Filesystem();
        if (!$fs->exists($path)) {
            $fs->mkdir($path);
        }

        foreach ($this->getUsers() as $user) {
            $commandLine = str_replace(
                array(
                    PermissionsCommandInterface::USER_PLACEHOLDER,
                    PermissionsCommandInterface::PATH_PLACEHOLDER,
                ),
                array($user, $path),
                $command->getDefinition()
            );

            $this->runProcess($commandLine);
        }
    }

    /**
     * @return string
     */
    protected function getHttpdUser()
    {
        return $this->runProcess(
            "ps aux|grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx'|grep -v root|head -1|cut -d' ' -f1"
        );
    }

    /**
     * @return string[]
     */
    protected function getUsers()
    {
        $users = array('`whoami`');

        if ($httpdUser = $this->getHttpdUser()) {
            $users[] = $httpdUser;
        }

        return $users;
    }

    /**
     * @param string $commandline
     * @return string
     */
    protected function runProcess($commandline)
    {
        if (null === $this->process) {
            $this->process = new Process(null);
        }

        $this->process->setCommandLine($commandline);
        $this->process->run();
        if (!$this->process->isSuccessful()) {
            throw new ProcessFailedException($this->process);
        }

        return trim($this->process->getOutput());
    }
}
