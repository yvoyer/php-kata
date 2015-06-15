<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure;

use Star\Kata\Exception\AlreadyRegisteredServiceException;
use Star\Kata\Exception\ServiceNotFoundException;
use Star\Kata\Infrastructure\Filesystem\FilesystemEnvironment;
use Star\Kata\Infrastructure\InMemory\KataCollection;
use Star\Kata\KataDomain\KataService;
use Star\Kata\Model\KataRepository;

/**
 * Class InMemoryInfrastructure
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Infrastructure
 *
 * @deprecated todo check if still useful
 */
final class InMemoryInfrastructure implements KataInfrastructure
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var array
     */
    private $definitions = array();

    /**
     * @var array
     */
    private $services = array();

    public function __construct()
    {
        $infrastructure = $this;

        $this->setDefinition('kata-repository', function() use ($infrastructure) {
            return new KataCollection();
        });

        $this->setDefinition('kata-service', function() use ($infrastructure) {
            return new KataService($infrastructure->kataRepository(), new FilesystemEnvironment(''));
        });
    }

    /**
     * @return KataService
     */
    public function kataService()
    {
        return $this->getService('kata-service');
    }

    /**
     * @return KataRepository
     */
    public function kataRepository()
    {
        return $this->getService('kata-repository');
    }

    /**
     * @param string   $id
     * @param callable $closure
     *
     * @throws \Star\Kata\Exception\AlreadyRegisteredServiceException
     */
    private function setDefinition($id, \Closure $closure)
    {
        if ($this->hasDefinition($id)) {
            throw new AlreadyRegisteredServiceException("The service '{$id}' is already registered.");
        }

        $this->definitions[$id] = $closure;
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    private function hasDefinition($id)
    {
        return array_key_exists($id, $this->definitions);
    }

    /**
     * @param string $id
     *
     * @return object
     * @throws \Star\Kata\Exception\ServiceNotFoundException
     */
    private function getService($id)
    {
        if (false === $this->hasDefinition($id)) {
            throw new ServiceNotFoundException("The service '{$id}' is not registered.");
        }

        if (false === $this->hasService($id)) {
            $this->services[$id] = $this->definitions[$id]();
        }

        return $this->services[$id];
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    private function hasService($id)
    {
        return array_key_exists($id, $this->services);
    }
}
