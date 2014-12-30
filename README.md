robo-coveralls-kit
==================

**robo-coveralls-kit** is a library to send the report to the coveralls.  
Installation of [Robo PHP Task Runner](http://robo.li/) will be mandatory to use it.


[![Latest Stable Version](https://poser.pugx.org/cloak/robo-coveralls-kit/v/stable.svg)](https://packagist.org/packages/cloak/robo-coveralls-kit)
  [![Latest Unstable Version](https://poser.pugx.org/cloak/robo-coveralls-kit/v/unstable.svg)](https://packagist.org/packages/cloak/robo-coveralls-kit)
[![Build Status](https://travis-ci.org/cloak-php/robo-coveralls-kit.svg?branch=master)](https://travis-ci.org/cloak-php/robo-coveralls-kit)
[![Coverage Status](https://coveralls.io/repos/cloak-php/robo-coveralls-kit/badge.png)](https://coveralls.io/r/cloak-php/robo-coveralls)

Basic Usage
----------------------------------

Specify the configuration file, you can send the file the report just run.  
For more information about the configuration file, please refer to the [coveralls-kit](https://github.com/cloak-php/coveralls-kit).

```php
class RoboFile extends Tasks
{
	use \coverallskit\robo\CoverallsKitTasks;

	public function coverallsUpload()
	{
		$result = $this->taskCoverallsKit()
			->configure('coveralls.toml')
			->run();

		return $result;
	}
}
```

Output only the report file
----------------------------------

Only to output the report to confirm you can use the **saveOnly** method.  
Just generate a report file, but does not upload.

```php
public function coverallsTest()
{
	$result = $this->taskCoverallsKit()
		->configure('coveralls.toml')
		->saveOnly()
		->run();

	return $result;
}
```


Testing robo-coveralls-kit
----------------------------------

Please try the following command.

	composer install
	composer test
