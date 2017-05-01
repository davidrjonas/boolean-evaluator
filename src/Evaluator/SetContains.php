<?php

namespace DavidRJonas\BooleanEvaluator\Evaluator;

class SetContains extends AbstractEvaluator
{
    public function bAnd(array $args, $in)
    {
        foreach($this->values($args, $in) as $v) {
            if (! in_array($v, $in)) {
                return false;
            }
        }

        return true;
    }

    public function bOr(array $args, $in)
    {
        foreach($this->values($args, $in) as $v) {
            if (in_array($v, $in)) {
                return true;
            }
        }

        return false;
    }

    public function bNot(array $args, $in)
    {
        return ! $this->value($args[0], $in);
    }
}

