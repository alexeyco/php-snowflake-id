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
use SnowFlake\Node;
use SnowFlake\Parser;

class ParserTest extends TestCase
{
    /**
     * Test parsing ID from integer value.
     *
     * @return void
     */
    public function testFromInt(): void
    {
        $source = Node::getInstance()->generate();
        $result = Parser::fromInt($source->toInt());

        $this->assertEquals($source->toInt(), $result->toInt());
        $this->assertEquals($source->toString(), $result->toString());
    }

    /**
     * Test parsing ID from base36 value.
     *
     * @return void
     */
    public function testFromBase36(): void
    {
        $source = Node::getInstance()->generate();
        $result = Parser::fromString($source->toString());

        $this->assertEquals($source->toInt(), $result->toInt());
        $this->assertEquals($source->toString(), $result->toString());
    }
}
