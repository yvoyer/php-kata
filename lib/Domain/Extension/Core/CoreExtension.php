<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Extension\Core;

use Star\Kata\Domain\Environment;
use Star\Kata\Domain\Event\KataHasEnded;
use Star\Kata\Domain\Event\KataWasStarted;
use Star\Kata\Domain\Visitor\EnvironmentVisitor;
use Star\Kata\Domain\Extension\Core\Event\Listener\ManageCurrentKata;
use Star\Kata\Infrastructure\Filesystem\SourceFolder;
use Star\Kata\Domain\Extension\KataExtension;

final class CoreExtension implements KataExtension, EnvironmentVisitor
{
    /**
     * @var SourceFolder
     */
    private $sourceFolder;

    /**
     * @param Environment $environment
     */
    public function registerListeners(Environment $environment)
    {
        $environment->acceptEnvironmentVisitor($this);
        $environment->addListener(KataWasStarted::class, [new ManageCurrentKata($this->sourceFolder), 'onKataWasStarted']);
        $environment->addListener(KataHasEnded::class, [new ManageCurrentKata($this->sourceFolder), 'onKataHasEnded']);
    }

    /**
     * @param SourceFolder $folder
     */
    public function visitSourceFolder(SourceFolder $folder)
    {
        $this->sourceFolder = $folder;
    }
}
