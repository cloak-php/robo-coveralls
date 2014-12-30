<?php

namespace cloak\robo\coveralls\task;

use coverallskit\Configuration;
use Robo\Task\Shared\TaskInterface;
use Robo\Result;


/**
 * Class CoverallsKitTask
 * @package cloak\robo\coveralls\task
 */
class CoverallsKitTask implements TaskInterface
{

    private $action;
    private $saveOnly;


    public function __construct()
    {
        $this->action = new CoverallsKitAction();
        $this->saveOnly = false;
    }

    public function configure($configPath)
    {
        $this->action->configure($configPath);
        return $this;
    }

    public function saveOnly()
    {
        $this->saveOnly = true;
        return $this;
    }

    public function run()
    {
        $this->action->build();

        if ($this->saveOnly) {
            $this->action->save();
        } else {
            $this->action->upload();
        }

        return Result::success($this);
    }

}
