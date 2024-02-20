# Cookie Class Documentation

The `Cookie` class provides methods to handle HTTP cookies.

## Class: Cookie

The `Cookie` class is responsible for setting, getting, checking, and deleting HTTP cookies.

### Methods

#### set

```php
public static function set($name, $value, $time = 1)
```

This method sets a cookie with the specified name, value, and expiration time.

- `$name`: The name of the cookie.
- `$value`: The value of the cookie.
- `$time`: The expiration time in hours (default is 1 hour).

#### get

```php
public static function get($name)
```

This method gets the value of the cookie with the specified name.

- `$name`: The name of the cookie.
- Returns: The value of the cookie if it exists, null otherwise.

#### exists

```php
public static function exists($name)
```

This method checks if a cookie with the specified name exists.

- `$name`: The name of the cookie.
- Returns: True if the cookie exists, false otherwise.

#### delete

```php
public static function delete($name)
```

This method deletes the cookie with the specified name.

- `$name`: The name of the cookie.

## Example Usage

Here are some examples of how to use the `Cookie` class:

```php
<?php

// Set a cookie
Cookie::set('username', 'john_doe', 24);

// Get the value of a cookie
$username = Cookie::get('username');

// Check if a cookie exists
if (Cookie::exists('username')) {
    // Do something
}

// Delete a cookie
Cookie::delete('username');
```

