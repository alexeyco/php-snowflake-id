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
use SnowFlake\ID;

class IDTest extends TestCase
{
    /**
     * Check node getter.
     *
     * @return void
     */
    public function testGetNode(): void
    {
        foreach ([123, 456, 789] as $node) {
            $id = new ID($node, $this->now(), 0, 0);
            $this->assertEquals($node, $id->getNode());
        }
    }

    /**
     * Check time getter.
     *
     * @return void
     */
    public function testGetTime(): void
    {
        foreach ([999, 888, 777] as $time) {
            $id = new ID(0, $time, 0, 0);
            $this->assertEquals($time, $id->getTime());
        }
    }

    /**
     * Check step getter.
     *
     * @return void
     */
    public function testGetStep(): void
    {
        foreach ([111, 222, 333] as $step) {
            $id = new ID(0, $this->now(), $step, 0);
            $this->assertEquals($step, $id->getStep());
        }
    }

    /**
     * Check step epoch.
     *
     * @return void
     */
    public function testGetEpoch(): void
    {
        foreach ([45, 67, 89] as $epoch) {
            $id = new ID(0, $this->now(), 0, $epoch);
            $this->assertEquals($epoch, $id->getEpoch());
        }
    }

    /**
     * Returns current timestamp in microsecond.
     *
     * @return int
     */
    private function now(): int
    {
        return (int) floor(microtime(true) * 1000);
    }
}
