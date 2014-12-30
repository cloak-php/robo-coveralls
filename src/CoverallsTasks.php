<?php

namespace cloak\robo\coveralls;

use cloak\robo\coveralls\task\CoverallsKitTask;
use coverallskit\ReportBuilder;


/**
 * Trait CoverallsTasks
 * @package cloak\robo\coveralls
 */
trait CoverallsTasks
{

    protected function taskCoverallsKit()
    {
        $builder = new ReportBuilder();
        $action = new Action($builder);

        return new CoverallsKitTask($action);
    }

}
