<?php

namespace cloak\robo\coveralls\spec;

use cloak\robo\coveralls\CoverallsTasks;


/**
 * Class CoverallsTaskFixture
 * @package cloak\robo\coveralls\spec
 */
class CoverallsTaskFixture
{
    use CoverallsTasks;

    private $configPath;

    public function __construct()
    {
        $this->configPath = __DIR__ . '/coveralls.toml';
    }

    public function save()
    {
        return $this->taskCoverallsSave($this->configPath);
    }

    public function upload()
    {
        return $this->taskCoverallsUpload($this->configPath);
    }

}
