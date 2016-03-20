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
use Star\Kata\Domain\Extension\Core\CoreExtension;
use Star\Kata\Domain\KataService;
use Star\Kata\Infrastructure\InMemory\KataCollection;
use Star\Kata\Infrastructure\PHPUnit\PHPUnitKataRunner;
use Star\Kata\Infrastructure\Symfony\Event\SymfonyDispatcherPublisher;
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
     */
    public function __construct(Environment $environment)
    {
        parent::__construct('phpkata', self::VERSION);

        // todo Pass config instead ie. $config['publisher'] = 'symfony';
        $environment->setPublisher(new SymfonyDispatcherPublisher());
        $environment->registerExtension(new CoreExtension());

        $collection = $this->getDefaultKatas();
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
