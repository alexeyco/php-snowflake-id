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

class Parser
{
    /**
     * Parse Snowflake ID from integer.
     *
     * @param int $id
     *
     * @return ID
     */
    public static function fromInt(int $id): ID
    {
        $cypher = str_pad(decbin($id), 64, '0', STR_PAD_LEFT);

        $epoch = Node::getInstance()
                ->getEpoch()
                ->getTimestamp() * 1000;

        $time = (int) bindec(substr($cypher, 1, 41));
        $node = (int) bindec(substr($cypher, 42, 10));
        $step = (int) bindec(substr($cypher, 52, 12));

        return new ID($node, $time + $epoch, $step, $epoch);
    }

    /**
     * Parse Snowflake ID from base36 string.
     *
     * @param string $id
     *
     * @return ID
     */
    public static function fromBase36(string $id): ID
    {
        return self::fromInt(base_convert($id, 36, 10));
    }

    /**
     * Parse Snowflake ID from base64 string.
     *
     * @param string $id
     *
     * @return ID
     */
    public static function fromBase64(string $id): ID
    {
        return self::fromInt(base64_decode($id));
    }
}
