<?php

namespace Star\Kata;

final class KataApplicationTester
{
    /**
     * @var \Symfony\Component\Console\Tester\ApplicationTester
     */
    private $tester;

    /**
     * @var KataApplication
     */
    private $application;

    public function __construct()
    {
        $this->application = new KataApplication(new TestEnvironment());
        $this->application->setAutoExit(false);
        $this->tester = new \Symfony\Component\Console\Tester\ApplicationTester($this->application);
    }

    /**
     * @param string $kataName
     *
     * @return \Symfony\Component\Console\Tester\ApplicationTester
     */
    public function executeStartCommand($kataName)
    {
        $this->tester->run(['command' => 'start', 'kata' => $kataName]);

        return $this->tester;
    }

    /**
     * @param string $kataName
     *
     * @return \Symfony\Component\Console\Tester\ApplicationTester
     */
    public function executeContinueCommand($kataName)
    {
        $this->tester->run(['command' => 'continue', 'kata' => $kataName]);

        return $this->tester;
    }
}
