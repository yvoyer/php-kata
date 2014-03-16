<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model;

/**
 * Class ClassTemplate
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model
 */
interface ClassTemplate
{
    /**
     * Return the name of the class to create.
     *
     * @return string
     */
    public function getClassName();

    /**
     * Return the content of the class definition.
     *
     * @return string
     */
    public function getContent();
}
 