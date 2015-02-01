<?php

namespace coverallskit\robo\spec;


describe('loadTasks', function() {
    beforeEach(function() {
        $this->robo = new CoverallsTaskFixture();
    });
    describe('#taskCoverallsKit', function() {
        it('return coverallskit\robo\CoverallsKitTask instance', function() {
            expect($this->robo->coverallsKit())->toBeAnInstanceOf('coverallskit\robo\CoverallsKitTask');
        });
    });
});
