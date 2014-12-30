<?php

namespace coverallskit\robo\task;

use coverallskit\robo\ActionInterface;
use coverallskit\Configuration;
use Robo\Task\Shared\TaskInterface;
use Robo\Result;

/**
 * Class CoverallsKitTask
 * @package coverallskit\robo\task
 */
class CoverallsKitTask implements TaskInterface
{

    /**
     * @var ActionInterface
     */
    private $action;

    /**
     * @var bool
     */
    private $saveOnly;


    /**
     * @param ActionInterface $action
     */
    public function __construct(ActionInterface $action)
    {
        $this->action = $action;
        $this->saveOnly = false;
    }

    /**
     * @param string $configPath
     * @return $this
     */
    public function configure($configPath)
    {
        $this->action->configure($configPath);
        return $this;
    }

    /**
     * @return $this
     */
    public function saveOnly()
    {
        $this->saveOnly = true;
        return $this;
    }

    /**
     * @return Result
     */
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
