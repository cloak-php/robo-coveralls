<?php

use Robo\Tasks;
use coverallskit\robo\loadTasks;


/**
 * Class RoboFile
 */
class RoboFile extends Tasks
{

    use loadTasks;


    public function specAll()
    {
        $peridot = 'vendor/bin/peridot';
        $peridotSpecDirectory = 'spec';
        return $this->taskExec($peridot . ' ' . $peridotSpecDirectory)->run();
    }

    public function coverallsUpload()
    {
        $result = $this->taskCoverallsKit()
            ->configureBy('coveralls.toml')
            ->run();

        return $result;
    }

}
