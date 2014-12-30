<?php

namespace cloak\robo\coveralls\task;

use coverallskit\Configuration;
use coverallskit\ReportBuilder;
use Robo\Output;


/**
 * Class CoverallsKitAction
 * @package cloak\robo\coveralls\task
 */
class CoverallsKitAction
{

    use Output;

    private $builder;
    private $report;


    public function __construct()
    {
        $this->builder = new ReportBuilder();
    }

    public function configure($configPath)
    {
        $configuration = Configuration::loadFromFile($configPath);
        $configuration->applyTo($this->builder);
    }

    public function build()
    {
        $this->report = $this->builder->build();
    }

    public function save()
    {
        $this->report->save();

        $message = sprintf('The %s have been saved.', $this->report->getName());
        $this->yell($message);
    }

    public function upload()
    {
        $this->save();
        $this->report->upload();

        $message = sprintf('Sent a file %s to coveralls.', $report->getName());
        $this->yell($message);
    }

}
