#!/usr/bin/env php
<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Star\Kata\Infrastructure\Filesystem\FilesystemEnvironment;
use Star\Kata\KataApplication;
use Symfony\Component\Console\Input\ArgvInput;

$application = new KataApplication(FilesystemEnvironment::setup(__DIR__, 'src'));
$application->run(new ArgvInput($argv));
