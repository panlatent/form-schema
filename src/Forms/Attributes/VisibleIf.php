<?php

namespace Panlatent\FormSchema\Forms\Attributes;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
readonly class VisibleIf
{
    public function __construct(
        public string $property,
        public string $operator = '=',
        public mixed  $value = true,
    ) {}

    public function test(object $object): bool
    {
        $value = $object->{$this->property};
        if ($this->operator === '=') {
            return $value === $this->value;
        }
        if ($this->operator === 'in') {
            return in_array($value, (array)$this->value, true);
        }
        return false;
    }
}