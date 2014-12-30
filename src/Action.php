<?php

namespace coverallskit\robo;

use coverallskit\Configuration;
use coverallskit\ReportBuilderInterface;
use Robo\Output;

/**
 * Class Action
 * @package coverallskit\robo
 */
class Action implements ActionInterface
{

    use Output;

    /**
     * @var ReportBuilderInterface
     */
    private $builder;

    /**
     * @var
     */
    private $report;


    /**
     * @param ReportBuilderInterface $builder
     */
    public function __construct(ReportBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param string $configPath
     */
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

        $message = sprintf('Sent a file %s to coveralls.', $this->report->getName());
        $this->yell($message);
    }

}
