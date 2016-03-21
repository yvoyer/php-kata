<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure\Filesystem;

use Star\Kata\Infrastructure\Filesystem\Exception\SourceFolderException;
use Symfony\Component\Filesystem\Filesystem;

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

        if (! is_dir($folder)) {
            throw SourceFolderException::sourceFolderMustBeADirectory($folder);
        }

        $this->folder = $folder;
    }

    /**
     * @param string $filename The path of the file, relative to root.
     * @param string $content
     *
     * @return string The full path to the file
     */
    public function writeFile($filename, $content)
    {
        $filename = $this->filePath($filename);
        file_put_contents($filename, $content);

        return $filename;
    }

    /**
     * @param string $filename The path of the file, relative to root.
     *
     * @return string The content of the file
     */
    public function readFile($filename)
    {
        $filePath = $this->filePath($filename);
        if (! file_exists($filePath)) {
            return '';
        }

        return file_get_contents($filePath);
    }

    /**
     * @param string $filename The path of the file, relative to root.
     *
     * @return string
     */
    public function filePath($filename)
    {
        // todo add guard against going lower than root.
        return $this->folder . DIRECTORY_SEPARATOR . $filename;
    }

    /**
     * @param string $filename The path of the file, relative to root.
     */
    public function removeFile($filename)
    {
        $filesystem = new Filesystem();
        $filesystem->remove($this->filePath($filename));
    }

    /**
     * @return string The path to root
     */
    public function url()
    {
        return $this->folder;
    }
}
