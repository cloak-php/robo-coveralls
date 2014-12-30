<?php

namespace coverallskit\robo;

/**
 * Interface ActionInterface
 * @package coverallskit\robo
 */
interface ActionInterface
{

    public function configure($configPath);
    public function build();
    public function save();
    public function upload();

}
