<?php

use Robo\Tasks;
use coverallskit\robo\CoverallsKitTasks;


/**
 * Class RoboFile
 */
class RoboFile extends Tasks
{

    use CoverallsKitTasks;


    public function specAll()
    {
        $peridot = 'vendor/bin/peridot';
        $peridotSpecDirectory = 'spec';
        return $this->taskExec($peridot . ' ' . $peridotSpecDirectory)->run();
    }

    public function coverallsUpload()
    {
        $result = $this->taskCoverallsKit()
            ->configure('coveralls.toml')
            ->run();

        return $result;
    }

}
