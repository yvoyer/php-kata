#!/usr/bin/env php
<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace {
    require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

    use Star\Kata\Infrastructure\InMemoryInfrastructure;
    use Star\Kata\KataApplication;
    use Symfony\Component\Console\Input\ArgvInput;

    $application = new KataApplication(__DIR__ . DIRECTORY_SEPARATOR . 'src', new InMemoryInfrastructure());
    $application->run(new ArgvInput($argv));
}
