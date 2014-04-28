<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata;

use Star\Kata\Command\ContinueCommand;
use Star\Kata\Command\StartCommand;
use Star\Kata\Configuration\Configuration;
use Star\Kata\Data\FibonacciKata;
use Star\Kata\Model\KataCollection;
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

        $collection = $this->getDefaultKatas();
        $this->add(new StartCommand($collection));
        $this->add(new ContinueCommand($collection));
    }

    /**
     * @return KataCollection
     */
    protected function getDefaultKatas()
    {
        $collection = new KataCollection();
        $collection->addKata(new FibonacciKata($this->srcPath));

        return $collection;
    }
}
 