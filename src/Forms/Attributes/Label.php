<?php

namespace Panlatent\FormSchema\Forms\Attributes;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
readonly class Label
{
    public function __construct(public ?string $name = null)
    {

    }
}