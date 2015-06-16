#!/usr/bin/env php
<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace {
    require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

    use Star\Fixture\AssertTrueKata;
    use Star\Kata\Infrastructure\Filesystem\FilesystemEnvironment;
    use Star\Kata\KataApplication;
    use Symfony\Component\Console\Input\ArgvInput;

    $environment = new FilesystemEnvironment(__DIR__ . DIRECTORY_SEPARATOR . 'src');
    $application = new KataApplication($environment, array(new AssertTrueKata()));
    $application->run(new ArgvInput($argv));
}
