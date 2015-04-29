<?php

namespace coverallskit\robo;

/**
 * Interface ReportAction
 * @package coverallskit\robo
 */
interface ReportAction
{

    public function configure($configPath);
    public function build();
    public function save();
    public function upload();

}
