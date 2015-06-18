#!/usr/bin/env php
<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */
require_once __DIR__ . '/../../vendor/autoload.php';

use Star\ApplicationTester;
use Star\Kata\Infrastructure\Filesystem\FilesystemEnvironment;
use Symfony\Component\Console\Input\ArgvInput;

$environment = new FilesystemEnvironment(__DIR__ . DIRECTORY_SEPARATOR . 'tmp');
$application = new ApplicationTester($environment);
$application->run(new ArgvInput($argv));
