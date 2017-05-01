<?php

namespace DavidRJonas\BooleanEvaluator\Visitor;

use DavidRJonas\BooleanEvaluator\Expression;

interface VisitorInterface
{
    public function apply(Expression $expr, $in = []);
    public function bAnd(array $args, $in);
    public function bOr(array $args, $in);
    public function bNot(array $args, $in);
}
