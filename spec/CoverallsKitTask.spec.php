<?php

namespace coverallskit\robo\spec\task;

use coverallskit\robo\CoverallsKitTask;
use coverallskit\robo\CoverallsReportAction;
use coverallskit\CoverallsReportBuilder;

describe(CoverallsKitTask::class, function() {
    describe('#run', function() {
        context('when save only', function() {
            beforeEach(function() {
                $tempDirectory = $this->makeDirectory();

                //Create a lcov report from template
                $reportContent = $this->loadFixture('mustache:lcovReport', [
                    'rootDirectory' => realpath(__DIR__ . '/../')
                ]);

                $tempLcovReport = $tempDirectory->createNewFile('build_report.lcov');
                $tempLcovReport->write($reportContent);

                $this->coverallsReportPath = $tempDirectory->resolvePath('build_coveralls.json');

                //Create a coveralls config file from template
                $coverallsConfig = $this->loadFixture('mustache:coverallsConfig', [
                    'repositoryDirectory' => realpath(__DIR__ . '/../'),
                    'coverallsReportPath' => $this->coverallsReportPath,
                    'lcovReportPath' => $tempLcovReport->getPath()
                ]);

                $tempCoverallsConfig = $tempDirectory->createNewFile('coveralls.toml');
                $tempCoverallsConfig->write($coverallsConfig);

                $this->configPath = $tempCoverallsConfig->getPath();

                $this->task = new CoverallsKitTask(new CoverallsReportAction(new CoverallsReportBuilder()));
                $this->task->configureBy($this->configPath)
                    ->saveOnly()
                    ->run();
            });
            it('save report file', function() {
                expect(file_exists($this->coverallsReportPath))->toBeTrue();
            });
        });
    });
});
