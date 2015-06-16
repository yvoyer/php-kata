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
     * @var string
     */
    private $srcPath;

    /**
     * @param string $srcPath
     */
    public function __construct($srcPath)
    {
        $this->srcPath = $srcPath;
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
        $filename = $this->srcPath . DIRECTORY_SEPARATOR . $name . '.php';
        file_put_contents($filename, $content);

        return $filename;
    }
}
