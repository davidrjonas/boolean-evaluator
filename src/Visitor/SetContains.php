<?php

namespace DavidRJonas\BooleanEvaluator\Visitor;

class SetContains extends AbstractVisitor
{
    public function and_(array $args, $in)
    {
        foreach($this->values($args, $in) as $v) {
            if (! in_array($v, $in)) {
                return false;
            }
        }

        return true;
    }

    public function or_(array $args, $in)
    {
        foreach($this->values($args, $in) as $v) {
            if (in_array($v, $in)) {
                return true;
            }
        }

        return false;
    }

    public function not_(array $args, $in)
    {
        return ! $this->value($args[0], $in);
    }
}

