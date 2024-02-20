## Class: Session

The `Session` class provides methods for managing session variables and retrieving user agent information.

### Methods

#### `public static function set($name, $value)`

Set a session value.

##### Parameters

- `$name` (string): The session variable name.
- `$value` (mixed): The session variable value.

#### `public static function get($name)`

Get a session value.

##### Parameters

- `$name` (string): The session variable name.

##### Returns

- (mixed|null): The session variable value if exists, null otherwise.

#### `public static function exists($name)`

Check if a session variable exists.

##### Parameters

- `$name` (string): The session variable name.

##### Returns

- (bool): True if the session variable exists, false otherwise.

#### `public static function delete($name)`

Delete a session variable.

##### Parameters

- `$name` (string): The session variable name.

#### `public static function uagent_no_version()`

Get the user agent without version information.

##### Returns

- (string): The user agent without version.

## Setting a session:
```php
Session::set('user_id', 123);

```
## Getting a session:
```php
$user_id = Session::get('user_id');
echo $user_id;

```
## Checking if session exists
```php
if (Session::exists('user_id')) {
    echo "Session variable exists.";
} else {
    echo "Session variable does not exist.";
}

```
## deleteing a session
```php
Session::delete('user_id');

```
## get the user agent with out a version
```php
$userAgent = Session::uagent_no_version();
echo $userAgent;

```
