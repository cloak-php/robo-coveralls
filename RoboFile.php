<?php

use Robo\Tasks;
use cloak\robo\coveralls\CoverallsTasks;


/**
 * Class RoboFile
 */
class RoboFile extends Tasks
{

    use CoverallsTasks;


    public function specAll()
    {
        $peridot = 'vendor/bin/peridot';
        $peridotSpecDirectory = 'spec';
        return $this->taskExec($peridot . ' ' . $peridotSpecDirectory)->run();
    }

    public function coverallsUpload()
    {
        return $this->taskCoverallsUpload('coveralls.toml')->run();
    }

}
