<?php

namespace coverallskit\robo\task;

use coverallskit\Configuration;
use coverallskit\robo\ReportActionInterface;
use Robo\Contract\TaskInterface;
use Robo\Task\BaseTask;
use Robo\Result;


/**
 * Class CoverallsKitTask
 * @package coverallskit\robo\task
 */
class CoverallsKitTask extends BaseTask implements TaskInterface
{

    /**
     * @var ReportActionInterface
     */
    private $action;

    /**
     * @var bool
     */
    private $saveOnly;


    /**
     * @param ReportActionInterface $action
     */
    public function __construct(ReportActionInterface $action)
    {
        $this->action = $action;
        $this->saveOnly = false;
    }

    /**
     * @param string $configPath
     * @return $this
     */
    public function configureBy($configPath)
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
