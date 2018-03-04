<?php

/*
 * This file is part of the SnowFlake ID generator package.
 *
 * (c) Alexey Popov <alexey.popov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\TestCase;
use SnowFlake\Base58;

class Base58Test extends TestCase
{
    /**
     * Testing data.
     *
     * @var array
     */
    protected $data = [
        'wbRSUs725' => 3865871070540006,
        'BSgacd7F2' => 4593184132952479,
        '24e1JhG8Tf' => 7840579534856344,
        'KBZCPC4vr' => 5586186042968807,
        'vqmQygwPY' => 3767614233977710,
        '2fjzHcZMFF' => 9261568911951049,
        '2gNZ61mMQQ' => 9452345438437860,
    ];

    /**
     * Test encoder
     *
     * @covers Base58::encode
     *
     * @return void
     */
    public function testEncode(): void
    {
        foreach ($this->data as $encoded => $raw) {
            $result = Base58::encode($raw);

            $this->assertInternalType('string', $result);
            $this->assertEquals($result, $encoded);
        }
    }

    /**
     * Test decoder.
     *
     * @covers Base58::decode
     *
     * @return void
     */
    public function testDecode(): void
    {
        foreach ($this->data as $encoded => $raw) {
            $result = Base58::decode($encoded);

            $this->assertInternalType('int', $result);
            $this->assertEquals($result, $raw);
        }
    }
}
