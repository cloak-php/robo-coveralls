<?php

use Evenement\EventEmitterInterface;
use expectation\peridot\ExpectationPlugin;
use cloak\peridot\CloakPlugin;
use Peridot\Reporter\Dot\DotReporterPlugin;


return function(EventEmitterInterface $emitter)
{
    $dot = new DotReporterPlugin($emitter);
    ExpectationPlugin::create()->registerTo($emitter);
    CloakPlugin::create('cloak.toml')->registerTo($emitter);
};
