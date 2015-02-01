<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata;

use Star\Kata\Command\ContinueCommand;
use Star\Kata\Command\StartCommand;
use Star\Kata\Infrastructure\KataInfrastructure;
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

    /**
     * @var KataInfrastructure
     */
    private $infrastructure;

    public function __construct($srcPath, KataInfrastructure $infrastructure)
    {
        parent::__construct('phpkata', self::VERSION);
        $this->srcPath = $srcPath;

        $this->add(new StartCommand($infrastructure->kataService()));
        $this->add(new ContinueCommand($infrastructure->kataRepository()));
    }
}
