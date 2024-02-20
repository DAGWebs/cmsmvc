# DB Class Documentation

The `DB` class provides database connectivity and query execution functionalities.

## Class: DB

The `DB` class is responsible for handling database connectivity and executing queries.

### Properties

- `_pdo`: The PDO object for database connectivity.
- `_query`: The prepared statement object for executing queries.
- `_error`: The error status of the most recent query.
- `_results`: The results of the most recent query.
- `_count`: The number of rows affected by the most recent query.
- `_lastInsertID`: The last inserted ID from the most recent query.

### Constructor

```php
private function __construct()
```

The constructor initializes a new instance of the `DB` class.

### Method: getInstance

```php
public static function getInstance()
```

This method gets the singleton instance of the `DB` class.

- Returns: The `DB` instance.

### Method: query

```php
public function query($sql, $params = [])
```

This method executes a database query with optional parameters.

- `$sql`: The SQL query to execute.
- `$params`: The optional parameters for the query.
- Returns: The `DB` instance.

### Method: _read

```php
protected function _read($table, $params = [])
```

This method reads data from a database table based on specified parameters.

- `$table`: The name of the database table.
- `$params`: The optional parameters for the query.
- Returns: True if the query was successful and results are available, false otherwise.

### Method: find

```php
public function find($table, $params = [])
```

This method finds records from a database table based on specified parameters.

- `$table`: The name of the database table.
- `$params`: The optional parameters for the query.
- Returns: The results of the query if successful, false otherwise.

### Method: findFirst

```php
public function findFirst($table, $params = [])
```

This method finds the first record from a database table based on specified parameters.

- `$table`: The name of the database table.
- `$params`: The optional parameters for the query.
- Returns: The first result of the query if successful, false otherwise.

### Method: insert

```php
public function insert($table, $fields = [])
```

This method inserts a new record into a database table.

- `$table`: The name of the database table.
- `$fields`: The fields and values to insert.
- Returns: True if the insertion was successful, false otherwise.

### Method: update

```php
public function update($table, $id, $fields = [])
```

This method updates records in a database table.

- `$table`: The name of the database table.
- `$id`: The ID of the record to update.
- `$fields`: The fields and values to update.
- Returns: True if the update was successful, false otherwise.

### Method: delete

```php
public function delete($table, $id)
```

This method deletes a record from a database table.

- `$table`: The name of the database table.
- `$id`: The ID of the record to delete.
- Returns: True if the deletion was successful, false otherwise.

### Method: results

```php
public function results()
```

This method returns the results of the most recent query.

- Returns: The results of the query.

### Method: first

```php
public function first()
```

This method returns the first result of the most recent query.

- Returns: The first result of the query.

### Method: count

```php
public function count()
```

This method returns the number of rows affected by the most recent query.

- Returns: The number of rows affected.

### Method: lastID

```php
public function lastID()
```

This method returns the last inserted ID from the most recent query.

- Returns: The last inserted ID.

### Method: get_columns

```php
public function get_columns($table)
```

This method retrieves the column information for a database table.

- `$table`: The name of the database table.
- Returns: The column information of the table.

### Method: error

```php
public function error()
```

This method returns the error status of the most recent query.

- Returns: True if an error occurred, false otherwise.

## Example Usage

Here's an example of how to use the `DB` class:

```php
<?php

// Get the DB instance
$db = DB::getInstance();

// Execute a database query
$db->query('SELECT * FROM users WHERE id = ?', [1]);

// Get the results
$results = $db->results();

// Iterate through the results
foreach ($results as $result) {
    echo $result->username . '<br>';
}

// Get the count
$count = $db->count();

// Get the first result
$firstResult = $db->first();

// Insert a new record
$db->insert('users', [
    'username' => 'john',
    'email' => 'john@example.com'
]);

// Update a record
$db->update('users', 1, [
    'username' => 'john_doe',
    'email' => 'john_doe@example.com'
]);

// Delete a record
$db->delete('users', 1);
```

