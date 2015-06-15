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
use Star\Kata\Infrastructure\Filesystem\FilesystemEnvironment;
use Star\Kata\Infrastructure\InMemory\KataCollection;
use Star\Kata\KataDomain\KataService;
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
     * @var string
     */
    private $srcPath;

    public function __construct($srcPath)
    {
        parent::__construct('phpkata', self::VERSION);
        $this->srcPath = $srcPath;
        $env = new FilesystemEnvironment($srcPath);

        $collection = $this->getDefaultKatas();

        $service = new KataService($collection, $env);

        $this->add(new StartCommand($service));
        $this->add(new ContinueCommand($service));
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
