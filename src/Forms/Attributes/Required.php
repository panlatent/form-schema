<?php

namespace Panlatent\FormSchema\Forms\Attributes;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
readonly class Required
{
    public function __construct(public bool $required = true){}
}