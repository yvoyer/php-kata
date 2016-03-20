<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Extension\Core\Event\Listener;

use Star\Kata\Domain\Event\KataHasEnded;
use Star\Kata\Domain\Event\KataWasStarted;
use Star\Kata\Domain\Exception\CurrentKataException;
use Star\Kata\Infrastructure\Filesystem\SourceFolder;

final class ManageCurrentKata
{
    /**
     * @var SourceFolder
     */
    private $sourceFolder;

    public function __construct(SourceFolder $folder)
    {
        $this->sourceFolder = $folder;
    }

    /**
     * @param KataWasStarted $event
     */
    public function onKataWasStarted(KataWasStarted $event)
    {
        $this->sourceFolder->writeFile('.current_kata', $event->kata());
    }

    /**
     * @param KataHasEnded $event
     * @throws \Star\Kata\Domain\Exception\CurrentKataException
     */
    public function onKataHasEnded(KataHasEnded $event)
    {
        $current = $this->getCurrentKata();
        if ($current !== $event->kata()) {
            throw CurrentKataException::invalidContextOnEndKata($current, $event->kata());
        }

        $this->sourceFolder->removeFile('.current_kata');
    }

    /**
     * @return string
     * @throws \Star\Kata\Domain\Exception\CurrentKataException
     */
    public function getCurrentKata()
    {
        $kata = $this->sourceFolder->readFile('.current_kata');
        if (empty($kata)) {
            throw CurrentKataException::noCurrentKataAvailable();
        }

        return $kata;
    }
}
