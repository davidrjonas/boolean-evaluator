<?php

namespace DavidRJonas\BooleanEvaluator\Evaluator;

use DavidRJonas\BooleanEvaluator\Expression;

interface EvaluatorInterface
{
    public function apply(Expression $expr, $in = []);
    public function bAnd(array $args, $in);
    public function bOr(array $args, $in);
    public function bNot(array $args, $in);
}
