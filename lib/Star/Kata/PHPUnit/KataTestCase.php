<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\PHPUnit;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Class KataTestCase
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\PHPUnit
 */
final class KataTestCase
{
    /**
     * @var string
     */
    private $code;

    /**
     * @param string $kataCode
     */
    public function __construct($kataCode)
    {
        $this->code = $kataCode;
    }

    /**
     * @param string $userCode
     *
     * @return \PHPUnit_Framework_TestResult
     */
    public function run($userCode)
    {
        $code = str_replace('###USER_INPUT###', $userCode, $this->code);
        $filename = __DIR__ . '/kata-assert.phpt';

        $fs = new Filesystem();
        $fs->dumpFile($filename, $code);

        $testCase = new \PHPUnit_Extensions_PhptTestCase($filename);
        $result = $testCase->run();

        $fs->remove($filename);

        return $result;
    }
}
