## Class: Security

The `Security` class provides various security-related methods for sanitizing input, generating and verifying CSRF tokens, encrypting and verifying passwords, and retrieving user agent information.

### Methods

#### `public static function sanitize($dirty)`

Sanitize a string by converting special characters to HTML entities.

##### Parameters

- `$dirty` (string): The string to sanitize.

##### Returns

- (string): The sanitized string.

#### `public static function genToken()`

Generate a CSRF token and store it in the session.

#### `public static function newToken()`

Generate a new CSRF token.

##### Returns

- (string): The generated token.

#### `public static function check($token)`

Check if a CSRF token matches the one stored in the session.

##### Parameters

- `$token` (string): The CSRF token to check.

##### Returns

- (bool): True if the token matches, false otherwise.

#### `public static function encrypt($password)`

Encrypt a password using the bcrypt hashing algorithm.

##### Parameters

- `$password` (string): The password to encrypt.

##### Returns

- (string): The encrypted password hash.

#### `public static function verify($password, $hash)`

Verify a password against a bcrypt hash.

##### Parameters

- `$password` (string): The password to verify.
- `$hash` (string): The bcrypt hash to compare against.

##### Returns

- (bool): True if the password matches the hash, false otherwise.

#### `public static function agent()`

Get the user agent of the current HTTP request.

##### Returns

- (string): The user agent string.

## sanitizing strings:
```php
$dirtyString = '<script>alert("XSS attack!");</script>';
$sanitizedString = Security::sanitize($dirtyString);
echo $sanitizedString;
```
## Generate a Token
```php
Security::genToken();
$newToken = Security::newToken();
echo $newToken;

$submittedToken = $_POST['token'];
if (Security::check($submittedToken)) {
    echo "CSRF token is valid.";
} else {
    echo "CSRF token is invalid.";
}


```

## Passwords
```php
$password = 'mysecretpassword';
$hashedPassword = Security::encrypt($password);
echo $hashedPassword;

$password = 'mysecretpassword';
$hashedPassword = '$2y$10$HmlsnO4nnpRCV.q3Sis6Gum5qexUoKThj56FDHJ.bPZj3KClapw7G';
if (Security::verify($password, $hashedPassword)) {
    echo "Password is valid.";
} else {
    echo "Password is invalid.";
}

### Get The USER AGENT
$userAgent = Security::agent();
echo $userAgent;


```
