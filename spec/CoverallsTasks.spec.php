<?php

use cloak\robo\coveralls\spec\CoverallsTaskFixture;

describe('CoverallsTasks', function() {
    beforeEach(function() {
        $this->robo = new CoverallsTaskFixture();
    });
    describe('#taskCoverallsKit', function() {
        it('return cloak\robo\coveralls\task\CoverallsKitTask instance', function() {
            expect($this->robo->coverallsKit())->toBeAnInstanceOf('cloak\robo\coveralls\task\CoverallsKitTask');
        });
    });
});
