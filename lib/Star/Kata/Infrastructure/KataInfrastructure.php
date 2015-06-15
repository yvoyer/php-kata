<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure;

use Star\Kata\KataDomain\KataService;
use Star\Kata\Model\KataRepository;

/**
 * Class KataInfrastructure
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Infrastructure
 * @deprecated todo Remove
 */
interface KataInfrastructure
{
    const INTERFACE_NAME = __CLASS__;

    /**
     * @return KataService
     */
    public function kataService();

    /**
     * @return KataRepository
     */
    public function kataRepository();
}
