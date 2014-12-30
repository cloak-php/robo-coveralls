<?php

namespace cloak\robo\coveralls\task;

use coverallskit\Configuration;
use coverallskit\ReportBuilder;
use Robo\Task\Shared\TaskInterface;
use Robo\Result;
use Robo\Output;


/**
 * Class Upload
 * @package cloak\robo\coveralls\task
 */
class Upload implements TaskInterface
{

    use Output;

    /**
     * @var \coverallskit\ReportBuilderInterface
     */
    private $builder;

    /**
     * @param string $configPath
     */
    public function __construct($configPath)
    {
        $configuration = Configuration::loadFromFile($configPath);
        $this->builder = ReportBuilder::fromConfiguration($configuration);
    }

    /**
     * @return Result
     */
    public function run()
    {
        $report = $this->builder->build();
        $report->upload();

        $message = sprintf('Sent a file %s to coveralls.', $report->getName());
        $this->yell($message);

        return Result::success($this);
    }

}
