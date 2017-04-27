<?php

namespace DavidRJonas\BooleanEvaluator\Visitor;

use DavidRJonas\BooleanEvaluator\Expression;

class Stringify extends AbstractVisitor
{
    private $r;

    public function apply(Expression $expr, $in = [])
    {
        $this->r = [];

        $expr->visit($this, $in);

        return implode(' and ', (array) $this->r);
    }

    public function and_(array $args, $in)
    {
        $this->r[] = implode(" and ", $this->values($args, $in));
        return true;
    }

    public function or_(array $args, $in)
    {
        $this->r[] = '(' . implode(" or ", $this->values($args, $in)) . ')';
        return true;
    }

    public function not_(array $args, $in)
    {
        $this->r[] = 'not (' . $this->value($args[0], $in) . ')';
        return true;
    }
}

