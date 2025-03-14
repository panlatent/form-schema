<?php

namespace Panlatent\FormSchema\Forms;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class Select extends Field
{
    public function __construct(private array|string|null $options = null)
    {

    }

    public function getOptions(): array
    {
        if (is_string($this->options) && enum_exists($this->options)) {
            $enum = new \ReflectionEnum($this->options);
            if (!$enum->isBacked()) {
                // @todo
            }

            $options = [];
            foreach ($enum->getCases() as $case) {
                $options[] = ['label' => $case->name, 'value' => $case->getBackingValue()];
            }

            return $options;
        }

        if (is_array($this->options)) {
            return $this->options;
        }
    }
}