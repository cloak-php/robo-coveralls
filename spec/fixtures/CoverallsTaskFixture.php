<?php

namespace coverallskit\robo\spec;

use coverallskit\robo\loadTasks;


/**
 * Class CoverallsTaskFixture
 * @package coverallskit\robo\spec
 */
class CoverallsTaskFixture
{

    use loadTasks;

    public function coverallsKit()
    {
        return $this->taskCoverallsKit();
    }

}
