<?php

namespace Umpirsky\PermissionsHandler;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

abstract class PermissionsSetter implements PermissionsSetterInterface
{
    private $process;

    public function __construct(Process $process = null)
    {
        $this->process = $process;
    }

    protected function getHttpdUser()
    {
        return $this->runProcess(
            "ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1"
        );
    }

    protected function runCommand($command, $path)
    {
        $this->runProcess(str_replace(
            array('%httpduser%', '%path%'),
            array($this->getHttpdUser(), $path),
            $command
        ));
    }

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
