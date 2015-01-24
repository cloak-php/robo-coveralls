<?php

namespace coverallskit\robo;

use coverallskit\ReportBuilder;


/**
 * Trait loadTasks
 * @package coverallskit\robo
 */
trait loadTasks
{

    protected function taskCoverallsKit()
    {
        $builder = new ReportBuilder();
        $action = new ReportAction($builder);

        return new CoverallsKitTask($action);
    }

}
