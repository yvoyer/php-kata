<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Exception;

final class CurrentKataException extends \Exception implements KataException
{
    /**
     * @return CurrentKataException
     */
    public static function noCurrentKataAvailable()
    {
        return new self("The environment has no current kata available. Did you start any yet?");
    }

    /**
     * @param string $current The current kata name
     * @param string $requested The requested kata name to end
     *
     * @return CurrentKataException
     */
    public static function invalidContextOnEndKata($current, $requested)
    {
        return new self(
            "A request to end kata '{$requested}' as been issued, while the current kata is '{$current}'."
        );
    }
}
