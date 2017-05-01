<?php

namespace DavidRJonas\BooleanEvaluator\Evaluator;

use DavidRJonas\BooleanEvaluator\Expression;
use InvalidArgumentException;

class Arrayify extends AbstractEvaluator
{
    const KEY_AND = 'and';
    const KEY_OR  = 'or';
    const KEY_NOT = 'not';

    private $r;

    public function apply(Expression $expr, $in = [])
    {
        $this->r = [];

        $expr->apply($this, $in);

        return $this->r;
    }

    public function bAnd(array $args, $in)
    {
        $this->r[][self::KEY_AND] = $this->values($args, $in);
        return true;
    }

    public function bOr(array $args, $in)
    {
        $this->r[][self::KEY_OR] = $this->values($args, $in);
        return true;
    }

    public function bNot(array $args, $in)
    {
        $this->r[][self::KEY_NOT] = $this->value($args[0], $in);
        return true;
    }
}

