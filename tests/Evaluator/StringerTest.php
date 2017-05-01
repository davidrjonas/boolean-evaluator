<?php

namespace DavidRJonas\BooleanEvaluator\Test;

use DavidRJonas\BooleanEvaluator\Expression;
use DavidRJonas\BooleanEvaluator\Evaluator;

class StringerTest extends \PHPUnit\Framework\TestCase
{
    public function testApplyReturnsComplexString()
    {
        $expr = (new Expression)
            ->bAnd('A', 'B')
            ->bOr('C', 'D')
            ->bNot((new Expression)->bAnd('C', 'D'));

        $this->assertEquals(
            'A and B and (C or D) and not (C and D)',
            (new Evaluator\Stringer)->apply($expr)
        );
    }
}

