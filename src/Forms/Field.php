<?php

namespace Panlatent\FormSchema\Forms;

abstract class Field
{
    public ?string $label = null;
    public ?string $id = null;
    public ?string $name = null;
    public ?string $description = null;
    public ?bool $required = null;
    public ?bool $readonly = null;
    public ?bool $disabled = null;
    public ?bool $visible = null;
}