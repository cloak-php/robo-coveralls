<?php

namespace coverallskit\robo\spec;

use coverallskit\robo\CoverallsKitTasks;


/**
 * Class CoverallsTaskFixture
 * @package coverallskit\robo\spec
 */
class CoverallsTaskFixture
{

    use CoverallsKitTasks;

    public function coverallsKit()
    {
        return $this->taskCoverallsKit();
    }

}
