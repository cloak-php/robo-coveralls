<?php

namespace cloak\robo\coveralls\task;

use coverallskit\Configuration;
use Robo\Result;


/**
 * Class Save
 * @package cloak\robo\coveralls\task
 */
class Save extends AbstractTask
{

    /**
     * @return Result
     */
    public function run()
    {
        $report = $this->builder->build();
        $report->save();

        $message = sprintf('The %s have been saved.', $report->getName());
        $this->yell($message);

        return Result::success($this);
    }

}
