<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure\Filesystem;

/**
 * Class MethodGenerator
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Infrastructure\Filesystem
 */
final class MethodGenerator
{
    /**
     * @var SourceFolder
     */
    private $folder;

    /**
     * @param SourceFolder $folder
     */
    public function __construct(SourceFolder $folder)
    {
        $this->folder = $folder;
    }

    /**
     * @param string $name
     * @param array $args
     *
     * @return string The full path to the function file
     */
    public function generateMethod($name, array $args = array())
    {
        $content = <<<CODE
<?php
function $name()
{
}
CODE;

        return $this->folder->writeFile($name . '.php', $content);
    }
}
