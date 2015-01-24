<?php

namespace coverallskit\robo;

use coverallskit\ReportBuilder;


/**
 * Trait CoverallsKitTasks
 * @package coverallskit\robo
 */
trait CoverallsKitTasks
{

    protected function taskCoverallsKit()
    {
        $builder = new ReportBuilder();
        $action = new ReportAction($builder);

        return new CoverallsKitTask($action);
    }

}
