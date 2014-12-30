<?php

namespace cloak\robo\coveralls;


interface ActionInterface
{

    public function configure($configPath);
    public function build();
    public function save();
    public function upload();

}
