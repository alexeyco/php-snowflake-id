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
     * Check epoch getter.
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
     * Check ID to base36 conversion.
     *
     * @return void
     */
    public function testToBase36(): void
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

            $this->assertEquals($id->toBase36(), $set['result']);
        }
    }

    /**
     * Check ID to base58 conversion.
     *
     * @return void
     */
    public function testToBase58(): void
    {
        $testSet = [
            [
                'input' => [
                    'node'  => 222,
                    'time'  => 1520200239242,
                    'epoch' => 1520197034158,
                    'step'  => 206,
                ],
                'result' => '768ouPrG',
            ],
            [
                'input' => [
                    'node'  => 720,
                    'time'  => 1520200250455,
                    'epoch' => 1520195604848,
                    'step'  => 3971,
                ],
                'result' => '9PQJLqFe',
            ],
            [
                'input' => [
                    'node'  => 573,
                    'time'  => 1520200256658,
                    'epoch' => 1520195664306,
                    'step'  => 347,
                ],
                'result' => '9HYqtFs4',
            ],
        ];

        foreach ($testSet as $set) {
            $input = $set['input'];
            $id = new ID($input['node'], $input['time'], $input['step'], $input['epoch']);

            $this->assertEquals($id->toBase58(), $set['result']);
        }
    }

    /**
     * Check ID to base64 conversion.
     *
     * @return void
     */
    public function testToBase64(): void
    {
        $testSet = [
            [
                'input' => [
                    'node'  => 916,
                    'time'  => 1520200271177,
                    'epoch' => 1520197875362,
                    'step'  => 941,
                ],
                'result' => 'MTAwNDg3ODAxOTA2Mzc=',
            ],
            [
                'input' => [
                    'node'  => 384,
                    'time'  => 1520200280840,
                    'epoch' => 1520196808946,
                    'step'  => 26,
                ],
                'result' => 'MTQ1NjIxODA0NjQ2NjY=',
            ],
            [
                'input' => [
                    'node'  => 1,
                    'time'  => 1520200287390,
                    'epoch' => 1520190943498,
                    'step'  => 1164,
                ],
                'result' => 'MzkxOTExMjM1OTY0Mjg=',
            ],
        ];

        foreach ($testSet as $set) {
            $input = $set['input'];
            $id = new ID($input['node'], $input['time'], $input['step'], $input['epoch']);

            $this->assertEquals($id->toBase64(), $set['result']);
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
