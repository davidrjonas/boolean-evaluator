<?php

namespace DavidRJonas\BooleanEvaluator\Test;

use DavidRJonas\BooleanEvaluator\Expression;
use DavidRJonas\BooleanEvaluator\Visitor;

class ArrayifyTest extends \PHPUnit\Framework\TestCase
{
    public function testApplyReturnsStructuredArray()
    {
        $expr = (new Expression)
            ->and_('A', 'B')
            ->or_('C', 'D')
            ->not_((new Expression)->and_('C', 'D'));

        $this->assertEquals(
            [['and' => ['A', 'B']], ['or' => ['C', 'D']], ['not' => [['and' => ['C', 'D']]]]],
            (new Visitor\Arrayify)->apply($expr)
        );
    }
}

