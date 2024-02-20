# PHP FormBuilder Class

The `FormBuilder` class provides an easy-to-use interface for dynamically generating HTML forms and validating the input data.

## Class Methods

The class provides the following methods:

### __construct()

This method initializes the `FormBuilder` instance. 

```php
$formBuilder = new FormBuilder();
```

### addField($type, $name, $label, $attributes = [])

This method adds a form field to the form.

- `$type`: The type of the input field.
- `$name`: The name attribute of the input field.
- `$label`: The label for the input field.
- `$attributes`: Additional attributes for the input field.

```php
$formBuilder->addField('text', 'username', 'Username', ['required' => true, 'minlength' => 5, 'maxlength' => 20]);
```

### validate($data)

This method validates the form data based on the defined validation rules. It accepts an associative array as a parameter where the keys are field names and the values are the input values. 

```php
$formData = ['username' => 'John123'];

if (!$formBuilder->validate($formData)) {
    print_r($formBuilder->getErrors());
} else {
    echo "Form data is valid!";
}
```

### hasErrors()

This method checks if there are any form validation errors. It returns `true` if there are any errors and `false` otherwise.

```php
if ($formBuilder->hasErrors()) {
    echo "There are errors in the form data.";
} else {
    echo "No errors found!";
}
```

### getErrors()

This method returns all the form validation errors. It returns an associative array where the keys are the field names and the values are the error messages.

```php
$errors = $formBuilder->getErrors();
print_r($errors);
```

### render()

This method renders the form. It outputs the form HTML.

```php
$formBuilder->render();
```
### Components Class Usage in FormBuilder

The `Components` class is instantiated in the constructor of the `FormBuilder` class:

```php
$this->components = new Components('bootstrap'); 
```

The 'bootstrap' parameter is an example and should be replaced with the CSS framework that you wish to use. 

When adding a field using the `addField()` method, the `Components` class's `generateInput()` method is called:

```php
$field .= $this->components->generateInput($type, $name, $attributes);
```

The `generateInput()` method is responsible for generating the HTML code for the input field. 

Here is a generic example of how a `Components` class may look like:

```php
class Components {
    private $framework;
    
    public function __construct($framework) {
        $this->framework = $framework;
    }
    
    public function generateInput($type, $name, $attributes) {
        // Generate HTML code based on the framework, type, name and attributes
    }
}
```
You need to define the Components class according to your requirements, making sure that the `generateInput()` method produces the appropriate HTML code based on the given $type, $name, and $attributes parameters, and based on the CSS framework you want to use.


**Note: The methods addValidationRules($name, $attributes) and addError($field, $message) are private and are used internally in the FormBuilder class. You don't need to use these methods directly.

For more details, refer to the code comments in the FormBuilder class and the Components Class.**
