<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Configuration;

use Star\Component\Collection\TypedCollection;
use Star\Kata\Exception\Configuration\MissingConfigurationException;
use Star\Kata\Exception\Configuration\MissingKataConfigurationException;
use Star\Kata\Exception\InvalidArgumentException;
use Star\Kata\Exception\RuntimeException;
use Star\Kata\Model\Kata;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

/**
 * Class Configuration
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Configuration
 */
class Configuration implements ConfigurationInterface
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var string
     */
    private $srcPath;

    /**
     * @var Kata[]|TypedCollection
     */
    private $kataCollection;

    public function __construct()
    {
        $this->kataCollection = new TypedCollection(Kata::CLASS_NAME);
    }

    public function load(array $config)
    {
        $processor = new Processor();
        try {
            $config = $processor->processConfiguration($this, $config);
        } catch (InvalidConfigurationException $ex) {
            throw new MissingConfigurationException($ex->getMessage(), null, $ex);
        }

        $this->setSrcPath($config['src_path']);

        if (empty($config['katas'])) {
            throw MissingConfigurationException::getNoKataDefinedException();
        }

        foreach ($config['katas'] as $key => $kataInfo) {
            try {
                $kataConfig = $processor->processConfiguration(new KataConfiguration($key), array($key => $kataInfo));
            } catch (InvalidConfigurationException $ex) {
                throw new MissingKataConfigurationException($ex->getMessage(), null, $ex);
            }
            $class = $kataConfig['class'];
            $name = $kataConfig['name'];

            $this->addKata(new $class($name));
        }
    }

    /**
     * Return the Kata with $name.
     *
     * @param string $name
     *
     * @throws \Star\Kata\Exception\InvalidArgumentException
     * @return Kata
     */
    public function getKata($name)
    {
        $kata = $this->kataCollection->get($name);
        if (null === $kata) {
            throw new InvalidArgumentException("Kata with name '{$name}' was not found.");
        }

        return $kata;
    }

    /**
     * Add the $kata.
     *
     * @param \Star\Kata\Model\Kata $kata
     */
    public function addKata(Kata $kata)
    {
        $this->kataCollection->set($kata->getName(), $kata);
    }

    /**
     * Returns the SrcPath.
     *
     * @throws \Star\Kata\Exception\RuntimeException
     * @return string
     */
    public function getSrcPath()
    {
        if (empty($this->srcPath)) {
            throw new RuntimeException('SrcPath must be set.');
        }

        return $this->srcPath;
    }

    /**
     * Set the srcPath.
     *
     * @param string $srcPath
     */
    public function setSrcPath($srcPath)
    {
        $this->srcPath = $srcPath;
    }

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $treeNode = $builder->root('php-kata');
        $treeNode
            ->children()
                ->scalarNode('src_path')->isRequired()->end()
                ->variableNode('katas')->isRequired()->end()
            ->end()
        ;

        return $builder;
    }
}
