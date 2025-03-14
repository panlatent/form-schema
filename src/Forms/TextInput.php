<?php

namespace Panlatent\FormSchema\Forms;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class TextInput extends Field
{
    public function __construct(
        public ?string       $label = null,
        public ?string       $name = null,
        public ?bool         $required = null,
        public readonly bool $url = false)
    {
    }
}