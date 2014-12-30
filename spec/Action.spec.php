<?php

use cloak\robo\coveralls\Action;
use Prophecy\Prophet;
use Prophecy\Argument;


describe('Action', function() {
    beforeEach(function() {
        $this->configPath = __DIR__ . '/fixtures/coveralls.toml';
        $this->reportPath = __DIR__ . '/../tmp/build_coveralls.json';

        $template = file_get_contents(__DIR__ . '/fixtures/report.lcov');
        $reportContent = str_replace('{rootDirectory}', realpath(__DIR__ . '/../'), $template);
        file_put_contents(__DIR__ . '/../tmp/build_report.lcov', $reportContent);

        $this->prophat = new Prophet();

        $this->builder = $this->prophat->prophesize('coverallskit\ReportBuilderInterface');
        $this->action = new Action($this->builder->reveal());

        $this->service = Argument::type('coverallskit\entity\ServiceInterface');
        $this->repository = Argument::type('coverallskit\entity\RepositoryInterface');
        $this->sourceFiles = Argument::type('coverallskit\entity\collection\SourceFileCollection');
        $this->reportFilePath = Argument::type('string');
    });
    describe('#configure', function() {
        beforeEach(function() {
            $this->builder->token('repo_token')->willReturn($this->builder);
            $this->builder->service($this->service)->willReturn($this->builder);
            $this->builder->repository($this->repository)->willReturn($this->builder);
            $this->builder->reportFilePath($this->reportFilePath)->willReturn($this->builder);
            $this->builder->addSources($this->sourceFiles)->willReturn($this->builder);
        });
        it('configure report builder', function() {
            $this->action->configure($this->configPath);
            $this->prophat->checkPredictions();
        });
    });
    describe('#save', function() {
        beforeEach(function() {
            $report = $this->prophat->prophesize('coverallskit\entity\ReportInterface');
            $report->getName()->shouldBeCalled();
            $report->save()->shouldBeCalled();

            $this->builder->token('repo_token')->willReturn($this->builder);
            $this->builder->service($this->service)->willReturn($this->builder);
            $this->builder->repository($this->repository)->willReturn($this->builder);
            $this->builder->reportFilePath($this->reportFilePath)->willReturn($this->builder);
            $this->builder->addSources($this->sourceFiles)->willReturn($this->builder);
            $this->builder->build()->willReturn($report->reveal());
        });
        it('save report', function() {
            $this->action->configure($this->configPath);
            $this->action->build();
            $this->action->save();
            $this->prophat->checkPredictions();
        });
    });
    describe('#upload', function() {
        beforeEach(function() {
            $report = $this->prophat->prophesize('coverallskit\entity\ReportInterface');
            $report->getName()->shouldBeCalled();
            $report->save()->shouldBeCalled();
            $report->upload()->shouldBeCalled();

            $this->builder->token('repo_token')->willReturn($this->builder);
            $this->builder->service($this->service)->willReturn($this->builder);
            $this->builder->repository($this->repository)->willReturn($this->builder);
            $this->builder->reportFilePath($this->reportFilePath)->willReturn($this->builder);
            $this->builder->addSources($this->sourceFiles)->willReturn($this->builder);
            $this->builder->build()->willReturn($report->reveal());
        });
        it('save report', function() {
            $this->action->configure($this->configPath);
            $this->action->build();
            $this->action->upload();
            $this->prophat->checkPredictions();
        });
    });
});
