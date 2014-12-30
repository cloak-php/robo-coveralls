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
    private $save;
    private $upload;


    public function __construct()
    {
        $this->action = new CoverallsKitAction();
    }

    public function configure($configPath)
    {
        $this->action->configure($configPath);
        return $this;
    }

    public function save()
    {
        $this->save = true;
        return $this;
    }

    public function upload()
    {
        $this->upload = true;
        return $this;
    }

    public function run()
    {
        $this->action->build();

        if ($this->save) {
            $this->action->save();
        }

        if ($this->upload) {
            $this->action->upload();
        }

        return Result::success($this);
    }

}
