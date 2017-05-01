<?php

namespace DavidRJonas\BooleanEvaluator\Test;

use DavidRJonas\BooleanEvaluator\Expression as BE;
use DavidRJonas\BooleanEvaluator\Evaluator;

class SetContainsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider setProvider
     */
    public function testApply($expected, $expr, $set)
    {
        $v = new Evaluator\SetContains;
        $this->assertEquals($expected, $v->apply($expr, $set));
    }

    public function setProvider()
    {
        $expr = (new BE)->bAnd('A', 'B')->bOr('C', 'D')->bNot((new BE)->bAnd('C', 'D'));

        return [
            [true, new BE, []],
            [true, new BE, ['E']],
            [true, $expr, ['A', 'B', 'C']],
            [true, $expr, ['A', 'B', 'D']],
            [true, $expr, ['A', 'B', 'D', 'E']],

            [false, $expr, ['A']],
            [false, $expr, ['B']],
            [false, $expr, ['A', 'B']],
            [false, $expr, ['A', 'B', 'C', 'D']],
        ];
    }
}

