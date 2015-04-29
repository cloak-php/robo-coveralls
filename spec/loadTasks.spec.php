<?php

namespace coverallskit\robo\spec;

use coverallskit\robo\CoverallsKitTask;

describe('loadTasks', function() {
    beforeEach(function() {
        $this->robo = new CoverallsTaskFixture();
    });
    describe('#taskCoverallsKit', function() {
        it('return coverallskit\robo\CoverallsKitTask instance', function() {
            expect($this->robo->coverallsKit())->toBeAnInstanceOf(CoverallsKitTask::class);
        });
    });
});
