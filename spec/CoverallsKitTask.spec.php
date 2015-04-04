<?php

namespace coverallskit\robo\spec\task;

use coverallskit\robo\CoverallsKitTask;
use coverallskit\robo\ReportAction;
use coverallskit\ReportBuilder;


describe('CoverallsKitTask', function() {
    beforeEach(function() {
        $this->configPath = __DIR__ . '/fixtures/coveralls.toml';

        $templatePath = __DIR__ . '/fixtures/report.lcov';
        $template = file_get_contents($templatePath);

        $tempDirectory = $this->makeDirectory();
        $lcovReport = $tempDirectory->createFile('build_report.lcov');

        $reportContent = str_replace('{rootDirectory}', realpath(__DIR__ . '/../'), $template);
        file_put_contents($lcovReport->getPath(), $reportContent);

        $this->coverallsReport = $tempDirectory->createFile('build_coveralls.json');
    });
    describe('#run', function() {
        context('when save only', function() {
            beforeEach(function() {
                $this->task = new CoverallsKitTask(new ReportAction(new ReportBuilder()));
                $this->task->configureBy($this->configPath)
                    ->saveOnly()
                    ->run();
            });
            it('save report file', function() {
                expect(file_exists($this->coverallsReport->getPath()))->toBeTrue();
            });
        });
    });
});
