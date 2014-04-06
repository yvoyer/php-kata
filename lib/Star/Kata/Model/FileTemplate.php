<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model;

/**
 * Class FileTemplate
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model
 */
class FileTemplate implements ClassTemplate
{
    /**
     * @var string
     */
    private $className;

    /**
     * @var string
     */
    private $content;

    /**
     * @param string $className
     * @param string $content
     */
    public function __construct($className, $content)
    {
        $this->className = $className;
        $this->content = $content;
    }

    /**
     * Return the name of the class to create.
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Return the content of the class definition.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
 