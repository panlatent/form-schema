<?php

namespace Panlatent\FormSchema;

use Panlatent\FormSchema\Forms\Attributes;
use Panlatent\FormSchema\Forms\Field;

class Form
{
    /**
     * @param object $component
     * @return Field[]
     * @throws \ReflectionException
     */
    public function getSchema(object $component): array
    {
        $schema = [];

        foreach ($this->getNonStaticProperties($component) as $property) {
            $attributes = $property->getAttributes(Forms\Field::class, \ReflectionAttribute::IS_INSTANCEOF);
            if (empty($attributes) || count($attributes) > 1) {
                continue;
            }
            $schema[] = $this->getField($attributes[0], $property);
        }

        return $schema;
    }

    protected function getField(\ReflectionAttribute $attribute, \ReflectionProperty $property): Forms\Field
    {
        /** @var Forms\Field $field */
        $field = $attribute->newInstance();

        $name = $property->getName();
        if ($field->name === null) {
            $field->name = $name;
        }

        if ($field->label === null) {
            $label = $this->getAttributeInstance($property, Attributes\Label::class);
            if ($label) {
                $field->label = $label->name;
            } else {
                $field->label = ucwords($name);
            }
        }

        if ($field->required === null) {
            $required = $this->getAttributeInstance($property, Attributes\Required::class);
            if ($required) {
                $field->required = $required->required;
            }
        }

        if ($field->readonly === null) {
            $field->readonly = $property->isReadOnly();
        }

        $visible = $this->getAttributeInstance($property, Attributes\VisibleIf::class);
        if ($visible) {
            // $field->visible = $visible->test($object);
        }

        return $field;
    }

    /**
     * @template T
     * @param \ReflectionProperty $property
     * @param class-string<T> $class
     * @return T|null
     */
    private function getAttributeInstance(\ReflectionProperty $property, string $class): ?object
    {
        $properties = $property->getAttributes($class);
        if (empty($properties)) {
            return null;
        }
        return $properties[0]->newInstance();
    }

    /**
     * @param string|object $object
     * @return \ReflectionProperty[]
     * @throws \ReflectionException
     */
    private function getNonStaticProperties(string|object $object): array
    {
        return array_filter((new \ReflectionClass($object))->getProperties(\ReflectionProperty::IS_PUBLIC),
            static function (\ReflectionProperty $property) {
                return !$property->isStatic();
            });
    }
}