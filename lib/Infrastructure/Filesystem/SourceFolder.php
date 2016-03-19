<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure\Filesystem;

use Star\Kata\Infrastructure\Filesystem\Exception\SourceFolderException;

final class SourceFolder
{
    /**
     * @var string
     */
    private $folder;

    /**
     * @param string $folder
     * @throws Exception\SourceFolderException
     */
    public function __construct($folder)
    {
        if (! file_exists($folder)) {
            throw SourceFolderException::sourceFolderDoNotExists($folder);
        }

        $this->folder = $folder;
    }

    /**
     * @param string $filename
     * @param string $code
     *
     * @return string The full path to the file
     */
    public function writeFile($filename, $code)
    {
        $filename = $this->folder . DIRECTORY_SEPARATOR . $filename;
        file_put_contents($filename, $code);

        return $filename;
    }

    /**
     * @return string
     */
    public function url()
    {
        return $this->folder;
    }
}
