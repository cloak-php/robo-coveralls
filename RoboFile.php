<?php

use Robo\Tasks;
use coverallskit\robo\loadTasks as CoverallsTasks;
use peridot\robo\loadTasks as PeridotTasks;


/**
 * Class RoboFile
 */
class RoboFile extends Tasks
{

    use CoverallsTasks;
    use PeridotTasks;


    public function specAll()
    {
        return $this->taskPeridot()
            ->directoryPath('spec')
            ->reporter('dot')
            ->run();
    }

    public function coverallsUpload()
    {
        $result = $this->taskCoverallsKit()
            ->configureBy('.coveralls.toml')
            ->run();

        return $result;
    }

}
