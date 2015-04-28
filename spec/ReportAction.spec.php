<?php

namespace coverallskit\robo\spec;

use coverallskit\robo\ReportAction;
use Prophecy\Prophet;
use Prophecy\Argument;


describe('ReportAction', function() {
    beforeEach(function() {
        $this->configPath = __DIR__ . '/fixtures/coveralls.toml';
        $this->coverageReportPath = __DIR__ . '/../tmp/build_report.lcov';
        $this->coverallsReportPath = __DIR__ . '/../tmp/build_coveralls.json';
        $this->templatePath = __DIR__ . '/fixtures/report.lcov';

        unlink($this->coverageReportPath);
        unlink($this->coverallsReportPath);

        $template = file_get_contents($this->templatePath);
        $reportContent = str_replace('{rootDirectory}', realpath(__DIR__ . '/../'), $template);
        file_put_contents($this->coverageReportPath, $reportContent);

        $this->prophat = new Prophet();

        $this->builder = $this->prophat->prophesize('coverallskit\ReportBuilder');
        $this->action = new ReportAction($this->builder->reveal());

        $this->service = Argument::type('coverallskit\entity\ServiceEntity');
        $this->repository = Argument::type('coverallskit\entity\RepositoryEntity');
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
            $report = $this->prophat->prophesize('coverallskit\entity\ReportEntity');
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
            $report = $this->prophat->prophesize('coverallskit\entity\ReportEntity');
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
