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
     * Node instance.
     *
     * @var Node
     */
    private static $instance;

    /**
     * Node number.
     *
     * @var int
     */
    private $node;

    /**
     * Epoch UNIX timestamp.
     *
     * @var int
     */
    private $epoch;

    /**
     * ID last request microtime.
     *
     * @var int
     */
    private $time;

    /**
     * @var int
     */
    private $step = 0;

    /**
     * Generator constructor.
     */
    final private function __construct()
    {
        $this->node = 0;
        $this->epoch = 1142976050000; // 2006-03-21:20:50:14 GMT

        $this->time = $this->now();
    }

    /**
     * Returns node instance.
     *
     * @return Node
     */
    final public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Returns node number.
     *
     * @return int
     */
    public function getNode(): int
    {
        return $this->node;
    }

    /**
     * Sets node number.
     *
     * @param int $node
     *
     * @throws InvalidArgumentException
     *
     * @return Node
     */
    public function setNode(int $node): self
    {
        if ($node < 0 || $node > 1023) {
            throw new InvalidArgumentException('The node number must be between 0 and 1023');
        }

        $this->node = $node;

        return $this;
    }

    /**
     * Returns epoch UNIX timestamp.
     *
     * @return \DateTime
     */
    public function getEpoch(): \DateTime
    {
        $timeStamp = (int) floor($this->epoch / 1000);

        return (new \DateTime())
            ->setTimestamp($timeStamp);
    }

    /**
     * Sets epoch UNIX timestamp.
     *
     * @param \DateTime $epoch
     *
     * @throws InvalidArgumentException
     *
     * @return Node
     */
    public function setEpoch(\DateTime $epoch): self
    {
        if ($epoch > new \DateTime('now')) {
            throw new InvalidArgumentException('This epoch has not yet come');
        }

        $this->epoch = $epoch->getTimestamp() * 1000;

        return $this;
    }

    /**
     * Generates and returns unique snowflake ID.
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
     * Returns unix timestamp in microseconds.
     *
     * @return int
     */
    private function now(): int
    {
        return (int) floor(microtime(true) * 1000);
    }
}
