<?php

namespace coverallskit\robo\spec\task;

use coverallskit\robo\task\CoverallsKitTask;
use coverallskit\robo\Action;
use coverallskit\ReportBuilder;


describe('CoverallsKitTask', function() {
    beforeEach(function() {
        $this->configPath = __DIR__ . '/../fixtures/coveralls.toml';
        $this->coverageReportPath = __DIR__ . '/../../tmp/build_report.lcov';
        $this->coverallsReportPath = __DIR__ . '/../../tmp/build_coveralls.json';
        $this->templatePath = __DIR__ . '/../fixtures/report.lcov';

        unlink($this->coverageReportPath);
        unlink($this->coverallsReportPath);

        $template = file_get_contents($this->templatePath);
        $reportContent = str_replace('{rootDirectory}', realpath(__DIR__ . '/../../'), $template);
        file_put_contents($this->coverageReportPath, $reportContent);
    });
    describe('#run', function() {
        context('when save only', function() {
            beforeEach(function() {
                $this->task = new CoverallsKitTask(new Action(new ReportBuilder()));
                $this->task->configure($this->configPath)
                    ->saveOnly()
                    ->run();
            });
            it('save report file', function() {
                expect(file_exists($this->coverallsReportPath))->toBeTruthy();
            });
        });
    });
});
