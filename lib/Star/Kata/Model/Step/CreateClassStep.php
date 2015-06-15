<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model\Step;

use Star\Kata\Configuration\Configuration;
use Star\Kata\Generator\ClassGenerator;
use Star\Kata\Model\ClassTemplate;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class CreateClassStep
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model\Step
 * @deprecated todo Remove
 */
class CreateClassStep implements Step
{
    /**
     * @var ClassGenerator
     */
    private $generator;

    /**
     * @var ClassTemplate
     */
    private $template;

    /**
     * @param ClassGenerator $classGenerator
     * @param ClassTemplate  $template
     */
    public function __construct(ClassGenerator $classGenerator, ClassTemplate $template)
    {
        $this->generator = $classGenerator;
        $this->template = $template;
    }

    public function init()
    {
        $this->generator->generate($this->template->getClassName());
    }

    /**
     * Returns the Class.
     *
     * @return string
     */
    public function getTestClass()
    {
        throw new \RuntimeException('Method ' . __CLASS__ . '::getTestClass() not implemented yet.');
    }

    /**
     * Returns the TestCase.
     *
     * @return string
     */
    public function getTestCase()
    {
        throw new \RuntimeException('Method ' . __CLASS__ . '::getTestCase() not implemented yet.');
    }

    /**
     * @return bool
     */
    public function isInitialized()
    {
        return class_exists($this->template->getClassName());
    }
}
