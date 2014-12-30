<?php

namespace cloak\robo\coveralls\task;

use coverallskit\Configuration;
use Robo\Result;


/**
 * Class Upload
 * @package cloak\robo\coveralls\task
 */
class Upload extends AbstractTask
{

    /**
     * @return Result
     */
    public function run()
    {
        $report = $this->builder->build();
        $report->upload();

        $message = sprintf('Sent a file %s to coveralls.', $report->getName());
        $this->yell($message);

        return Result::success($this);
    }

}
