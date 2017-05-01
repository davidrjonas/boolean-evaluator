<?php

namespace DavidRJonas\BooleanEvaluator\Test;

use DavidRJonas\BooleanEvaluator\Expression;
use DavidRJonas\BooleanEvaluator\Visitor;

class ArrayifyTest extends \PHPUnit\Framework\TestCase
{
    public function testApplyReturnsStructuredArray()
    {
        $expr = (new Expression)
            ->bAnd('A', 'B')
            ->bOr('C', 'D')
            ->bNot((new Expression)->bAnd('C', 'D'));

        $this->assertEquals(
            [['and' => ['A', 'B']], ['or' => ['C', 'D']], ['not' => [['and' => ['C', 'D']]]]],
            (new Visitor\Arrayify)->apply($expr)
        );
    }
}

