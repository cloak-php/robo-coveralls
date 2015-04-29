<?php

namespace coverallskit\robo\spec\task;

use coverallskit\robo\CoverallsKitTask;
use coverallskit\robo\CoverallsReportAction;
use coverallskit\CoverallsReportBuilder;


describe(CoverallsKitTask::class, function() {
    beforeEach(function() {
        $this->configPath = $this->fixturePath('static:coverallsConfig');
        $this->coverageReportPath = __DIR__ . '/../tmp/build_report.lcov'; //temp
        $this->coverallsReportPath = __DIR__ . '/../tmp/build_coveralls.json'; //output tmp

        $reportContent = $this->loadFixture('mustache:lcovReport', [
            'rootDirectory' => realpath(__DIR__ . '/../')
        ]);

        unlink($this->coverageReportPath);
        unlink($this->coverallsReportPath);

        file_put_contents($this->coverageReportPath, $reportContent);
    });
    describe('#run', function() {
        context('when save only', function() {
            beforeEach(function() {
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
