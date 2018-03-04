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
use SnowFlake\InvalidArgumentException;
use SnowFlake\Node;

class NodeTest extends TestCase
{
    /**
     * Test node getter and setter.
     *
     * @throws \SnowFlake\InvalidArgumentException
     *
     * @return void
     */
    public function testNode(): void
    {
        foreach ([0, 528, 1023] as $node) {
            Node::getInstance()
                ->setNode($node);

            $this->assertEquals(Node::getInstance()->getNode(), $node);
        }
    }

    /**
     * Test what happens if we try to specify a negative node number.
     *
     * @throws \SnowFlake\InvalidArgumentException
     *
     * @return void
     */
    public function testNegativeNodeException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Node::getInstance()->setNode(-1);
    }

    /**
     * Test what happens if we try to specify too big node number.
     *
     * @throws \SnowFlake\InvalidArgumentException
     *
     * @return void
     */
    public function testTooBigNodeException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Node::getInstance()->setNode(1024);
    }

    /**
     * Test epoch getter and setter.
     *
     * @throws \SnowFlake\InvalidArgumentException
     *
     * @return void
     */
    public function testEpoch(): void
    {
        $now = new \DateTime('now');
        $testSet = [
            $now->modify('-1 day'),
            $now->modify('-1 week'),
            $now->modify('-1 month'),
        ];

        foreach ($testSet as $time) {
            Node::getInstance()
                ->setEpoch($time);

            $this->assertEquals(Node::getInstance()->getEpoch()->getTimestamp(), $time->getTimestamp());
        }
    }

    /**
     * The epoch can only be in the past.
     *
     * @throws \SnowFlake\InvalidArgumentException
     *
     * @return void
     */
    public function testFutureEpochException(): void
    {
        $epoch = (new \DateTime())->modify('+1 second');

        $this->expectException(InvalidArgumentException::class);
        Node::getInstance()->setEpoch($epoch);
    }

    /**
     * Test generated ID.
     *
     * @throws \SnowFlake\InvalidArgumentException
     *
     * @return void
     */
    public function testGenerate(): void
    {
        $epoch = (new \DateTime())->setTimestamp(1142976050);
        $node = 123;

        Node::getInstance()
            ->setEpoch($epoch)
            ->setNode($node);

        $id = Node::getInstance()
            ->generate();

        $this->assertEquals((int) floor($id->getEpoch() / 1000), $epoch->getTimestamp());
        $this->assertEquals($id->getNode(), $node);
    }
}
