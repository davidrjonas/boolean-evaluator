<?php

namespace DavidRJonas\BooleanEvaluator\Visitor;

use DavidRJonas\BooleanEvaluator\Expression;

interface VisitorInterface
{
    public function apply(Expression $expr, $in = []);
    public function and_(array $args, $in);
    public function or_(array $args, $in);
    public function not_(array $args, $in);
}
