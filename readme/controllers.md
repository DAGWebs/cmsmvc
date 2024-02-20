# Controller Class Documentation

The `Controller` class is the base class for all controllers in the application. It extends the `Application` class and provides common functionality for controllers.

## Class: Controller

### Properties

- `_controller`: The name of the controller.
- `_action`: The name of the action.
- `view`: The view object associated with the controller.

### Constructor

```php
public function __construct($controller, $action)
```

The constructor method initializes the `Controller` class by calling the parent constructor, setting the controller and action names, and creating a new View object.

- `$controller`: The name of the controller.
- `$action`: The name of the action.

### Methods

No additional methods available in the `Controller` class.

## Example Usage

```php
<?php

$controller = new Controller('users', 'index');
echo $controller->view->render('index');
```

