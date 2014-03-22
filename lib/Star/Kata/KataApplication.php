<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata;

use Star\Kata\Command\StartCommand;
use Star\Kata\Configuration\Configuration;
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
    private $root;

    /**
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->root = $configuration->getSrcPath();

        parent::__construct('phpkata', self::VERSION);
        $this->add(new StartCommand($configuration));
    }
}
 