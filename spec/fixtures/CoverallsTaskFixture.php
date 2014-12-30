<?php

namespace cloak\robo\coveralls\spec;

use cloak\robo\coveralls\CoverallsTasks;


/**
 * Class CoverallsTaskFixture
 * @package cloak\robo\coveralls\spec
 */
class CoverallsTaskFixture
{

    use CoverallsTasks;

    public function coverallsKit()
    {
        return $this->taskCoverallsKit();
    }

}
