# Form Schema

Form Schema provides a way to define form fields by declaring PHP Attributes, 
thereby separating components and form implementations. Provides driving force
for various PHP programs.

## Usage

Use PHP Attribute to define form fields

```php
class ExampleComponent
{

    #[TextInput()]
    public string $name;
}
```