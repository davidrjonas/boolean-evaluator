<?php

namespace DavidRJonas\BooleanEvaluator\Test;

use DavidRJonas\BooleanEvaluator\Expression as BE;
use DavidRJonas\BooleanEvaluator\Visitor;

class SetContainsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider setProvider
     */
    public function testApply($expected, $expr, $set)
    {
        $v = new Visitor\SetContains;
        $this->assertEquals($expected, $v->apply($expr, $set));
    }

    public function setProvider()
    {
        $expr = (new BE)->and_('A', 'B')->or_('C', 'D')->not_((new BE)->and_('C', 'D'));

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

