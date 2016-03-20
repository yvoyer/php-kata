<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

// todo Move all namespace to domain
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

        return $this->folder->writeFile($className . '.php', $code);
    }
}
