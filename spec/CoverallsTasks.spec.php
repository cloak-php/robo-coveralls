<?php

use cloak\robo\coveralls\spec\CoverallsTaskFixture;

describe('CoverallsTasks', function() {
    beforeEach(function() {
        $this->configPath = __DIR__ . '/fixtures/coveralls.toml';
        $this->reportPath = __DIR__ . '/../tmp/build_coveralls.json';

        $template = file_get_contents(__DIR__ . '/fixtures/report.lcov');
        $reportContent = str_replace('{rootDirectory}', realpath(__DIR__ . '/../'), $template);
        file_put_contents(__DIR__ . '/../tmp/build_report.lcov', $reportContent);

        $this->robo = new CoverallsTaskFixture();
    });
    describe('#taskCoverallsKit', function() {
        it('return cloak\robo\coveralls\task\CoverallsKitTask instance', function() {
            expect($this->robo->coverallsKit())->toBeAnInstanceOf('cloak\robo\coveralls\task\CoverallsKitTask');
        });
    });
});
