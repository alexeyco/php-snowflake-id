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
        $testSet = [
            new \DateTime('2011-01-01 00:00:00'),
            new \DateTime('2016-12-03 10:11:12'),
            new \DateTime('now'),
        ];

        foreach ($testSet as $time) {
            $id = new ID(0, $time->getTimestamp(), 0, 0);
            $this->assertEquals($time->getTimestamp(), $id->getTime()->getTimestamp());
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
     * Check epoch getter.
     *
     * @return void
     */
    public function testGetEpoch(): void
    {
        $testSet = [
            new \DateTime('1989-01-23 00:00:00'),
            new \DateTime('2000-10-03 10:11:12'),
            new \DateTime('now'),
        ];

        foreach ($testSet as $epoch) {
            $id = new ID(0, $this->now(), 0, $epoch->getTimestamp() * 1000);
            $this->assertEquals($epoch->getTimestamp(), $id->getEpoch()->getTimestamp());
        }
    }

    /**
     * Check ID to int conversion.
     *
     * @return void
     */
    public function testToInt(): void
    {
        $testSet = [
            [
                'input' => [
                    'node'  => 140,
                    'time'  => 1520199776076,
                    'epoch' => 1520197301499,
                    'step'  => 3648,
                ],
                'result' => 10379128786496,
            ],
            [
                'input' => [
                    'node'  => 601,
                    'time'  => 1520199890218,
                    'epoch' => 1520198445386,
                    'step'  => 1752,
                ],
                'result' => 6060067100376,
            ],
            [
                'input' => [
                    'node'  => 660,
                    'time'  => 1520199908104,
                    'epoch' => 1520197456644,
                    'step'  => 2476,
                ],
                'result' => 10282171189676,
            ],
        ];

        foreach ($testSet as $set) {
            $input = $set['input'];
            $id = new ID($input['node'], $input['time'], $input['step'], $input['epoch']);

            $this->assertEquals($id->toInt(), $set['result']);
        }
    }

    /**
     * Check ID to string conversion.
     *
     * @return void
     */
    public function testToString(): void
    {
        $testSet = [
            [
                'input' => [
                    'node'  => 346,
                    'time'  => 1520200065164,
                    'epoch' => 1520194233893,
                    'step'  => 537,
                ],
                'result' => '8o3wnydy1',
            ],
            [
                'input' => [
                    'node'  => 512,
                    'time'  => 1520200075242,
                    'epoch' => 1520191499006,
                    'step'  => 2251,
                ],
                'result' => 'cr108wkp7',
            ],
            [
                'input' => [
                    'node'  => 553,
                    'time'  => 1520200081367,
                    'epoch' => 1520191387762,
                    'step'  => 1179,
                ],
                'result' => 'cxb5ok5gb',
            ],
        ];

        foreach ($testSet as $set) {
            $input = $set['input'];
            $id = new ID($input['node'], $input['time'], $input['step'], $input['epoch']);

            $this->assertEquals($id->toString(), $set['result']);
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
