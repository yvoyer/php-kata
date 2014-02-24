<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Command;

use Star\Kata\KataApplication;

/**
 * Class KataCommand
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Command
 */
interface KataCommand
{
    /**
     * @param KataApplication $application
     */
    public function update(KataApplication $application);
}
 