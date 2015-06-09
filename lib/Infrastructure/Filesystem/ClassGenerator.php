<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure\Filesystem;

/**
 * Class ClassGenerator
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Infrastructure\Filesystem
 */
class ClassGenerator
{
    /**
     * @var string
     */
    private $basePath;

    /**
     * @param string $srcPath
     */
    public function __construct($srcPath)
    {
        $this->basePath = $srcPath;
    }

    /**
     * @param string $className The full class name
     *
     * @return string The full path to the class
     */
    public function generate($className)
    {
        $code = <<<CODE
<?php
class $className
{
}
CODE;

        $filename = $this->basePath . DIRECTORY_SEPARATOR . $className . '.php';
        file_put_contents($filename, $code);

        return $filename;
    }
}
