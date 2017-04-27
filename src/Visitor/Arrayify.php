<?php

namespace DavidRJonas\BooleanEvaluator\Visitor;

use DavidRJonas\BooleanEvaluator\Expression;
use InvalidArgumentException;

class Arrayify extends AbstractVisitor
{
    const KEY_AND = 'and';
    const KEY_OR  = 'or';
    const KEY_NOT = 'not';

    private $r;

    public function apply(Expression $expr, $in = [])
    {
        $this->r = [];

        $expr->visit($this, $in);

        return $this->r;
    }

    public function and_(array $args, $in)
    {
        $this->r[][self::KEY_AND] = $this->values($args, $in);
        return true;
    }

    public function or_(array $args, $in)
    {
        $this->r[][self::KEY_OR] = $this->values($args, $in);
        return true;
    }

    public function not_(array $args, $in)
    {
        $this->r[][self::KEY_NOT] = $this->value($args[0], $in);
        return true;
    }
}

