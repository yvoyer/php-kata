<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model\Step;

use Star\Kata\Configuration\Configuration;
use Star\Kata\Model\ClassTemplate;

/**
 * Class CreateClassStep
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model\Step
 */
class CreateClassStep implements Step
{
    /**
     * @var string
     */
    private $root;

    /**
     * @var string
     */
    private $class;

    /**
     * @var ClassTemplate
     */
    private $template;

    /**
     * @param string $path
     * @param \Star\Kata\Model\ClassTemplate $template
     */
    public function __construct($path, ClassTemplate $template)
    {
        $this->root = $path;
        $this->class = $template->getClassName() . '.php';
        $this->template = $template;
    }

    public function init()
    {
        $basePath = $this->root;
        foreach ($this->getFolders() as $folder) {
            $basePath .= DIRECTORY_SEPARATOR . $folder;
            $this->createFolder($basePath);
        }

        $basePath .= DIRECTORY_SEPARATOR . $this->getFileName();
        if (false === file_exists($basePath)) {
            file_put_contents($basePath, $this->template->getContent());
        }
    }

    /**
     * @return array
     */
    private function getFolders()
    {
        $folders = explode('\\', $this->class);
        array_pop($folders);

        return $folders;
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        $folders = explode('\\', $this->class);

        return array_pop($folders);
    }

    /**
     * @return string
     */
    private function getFullClassName()
    {
        return str_replace('.php', '', $this->class);
    }

    /**
     * @param string $path
     */
    private function createFolder($path)
    {
        if (false === is_dir($path)) {
            mkdir($path);
        }
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
        throw new \RuntimeException('Method ' . __CLASS__ . '::isInitialized() not implemented yet.');
    }
}
