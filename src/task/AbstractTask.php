<?php

namespace cloak\robo\coveralls\task;

use coverallskit\Configuration;
use coverallskit\ReportBuilder;
use Robo\Task\Shared\TaskInterface;
use Robo\Output;


/**
 * Class AbstractTask
 * @package cloak\robo\coveralls\task
 */
abstract class AbstractTask implements TaskInterface
{

    use Output;

    /**
     * @var \coverallskit\ReportBuilderInterface
     */
    protected $builder;


    /**
     * @param string $configPath
     */
    public function __construct($configPath)
    {
        $configuration = Configuration::loadFromFile($configPath);
        $this->builder = ReportBuilder::fromConfiguration($configuration);
    }

}
