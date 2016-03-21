<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata;

use Star\Kata\Command\ContinueCommand;
use Star\Kata\Command\ShowCommand;
use Star\Kata\Command\StartCommand;
use Star\Kata\Data\Fibonacci\FibonacciKata;
use Star\Kata\Domain\Environment;
use Star\Kata\Domain\Extension\Core\CoreExtension;
use Star\Kata\Domain\KataRepository;
use Star\Kata\Domain\KataService;
use Star\Kata\Infrastructure\InMemory\KataCollection;
use Star\Kata\Infrastructure\PHPUnit\PHPUnitKataRunner;
use Star\Kata\Infrastructure\Symfony\Event\SymfonyDispatcherPublisher;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

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
     * @var Environment
     */
    private $environment;

    /**
     * @param Environment $environment
     */
    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
        // todo Pass config instead ie. $config['publisher'] = 'symfony';
        $this->environment->setPublisher(new SymfonyDispatcherPublisher());
        $this->environment->registerExtension(new CoreExtension());

        parent::__construct('phpkata', self::VERSION);
    }

    /**
     * @return KataRepository
     */
    protected function getDefaultKatas()
    {
        $collection = new KataCollection();
        $collection->addKata(new FibonacciKata());

        return $collection;
    }

    /**
     * Gets the default commands that should always be available.
     *
     * @return Command[] An array of default Command instances
     */
    protected function getDefaultCommands()
    {
        $service = new KataService($this->getDefaultKatas(), $this->environment, new PHPUnitKataRunner());

        return array_merge(
            parent::getDefaultCommands(),
            [
                new ShowCommand($service),
                new StartCommand($service),
                new ContinueCommand($service),
                // todo add reset command
            ]
        );
    }
}
