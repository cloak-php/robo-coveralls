<?php

namespace coverallskit\robo;

use coverallskit\ReportBuilder;
use coverallskit\robo\task\CoverallsKitTask;


/**
 * Trait CoverallsKitTasks
 * @package coverallskit\robo
 */
trait CoverallsKitTasks
{

    protected function taskCoverallsKit()
    {
        $builder = new ReportBuilder();
        $action = new Action($builder);

        return new CoverallsKitTask($action);
    }

}
