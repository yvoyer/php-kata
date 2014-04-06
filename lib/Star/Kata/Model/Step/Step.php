<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model\Step;

/**
 * Interface Step
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model\Step
 */
interface Step
{
    const INTERFACE_NAME = __CLASS__;

    /**
     * Initialize the step.
     */
    public function init();

    /**
     * Returns the Class.
     *
     * @return string
     */
    public function getTestClass();

    /**
     * Returns the TestCase.
     *
     * @return string
     */
    public function getTestCase();

    /**
     * @return bool
     */
    public function isInitialized();
}
 