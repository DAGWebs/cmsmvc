# SwellMVC Documentation

Welcome to the SwellMVC documentation. This documentation provides comprehensive information on the classes used in the SwellMVC framework, designed to offer a powerful and efficient development experience. Below you will find an overview of the key classes and their functionalities.

## Table of Contents

- [Getting Started](#getting-started)
- [FormBuilder Class](#formbuilder-class)
- [Model Class](#model-class)
- [DB Class](#db-class)
- [Router Class](#router-class)
- [Security Class](#security-class)
- [Email Class](#email-class)
- [SendEmail Class](#sendemail-class)
- [CPanelAPI Class](#cpanelapi-class)
- [API Class](#api-class)
- [Footer](#footer)

## Getting Started

To get started with SwellMVC, follow these steps:

1. **Create a View**: Create a file called `viewname.view.php` in the designated view folder. Use the `start()` function to begin each section (`head`, `body`, and `foot`) and the `end()` function to close it. Render the content within these sections to generate the HTML for your view. Example:

   ```php
   $this->view->start('head');
   // Content for the head section
   $this->view->end();

   $this->view->start('body');
   // Content for the body section
   $this->view->end();

   $this->view->start('foot');
   // Content for the foot section
   $this->view->end();
   ```

2. **Create a Controller**: Create a new controller file that extends the `Controller` class. In the controller's constructor, call the parent constructor and set the layout file you want to use. Define action methods to handle different requests. Use the `render($view, $data = [])` method to load the corresponding view. Example:

   ```php
   class Dashboard extends Controller {
       public function __construct($controller, $action) {
           parent::__construct($controller, $action);
           $this->view->setLayout('dashboard');
       }

       public function indexAction() {
           $this->view->render('dashboard', 'index');
       }
   }
   ```

3. **Create a Model**: Create a new model file that extends the `Model` class. In the constructor, set any necessary configurations and define properties specific to the model. You can interact with the associated database table using the provided model methods, such as `find()`, `save()`, `insert()`, `update()`, and `delete()`. Example:

   ```php
   class User extends Model {
       public function __construct($user = '') {
           $this->_sessionName = Config::get('user session name');
           $this->_cookieName = Config::get('cookie name');
           $this->_softDelete = true;

           // Additional logic to populate model properties based on user data
       }
   }
   ```

## FormBuilder Class

The `FormBuilder` class is responsible for generating HTML forms and handling form field validation.

**Key Functions:**

- `addField($type, $name, $label, $attributes = [])`: Add a form field to the form.
- `addValidationRules($name, $attributes)`: Add validation rules for a form field.
- `validate($data)`: Validate the form data based on the defined validation rules.

[View a full documentation for this class!](https://github.com/DAGWebs/cmsmvc/blob/main/readme/forms.md)

## Model Class

The `Model` class provides a base class for interacting with database tables.

**Key Functions:**

- `find($params = [])`: Find records in the associated table based on given parameters.
- `save()`: Save the model instance to the associated table.
- `insert($fields)`: Insert data into the associated table.
- `update($id, $fields)`: Update data in the associated table.
- `delete($id = '')`: Delete a record from the associated table.

[View a full documentation for this class!](https://github.com/DAGWebs/cmsmvc/blob/main/readme/model.md)

## DB Class

The `DB` class provides database interaction functionalities.

**Key Functions:**

- `getInstance()`: Get the singleton instance of the database connection.
- `query($sql, $params = [])`: Execute a SQL query.
- `insert($table, $fields)`: Insert data into a database table.
- `update($table, $id, $fields)`: Update data in a database table.
- `delete($table, $id)`: Delete a record from a database table.
  [View a full documentation for this class!](https://github.com/DAGWebs/cmsmvc/blob/main/readme/dbWrapper.md)

## Router Class

The `Router` class handles routing and URL mapping. It automatically routes requests based on the controller and action names.
[View a full documentation for this class!](https://github.com/DAGWebs/cmsmvc/blob/main/readme/routing.md)

## Security Class

The `Security` class provides security-related functionality.

**Key Functions:**

- `sanitize($data)`: Sanitize input data.
- `hashPassword($password)`: Hash a password.
- `verifyPassword($password, $hash)`: Verify a password against a hash.
  [View a full documentation for this class!](https://github.com/DAGWebs/cmsmvc/blob/main/readme/security.md)

## Email Class

The `Email` class provides functionality for sending and managing emails. It includes methods to send emails, view and receive emails using IMAP functions, create and delete folders, and retrieve email details.

**Key Functions:**

- `send($to, $subject, $message)`: Send an email.
- `delete($folder)`: Delete a folder.
- `getAllFolders()`: Get a list of all email folders.
- `search($folder, $criteria)`: Search for emails within a folder.
- `getMessages($folder)`: Get messages within a folder.
- `bodyPreview($folder, $message)`: Get the body preview of a message.
- `body($folder, $message)`: Get the full body of a message.
- `createFolder($folder)`: Create a new email folder.
  [View a full documentation for this class!](https://github.com/DAGWebs/cmsmvc/blob/main/readme/Email.md)

## SendEmail Class

The `SendEmail` class provides functionality for sending and managing email drafts. It includes methods to send emails and create email drafts.

**Key Functions:**

- `send($to, $subject, $message)`: Send an email.
- `draft($to, $subject, $message)`: Create an email draft.
  [View a full documentation for this class!](https://github.com/DAGWebs/cmsmvc/blob/main/readme/sendingEmails.md)

## CPanelAPI Class

The `CPanelAPI` class allows you to interact with a cPanel account. It provides methods for creating accounts, deleting domains, creating and managing domains, and using the cPanel API to manage your cPanel account.

**Key Functions:**

- `login($username, $password)`: Log in to the cPanel account.
- `logout()`: Log out from the cPanel account.
- `createAccount($username, $password)`: Create a new account.
- `deleteAccount($username)`: Delete an existing account.
- `createDomain($domain)`: Create a new domain.
- `deleteDomain($domain)`: Delete a domain.
  [View a full documentation for this class!](https://github.com/DAGWebs/cmsmvc/blob/main/readme/CpanelAPI.md)

## API Class

The `API` class allows users to create GET, POST, UPDATE, and DELETE requests using corresponding methods. It provides a convenient interface for working with APIs.

**Key Functions:**

- `get($url, $data = [])`: Perform a GET request.
- `post($url, $data = [])`: Perform a POST request.
- `update($url, $data = [])`: Perform an UPDATE request.
- `delete($url, $data = [])`: Perform a DELETE request.
  [View a full documentation for this class!](https://github.com/DAGWebs/cmsmvc/blob/main/readme/api.md)

## Footer

This concludes the SwellMVC documentation. You now have a comprehensive understanding of the classes and functionalities available in the framework. Should you have any further questions or need additional assistance, please refer to the SwellMVC community or support resources.

Happy coding with SwellMVC!
