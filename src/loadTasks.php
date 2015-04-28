<?php

namespace coverallskit\robo;

use coverallskit\CoverallsReportBuilder;


/**
 * Trait loadTasks
 * @package coverallskit\robo
 */
trait loadTasks
{

    protected function taskCoverallsKit()
    {
        $builder = new CoverallsReportBuilder();
        $action = new ReportAction($builder);

        return new CoverallsKitTask($action);
    }

}
