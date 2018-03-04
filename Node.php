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

class Node
{
    /**
     * Node instance
     *
     * @var Node
     */
    private static $instance;

    /**
     * Node number
     *
     * @var int
     */
    private $node;

    /**
     * Epoch UNIX timestamp
     *
     * @var int
     */
    private $epoch;

    /**
     * ID last request microtime
     *
     * @var int
     */
    private $time;

    /**
     * @var int
     */
    private $step = 0;

    /**
     * Generator constructor
     */
    final private function __construct()
    {
        $this->node = 0;
        $this->epoch = 1142976050000; // 2006-03-21:20:50:14 GMT

        $this->time = $this->now();
    }

    /**
     * Returns node instance
     *
     * @return Node
     */
    final public static function getInstance(): Node
    {
        if (self::$instance === null) {
            self::$instance = new Node();
        }

        return self::$instance;
    }

    /**
     * Returns node number
     *
     * @return int
     */
    public function getNode(): int
    {
        return $this->node;
    }

    /**
     * Sets node number
     *
     * @param int $node
     * @return Node
     */
    public function setNode(int $node): Node
    {
        $this->node = $node;
        return $this;
    }

    /**
     * Returns epoch UNIX timestamp
     *
     * @return int
     */
    public function getEpoch(): int
    {
        return $this->epoch;
    }

    /**
     * Sets epoch UNIX timestamp
     *
     * @param int $epoch
     * @return Node
     */
    public function setEpoch(int $epoch): Node
    {
        $this->epoch = $epoch;
        return $this;
    }

    /**
     * Generates and returns unique snowflake ID
     *
     * @return ID
     */
    public function generate(): ID
    {
        $now = $this->now();
        if ($this->time === $now) {
            $this->step++;
        } else {
            $this->step = 0;
            $this->time = $now;
        }

        return new ID($this->node, $this->time, $this->step, $this->epoch);
    }

    /**
     * Returns unix timestamp in microseconds
     *
     * @return int
     */
    private function now(): int
    {
        return floor(microtime(true) * 1000);
    }
}
