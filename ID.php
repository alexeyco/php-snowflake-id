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
    use TimeTrait;

    /**
     * Node number.
     *
     * @var int
     */
    private $node;

    /**
     * Date of ID creation.
     *
     * @var int
     */
    private $time;

    /**
     * Snowflake step.
     *
     * @var int
     */
    private $step;

    /**
     * Epoch timestamp.
     *
     * @var int
     */
    private $epoch;

    /**
     * @var int
     */
    private $id;

    /**
     * ID constructor.
     *
     * @param int $node  Node number
     * @param int $time  Date of ID creation
     * @param int $step  Snowflake step
     * @param int $epoch
     */
    public function __construct(int $node, int $time, int $step, int $epoch)
    {
        $this->node = $node;
        $this->time = $time;
        $this->step = $step;
        $this->epoch = $epoch;

        $this->id = $this->generate();
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
     * Returns ID creation time.
     *
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time($this->time);
    }

    /**
     * Returns snowflake step.
     *
     * @return int
     */
    public function getStep(): int
    {
        return $this->step;
    }

    /**
     * Returns epoch.
     *
     * @return \DateTime
     */
    public function getEpoch(): \DateTime
    {
        return $this->time((int) floor($this->epoch / 1000));
    }

    /**
     * @return int
     */
    public function toInt(): int
    {
        return $this->id;
    }

    /**
     * Returns base36-encoded ID.
     *
     * @return string
     */
    public function toString(): string
    {
        return base_convert($this->id, 10, 36);
    }

    /**
     * Returns generated ID.
     *
     * @return int
     */
    protected function generate(): int
    {
        $timeOffset = $this->time - $this->epoch;

        $timeBits = str_pad(decbin($timeOffset), 41, '0', STR_PAD_LEFT);
        $nodeBits = str_pad(decbin($this->node), 10, '0', STR_PAD_LEFT);
        $stepBits = str_pad(decbin($this->step), 12, '0', STR_PAD_LEFT);

        return (int) bindec('0'.$timeBits.$nodeBits.$stepBits);
    }
}
