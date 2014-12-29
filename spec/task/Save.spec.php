<?php

use cloak\robo\coveralls\task\Save;

describe('Save', function() {
    describe('run', function() {
        beforeEach(function() {
            $this->configPath = __DIR__ . '/../fixtures/coveralls.toml';
            $this->reportPath = __DIR__ . '/../fixtures/tmp/coveralls.json';

            $template = file_get_contents(__DIR__ . '/../fixtures/tmp/report.lcov');
            $reportContent = str_replace('{rootDirectory}', realpath(__DIR__ . '/../../'), $template);
            file_put_contents(__DIR__ . '/../fixtures/tmp/compile_report.lcov', $reportContent);

            $this->task = new Save($this->configPath);
        });
        it('save report file', function() {
            $this->task->run();
            expect(file_exists($this->reportPath))->toBeTruthy();
        });
    });
});
