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

class ID
{
    /**
     * Node number
     *
     * @var int
     */
    private $node;

    /**
     * Date of ID creation
     *
     * @var \DateTime
     */
    private $time;

    /**
     * Snowflake step
     *
     * @var int
     */
    private $step;

    /**
     * @var int
     */
    private $id;

    /**
     * ID constructor
     *
     * @param int       $node Node number
     * @param \DateTime $time Date of ID creation
     * @param int       $step Snowflake step
     */
    public function __construct(int $node, \DateTime $time, int $step)
    {
        $this->node = $node;
        $this->time = $time;
        $this->step = $step;

        $this->id = $this->generate();
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
     * Returns snowflake step
     *
     * @return int
     */
    public function getStep(): int
    {
        return $this->step;
    }

    /**
     * Returns ID creation time
     *
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * @return int
     */
    public function toInt(): int
    {
        return $this->id;
    }

    /**
     *
     *
     * @return string
     */
    public function toBase2(): string
    {

    }

    /**
     * Returns base36-encoded ID
     *
     * @return string
     */
    public function toBase36(): string
    {

    }

    /**
     * Returns base58-encoded ID
     *
     * @return string
     */
    public function toBase58(): string
    {

    }

    /**
     * Returns base64-encoded ID
     *
     * @return string
     */
    public function toBase64(): string
    {

    }

    /**
     * Returns generated ID
     *
     * @return int
     */
    protected function generate(): int
    {
        $epoch = Node::getInstance()->getEpoch();
    }
}
