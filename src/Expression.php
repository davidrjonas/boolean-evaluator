<?php

namespace DavidRJonas\BooleanEvaluator;

class Expression
{
    private $op;
    private $args;
    private $parent;

    public function __construct(Expression $parent = null)
    {
        $this->parent = $parent;
    }

    public function and_()
    {
        $this->op = 'and_';
        $this->args = func_get_args();

        return new self($this);
    }

    public function or_()
    {
        $this->op = 'or_';
        $this->args = func_get_args();

        return new self($this);
    }

    public function not_($v)
    {
        $this->op = 'not_';
        $this->args = [$v];

        return new self($this);
    }

    public function visit(Visitor\VisitorInterface $visitor, $in)
    {
        $v = $this->parent ? $this->parent->visit($visitor, $in) : true;
        return $this->op ? $v && call_user_func([$visitor, $this->op], $this->args, $in) : $v;
    }
}

