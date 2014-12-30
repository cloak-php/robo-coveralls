<?php

use cloak\robo\coveralls\task\CoverallsKitTask;
use cloak\robo\coveralls\Action;
use coverallskit\ReportBuilder;


describe('CoverallsKitTask', function() {
    beforeEach(function() {
        $this->configPath = __DIR__ . '/../fixtures/coveralls.toml';
        $this->reportPath = __DIR__ . '/../../tmp/build_coveralls.json';

        $template = file_get_contents(__DIR__ . '/../fixtures/report.lcov');
        $reportContent = str_replace('{rootDirectory}', realpath(__DIR__ . '/../../'), $template);
        file_put_contents(__DIR__ . '/../../tmp/build_report.lcov', $reportContent);
    });
    describe('#run', function() {
        beforeEach(function() {
            $this->task = new CoverallsKitTask(new Action(new ReportBuilder()));
            $this->task->configure($this->configPath)
                ->saveOnly()
                ->run();
        });
        it('configure report builder', function() {
            expect(file_exists($this->reportPath))->toBeTruthy();
        });
    });
});
