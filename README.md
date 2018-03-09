# PHP Snowflake ID

[![Build Status](https://travis-ci.org/alexeyco/php-snowflake-id.svg?branch=master)](https://travis-ci.org/alexeyco/php-snowflake-id)
[![Coverage Status](https://coveralls.io/repos/github/alexeyco/php-snowflake-id/badge.svg?branch=master)](https://coveralls.io/github/alexeyco/php-snowflake-id?branch=master)
[![StyleCI](https://styleci.io/repos/123744194/shield?style=flat&branch=master)](https://styleci.io/repos/123744194?branch=master)

Twitter Snowflake flavoured IDs:
* Generate and parse it;
* Convert it to string or integer value;
* Enjoy that it's not UUID (a joke, who does not like UUID).

## Generate

```php
<?php

use SnowFlake\Node;

// Set up custom epoch and node
Node::getInstance()
    ->setEpoch(new \DateTime('2000-01-01 00:00:00')) // Default is 2006-03-21:20:50:14 GMT
    ->setNode(1); // Default is 0; can be between 0 and 1023

$id = Node::getInstance()->generate();

var_dump($id->toInt());
// => 6375898920270168065

var_dump($id->toString();
// => 1cfvnjc093zlt
```

## Parse
```php
<?php

use SnowFlake\Parser;

$id = Parser::fromString('1cfvnjc093zlt');

var_dump($id->toInt());
// ==> 6375898920270168065
```

## License

```
MIT License

Copyright (c) 2018 Alexey Popov

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```
