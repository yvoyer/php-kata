<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata;

use Star\Kata\Command\ContinueCommand;
use Star\Kata\Command\StartCommand;
use Star\Kata\Data\Fibonacci\FibonacciKata;
use Star\Kata\Domain\Environment;
use Star\Kata\Domain\Kata;
use Star\Kata\Infrastructure\Filesystem\FilesystemEnvironment;
use Star\Kata\Infrastructure\InMemory\KataCollection;
use Star\Kata\Infrastructure\PHPUnit\PHPUnitKataRunner;
use Star\Kata\Domain\KataService;
use Symfony\Component\Console\Application;

/**
 * Class KataApplication
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata
 */
class KataApplication extends Application
{
    const VERSION = '0.1.0';

    /**
     * @param Environment $environment
     * @param Kata[] $katas
     */
    public function __construct(Environment $environment, array $katas = array())
    {
        parent::__construct('phpkata', self::VERSION);

        $collection = $this->getDefaultKatas();
        foreach ($katas as $kata) {
            $collection->addKata($kata);
        }

        $service = new KataService($collection, $environment, new PHPUnitKataRunner());

        $this->add(new StartCommand($service));
        $this->add(new ContinueCommand($service));
        // todo add reset command
    }

    /**
     * @return KataCollection
     */
    protected function getDefaultKatas()
    {
        $collection = new KataCollection();
        $collection->addKata(new FibonacciKata());

        return $collection;
    }
}
