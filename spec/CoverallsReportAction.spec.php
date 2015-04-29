<?php

namespace coverallskit\robo\spec;

use coverallskit\robo\CoverallsReportAction;
use coverallskit\ReportBuilder;
use coverallskit\entity\ReportEntity;
use coverallskit\entity\ServiceEntity;
use coverallskit\entity\RepositoryEntity;
use coverallskit\entity\collection\SourceFileCollection;
use Prophecy\Prophet;
use Prophecy\Argument;


describe(CoverallsReportAction::class, function() {
    beforeEach(function() {
        $this->tempDirectory = $this->makeDirectory();

        //Create a lcov report from template
        $reportContent = $this->loadFixture('mustache:lcovReport', [
            'rootDirectory' => realpath(__DIR__ . '/../')
        ]);

        $tempLcovReport = $this->tempDirectory->createNewFile('build_report.lcov');
        $tempLcovReport->write($reportContent);

        $this->tempLcovReport = $tempLcovReport;

        $this->coverallsReportPath = $this->tempDirectory->resolvePath('build_coveralls.json');

        //Create a coveralls config file from template
        $coverallsConfig = $this->loadFixture('mustache:coverallsConfig', [
            'repositoryDirectory' => realpath(__DIR__ . '/../'),
            'coverallsReportPath' => $this->coverallsReportPath,
            'lcovReportPath' => $tempLcovReport->getPath()
        ]);

        $tempCoverallsConfig = $this->tempDirectory->createNewFile('coveralls.toml');
        $tempCoverallsConfig->write($coverallsConfig);

        $this->tempCoverallsConfig = $tempCoverallsConfig;

        $this->prophat = new Prophet();

        $this->builder = $this->prophat->prophesize(ReportBuilder::class);
        $this->action = new CoverallsReportAction($this->builder->reveal());

        $this->service = Argument::type(ServiceEntity::class);
        $this->repository = Argument::type(RepositoryEntity::class);
        $this->sourceFiles = Argument::type(SourceFileCollection::class);
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
            $configPath = $this->tempCoverallsConfig->getPath();

            $this->action->configure( $configPath );
            $this->prophat->checkPredictions();
        });
    });
    describe('#save', function() {
        beforeEach(function() {
            $report = $this->prophat->prophesize(ReportEntity::class);
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
            $configPath = $this->tempCoverallsConfig->getPath();

            $this->action->configure($configPath);
            $this->action->build();
            $this->action->save();
            $this->prophat->checkPredictions();
        });
    });
    describe('#upload', function() {
        beforeEach(function() {
            $report = $this->prophat->prophesize(ReportEntity::class);
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
            $configPath = $this->tempCoverallsConfig->getPath();

            $this->action->configure($configPath);
            $this->action->build();
            $this->action->upload();
            $this->prophat->checkPredictions();
        });
    });
});
