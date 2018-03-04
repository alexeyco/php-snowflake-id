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

/**
 * @see https://gist.github.com/jsjohnst/126883/8a9cba0d64bbcb9354e0348821fd97568d4f37c5
 */
class Base58
{
    /**
     * @var string
     */
    protected static $map = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';

    /**
     * Returns base58-encoded value
     *
     * @param int $value
     * @return string
     */
    public static function encode(int $value): string
    {
        $result = '';
        $base = strlen(self::$map);

        while($value >= $base) {
            $div = floor($value / $base);
            $mod = $value % $base;
            $result = self::$map{$mod}.$result;
            $value = $div;
        }

        if ($value) {
            $result = self::$map{intval($value)}.$result;
        }

        return $result;
    }

    /**
     * Decodes base58-encoded string
     *
     * @param string $value
     * @return int
     */
    public static function decode(string $value): int
    {
        $result = 0;
        $len = strlen($value) - 1;

        for($i = $len, $j = 1, $base = strlen(self::$map); $i >= 0; $i--, $j *= $base) {
            $result += $j * strpos(self::$map, $value{$i});
        }

        return $result;
    }
}
