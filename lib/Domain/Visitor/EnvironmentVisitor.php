<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Visitor;

use Star\Kata\Infrastructure\Filesystem\SourceFolder;

interface EnvironmentVisitor
{
    /**
     * @param SourceFolder $folder
     */
    public function visitSourceFolder(SourceFolder $folder);
}
