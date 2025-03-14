<?php

namespace Panlatent\FormSchema\Forms\Attributes;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
readonly class TabIndex
{
    public function __construct(public int $tabIndex = 0) {}
}