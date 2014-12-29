<?php

namespace cloak\robo\coveralls;

use cloak\robo\coveralls\task\Save;
use cloak\robo\coveralls\task\Upload;

trait CoverallsTasks
{

    protected function taskCoverallsSave($configPath)
    {
        return new Save($configPath);
    }

    protected function taskCoverallsUpload($configPath)
    {
        return new Upload($configPath);
    }

}
