<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star;

use Star\Fixture\AssertTrue\AssertTrueKata;
use Star\Fixture\AssertFalse\AssertFalseKata;
use Star\Kata\Infrastructure\InMemory\KataCollection;
use Star\Kata\KataApplication;

/**
 * Class ApplicationTester
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star
 *
 * todo Move to extensions
 */
final class ApplicationTester extends KataApplication
{
    /**
     * @return KataCollection
     */
    protected function getDefaultKatas()
    {
        $collection = new KataCollection();
        $collection->addKata(new AssertTrueKata());
        $collection->addKata(new AssertFalseKata());

        return $collection;
    }
}
