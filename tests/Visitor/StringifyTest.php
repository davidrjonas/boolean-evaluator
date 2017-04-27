<?php

namespace DavidRJonas\BooleanEvaluator\Test;

use DavidRJonas\BooleanEvaluator\Expression;
use DavidRJonas\BooleanEvaluator\Visitor;

class StringifyTest extends \PHPUnit\Framework\TestCase
{
    public function testApplyReturnsComplexString()
    {
        $expr = (new Expression)
            ->and_('A', 'B')
            ->or_('C', 'D')
            ->not_((new Expression)->and_('C', 'D'));

        $this->assertEquals(
            'A and B and (C or D) and not (C and D)',
            (new Visitor\Stringify)->apply($expr)
        );
    }
}

