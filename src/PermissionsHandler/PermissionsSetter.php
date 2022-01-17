<?php

declare(strict_types=1);

namespace Umpirsky\PermissionsHandler;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

abstract class PermissionsSetter implements PermissionsSetterInterface
{
    private $process;

    public function __construct(Process $process = null)
    {
        $this->process = $process;
    }

    /**
     * @return string
     */
    protected function getHttpdUser(): string
    {
        return $this->runProcess(
            "ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1"
        );
    }

    /**
     * @param $command
     * @param $path
     * @return void
     */
    protected function runCommand($command, $path)
    {
        $this->runProcess(str_replace(
            ['%httpduser%', '%path%'],
            [$this->getHttpdUser(), $path],
            $command
        ));
    }

    /**
     * @param $commandline
     * @return string
     */
    protected function runProcess($commandline): string
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
