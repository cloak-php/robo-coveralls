<?php

namespace coverallskit\robo;

use coverallskit\BuilderConfiguration;
use coverallskit\ReportBuilder;
use Robo\Common\IO;


/**
 * Class ReportAction
 * @package coverallskit\robo
 */
class ReportAction implements ReportActionInterface
{

    use IO;

    /**
     * @var ReportBuilder
     */
    private $builder;

    /**
     * @var \coverallskit\entity\ReportInterface
     */
    private $report;


    /**
     * @param ReportBuilder $builder
     */
    public function __construct(ReportBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param string $configPath
     */
    public function configure($configPath)
    {
        $configuration = BuilderConfiguration::loadFromFile($configPath);
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
