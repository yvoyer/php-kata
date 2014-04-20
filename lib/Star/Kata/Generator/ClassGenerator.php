<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Generator;

use PhpSpec\CodeGenerator\Generator\ClassGenerator as PhpSpecClassGenerator;
use PhpSpec\CodeGenerator\TemplateRenderer;
use PhpSpec\Locator\PSR0\PSR0Locator;

/**
 * Class ClassGenerator
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Generator
 */
class ClassGenerator
{
    /**
     * @var \PhpSpec\CodeGenerator\Generator\ClassGenerator
     */
    private $generator;

    /**
     * @var \PhpSpec\Locator\PSR0\PSR0Locator
     */
    private $locator;

    /**
     * @param string $srcPath
     */
    public function __construct($srcPath = 'src')
    {
        $this->generator = new PhpSpecClassGenerator(new IOAdapter(), new TemplateRenderer());
        $this->locator = new PSR0Locator('', 'spec', $srcPath);
    }

    /**
     * @param string $className The full class name
     */
    public function generate($className)
    {
        $this->generator->generate($this->locator->createResource($className));
    }
}
 