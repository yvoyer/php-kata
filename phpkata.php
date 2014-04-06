#!/usr/bin/env php
<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace {
    require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

    use Star\Kata\Configuration\YamlLoader;
    use Star\Kata\KataApplication;
    use Symfony\Component\Console\Input\ArgvInput;

    $loader = new YamlLoader();
    $application = new KataApplication($loader->load('kata' . DIRECTORY_SEPARATOR . 'php-kata.yml'));
    $application->run(new ArgvInput($argv));
}