<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure\Filesystem\Exception;

use Star\Kata\Domain\Exception\KataException;

final class SourceFolderException extends \Exception implements KataException
{
    /**
     * @param string $folder
     *
     * @return SourceFolderException
     */
    public static function sourceFolderDoNotExists($folder)
    {
        return new self("The source folder '{$folder}' do not exists.");
    }
}
