<?php

/*
 * This file is part of the SnowFlake ID generator package.
 *
 * (c) Alexey Popov <alexey.popov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SnowFlake;

trait TimeTrait
{
    /**
     * Returns DateTime object from timestamp.
     *
     * @param int $timeStamp
     *
     * @return \DateTime
     */
    protected function time(int $timeStamp): \DateTime
    {
        return (new \DateTime())
            ->setTimestamp($timeStamp);
    }
}
