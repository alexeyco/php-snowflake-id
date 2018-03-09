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
        $this->assertEquals($source->toBase36(), $result->toBase36());
        $this->assertEquals($source->toBase64(), $result->toBase64());
    }

    /**
     * Test parsing ID from base36 value.
     *
     * @return void
     */
    public function testFromBase36(): void
    {
        $source = Node::getInstance()->generate();
        $result = Parser::fromBase36($source->toBase36());

        $this->assertEquals($source->toInt(), $result->toInt());
        $this->assertEquals($source->toBase36(), $result->toBase36());
        $this->assertEquals($source->toBase64(), $result->toBase64());
    }

    /**
     * Test parsing ID from base64 value.
     *
     * @return void
     */
    public function testFromBase64(): void
    {
        $source = Node::getInstance()->generate();
        $result = Parser::fromBase64($source->toBase64());

        $this->assertEquals($source->toInt(), $result->toInt());
        $this->assertEquals($source->toBase36(), $result->toBase36());
        $this->assertEquals($source->toBase64(), $result->toBase64());
    }
}
