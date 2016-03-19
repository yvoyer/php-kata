<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Event;

use Star\Kata\Domain\Exception\KataException;

final class PublisherException extends \Exception implements KataException
{
}
