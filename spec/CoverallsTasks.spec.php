<?php

use cloak\robo\coveralls\spec\CoverallsTaskFixture;

describe('CoverallsTasks', function() {
    beforeEach(function() {
        $this->configPath = __DIR__ . '/fixtures/coveralls.toml';
        $this->robo = new CoverallsTaskFixture();
    });
    describe('#taskCoverallsSave', function() {
        it('return cloak\robo\coveralls\task\Save instance', function() {
            expect($this->robo->save($this->configPath))->toBeAnInstanceOf('cloak\robo\coveralls\task\Save');
        });
    });
    describe('#taskCoverallsUpload', function() {
        it('return cloak\robo\coveralls\task\Upload instance', function() {
            expect($this->robo->upload($this->configPath))->toBeAnInstanceOf('cloak\robo\coveralls\task\Upload');
        });
    });
});
