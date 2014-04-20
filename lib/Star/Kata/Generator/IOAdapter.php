<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Generator;

use PhpSpec\Console\IO;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

/**
 * Class IOAdapter
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Generator
 */
class IOAdapter extends IO
{
    public function __construct()
    {
        parent::__construct(new ArrayInput(array()), new NullOutput(), new HelperSet());
    }
}
 