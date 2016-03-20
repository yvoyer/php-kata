<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Extension;

use Star\Kata\Domain\Environment;

interface KataExtension
{
    /**
     * @param Environment $environment
     */
    public function registerListeners(Environment $environment);
}
