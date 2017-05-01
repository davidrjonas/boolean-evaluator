<?php

namespace DavidRJonas\BooleanEvaluator\Evaluator;

use DavidRJonas\BooleanEvaluator\Expression;

abstract class AbstractEvaluator implements EvaluatorInterface
{
    public function apply(Expression $expr, $in = []) {
        return $expr->apply($this, $in);
    }

    abstract public function bAnd(array $args, $in);
    abstract public function bOr(array $args, $in);
    abstract public function bNot(array $args, $in);

    protected function values(array $args, $in)
    {
        return array_map(function($arg) use ($in) {
            return $this->value($arg, $in);
        }, $args);
    }

    protected function value($arg, $in)
    {
        if ($arg instanceof Expression) {
            return (new static)->apply($arg, $in);
        }

        if($arg instanceof Closure) {
            return $this->value($arg($in));
        }

        return $arg;
    }
}

