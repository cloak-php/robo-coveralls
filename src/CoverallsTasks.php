<?php

namespace cloak\robo\coveralls;

use cloak\robo\coveralls\task\CoverallsKitTask;
use cloak\robo\coveralls\task\Save;
use cloak\robo\coveralls\task\Upload;


/**
 * Trait CoverallsTasks
 * @package cloak\robo\coveralls
 */
trait CoverallsTasks
{

    protected function taskCoverallsKit()
    {
        return new CoverallsKitTask();
    }

    /**
     * @param string $configPath
     * @return Save
     */
    protected function taskCoverallsSave($configPath)
    {
        return new Save($configPath);
    }

    /**
     * @param string $configPath
     * @return Upload
     */
    protected function taskCoverallsUpload($configPath)
    {
        return new Upload($configPath);
    }

}
