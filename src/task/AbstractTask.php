<?php

namespace cloak\robo\coveralls\task;

use coverallskit\Configuration;
use coverallskit\ReportBuilder;
use coverallskit\entity\Report;
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
     * @var bool
     */
    private $verbose;


    /**
     * @param string $configPath
     */
    public function __construct($configPath)
    {
        $configuration = Configuration::loadFromFile($configPath);
        $this->builder = ReportBuilder::fromConfiguration($configuration);
        $this->verbose = false;
    }

    public function verbose()
    {
        $this->verbose = true;
        return false;
    }

    protected function isVerbose()
    {
        return $this->verbose;
    }

    protected function dump(Report $report)
    {
        if ($this->isVerbose() === false) {
            return;
        }
        $this->say($report->getName());
        $this->say('repo_token: ', $report->getToken());

        $values = $report->getService()->toArray();
        foreach ($values as $key => $value) {
            $this->say($key . ': ', $value);
        }

        $values = $report->getRepository()->getCommit()->toArray();
        foreach ($values as $key => $value) {
            $this->say($key . ': ', $value);
        }
    }

}
