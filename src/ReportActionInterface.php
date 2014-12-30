<?php

namespace coverallskit\robo;

/**
 * Interface ReportActionInterface
 * @package coverallskit\robo
 */
interface ReportActionInterface
{

    public function configure($configPath);
    public function build();
    public function save();
    public function upload();

}
