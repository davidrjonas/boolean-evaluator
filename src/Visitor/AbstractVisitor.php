<?php

namespace DavidRJonas\BooleanEvaluator\Visitor;

use DavidRJonas\BooleanEvaluator\Expression;

abstract class AbstractVisitor implements VisitorInterface
{
    public function apply(Expression $expr, $in = []) {
        return $expr->visit($this, $in);
    }

    abstract public function and_(array $args, $in);
    abstract public function or_(array $args, $in);
    abstract public function not_(array $args, $in);

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

