<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Configuration;

/**
 * Class Configuration
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Configuration
 */
class Configuration
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $srcPath;

    public function __construct($name, $srcPath)
    {
        $this->name = $name;
        $this->srcPath = $srcPath;
    }

    /**
     * Returns the Name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the SrcPath.
     *
     * @return string
     */
    public function getSrcPath()
    {
        return $this->srcPath;
    }
}
 