## Class: Model

The `Model` class represents a basic model for interacting with a database table. It provides methods for performing common database operations such as inserting, updating, and deleting records. It also allows for custom SQL queries and provides utility methods for data manipulation. It is prefable to create another class that extends off of your model IE if you create a UserModel class you can then create a User class in the Modules that extends the UserModel and runs functions from it with out modifying the table for every use after runing the parrent constructor.

### Properties

- `protected $_db`: An instance of the database connection class.
- `protected $_table`: The name of the associated database table.
- `protected $_modelName`: The name of the model class.
- `protected $_softDelete`: A flag indicating whether soft delete is enabled.
- `protected $_columnNames`: An array of column names in the associated table.
- `public $id`: The ID of the model instance.

### Constructor

#### `public function __construct($table)`

The constructor method initializes the `Model` object with the name of the associated table.

##### Parameters

- `$table` (string): The name of the table associated with the model.

### Methods

#### `protected function _setTableColumns()`

Set the column names of the associated table.

#### `public function get_columns()`

Get the columns of the associated table.

##### Returns

- (array): An array of column objects representing the columns of the table.

#### `public function find($params = [])`

Find records in the associated table based on given parameters.

##### Parameters

- `$params` (array): The search parameters.

##### Returns

- (array): An array of model objects representing the search results.

#### `public function save()`

Save the model instance to the associated table.

##### Returns

- (bool): True on success, false on failure.

#### `public function insert($fields)`

Insert data into the associated table.

##### Parameters

- `$fields` (array): The data to be inserted.

##### Returns

- (bool): True on success, false on failure.

#### `public function update($id, $fields)`

Update data in the associated table.

##### Parameters

- `$id` (int): The ID of the record to be updated.
- `$fields` (array): The updated data.

##### Returns

- (bool): True on success, false on failure.

#### `public function delete($id = '')`

Delete a record from the associated table.

##### Parameters

- `$id` (int): The ID of the record to be deleted.

##### Returns

- (bool): True on success, false on failure.

#### `public function query($sql, $bind)`

Execute a custom SQL query.

##### Parameters

- `$sql` (string): The SQL query.
- `$bind` (array): The values to bind to the query.

##### Returns

- (bool|DB): The DB instance or false on failure.

#### `public function findFirst($params)`

Find the first record in the associated table based on given parameters.

##### Parameters

- `$params` (array): The search parameters.

##### Returns

- (Model|false): A model object representing the first search result, or false if not found.

#### `public function findById($id)`

Find a record in the associated table by ID.

##### Parameters

- `$id` (int): The ID of the record to find.

##### Returns

- (Model|false): A model object representing the found record, or false if not found.

#### `public function data()`

Get an empty data object with column names as properties.

##### Returns

- (stdClass): The data object.

#### `public function assign($params)`

Assign values to the model's properties based on input parameters.

##### Parameters

- `$params` (array): The assignment parameters.

##### Returns

- (bool): True if assignment is successful, false otherwise.

#### `protected function populateObjData($result)`

Populate the model's properties with data from a database result.

##### Parameters

- `$result` (object): The database result object.


```php
  // Create an instance of the Model class
  // pass in params for the table
$model = new Model('users', [
  'user_id' => 'AUTO INCREMENT PRIMARY KEY INT',
  'user_username' => 'VARCHAR(255) UNIQUE'
]);

// Find all users
$users = $model->find();

// Loop through the results
foreach ($users as $user) {
    echo $user->username;
}

// Find a user by ID
$user = $model->findById(1);

// Update the user's email
$user->email = 'newemail@example.com';
$user->save();

// Delete a user
$user->delete();

// Execute a custom query
$sql = 'SELECT * FROM users WHERE age > ?';
$bind = [18];
$result = $model->query($sql, $bind);

// Assign values to the model
$params = ['username' => 'john', 'email' => 'john@example.com'];
$user->assign($params);
$user->save();
```
