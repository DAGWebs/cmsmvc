# Config Class

The `Config` class provides functionality to load, set, and retrieve configuration values from the `.env` file.

## Methods

### `loadEnv($path)`

Load configuration values from the `.env` file.

- Parameters:
  - `$path` (string): Path to the `.env` file.

### `set($name, $value)`

Set a configuration value.

- Parameters:
  - `$name` (string): Configuration key.
  - `$value` (mixed): Configuration value.
- Returns:
  - The set value.

### `get($name)`

Get a configuration value.

- Parameters:
  - `$name` (string): Configuration key.
- Returns:
  - The configuration value if found, `null` otherwise.

## Usage

### Loading configuration values from the `.env` file

```php
Config::loadEnv('.env');

// Access configuration values
$databaseHost = Config::get('DB HOST');
$databaseUser = Config::get('DB USER');
$databasePass = Config::get('DB PASSWORD');

// Use the configuration values
```
## settign a config value
```php
Config::set('API KEY', '12345');

// Retrieve the set value
$apiKey = Config::get('API KEY');
echo $apiKey; // Output: 12345
```
## getting a config value
```php
$debugMode = Config::get('DEBUG MODE');

if ($debugMode) {
    // Perform debug operations
    // ...
} else {
    // Skip debug operations
    // ...
}

```

**Keep in mind the Config::get() function removes the _ and replaces it with a space** 
