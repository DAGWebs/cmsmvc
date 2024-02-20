## Class: Router

The `Router` class handles routing and dispatching of HTTP requests in the application.

### Properties

- `protected $_routes`: Array to store routes.
- `protected $_payload`: Array to store payload data.

### Methods

#### `public function get($path, $callback, $payload)`

Add a GET route.

##### Parameters

- `$path` (string): The URL path.
- `$callback` (callable): The callback function or method.
- `$payload` (mixed, optional): Optional payload data associated with the route.

#### `public function post($path, $callback)`

Add a POST route.

##### Parameters

- `$path` (string): The URL path.
- `$callback` (callable): The callback function or method.

#### `public function put($path, $callback)`

Add a PUT route.

##### Parameters

- `$path` (string): The URL path.
- `$callback` (callable): The callback function or method.

#### `public function delete($path, $callback)`

Add a DELETE route.

##### Parameters

- `$path` (string): The URL path.
- `$callback` (callable): The callback function or method.

#### `public function getPayload()`

Get the payload data associated with the current route.

##### Returns

- (mixed): The payload data.

#### `public function route($url)`

Route the request to the appropriate handler based on the URL.

##### Parameters

- `$url` (string): The requested URL.

#### `protected function handleApiEndpoints($requestMethod)`

Handle API endpoints.

##### Parameters

- `$requestMethod` (array): The request method and segments.

#### `protected function handleAutoRouting($segments)`

Handle regular controllers.

##### Parameters

- `$segments` (array): The URL segments.

#### `protected function convertEndpointToPattern($endpoint)`

Convert an endpoint URL to a regex pattern.

##### Parameters

- `$endpoint` (string): The endpoint URL.

##### Returns

- (string): The regex pattern.

#### `protected function handleNotFound()`

Handle 404 Not Found error.

#### `protected function invokeCallbackWithArguments($callback, $arguments)`

Invoke a callback with arguments.

##### Parameters

- `$callback` (callable): The callback function or method.
- `$arguments` (array): The arguments to pass to the callback.

#### `protected function invokeCallback($callback)`

Invoke a callback without arguments.

##### Parameters

- `$callback` (callable): The callback function or method.

#### `public function redirect($location)`

Redirect to a specified location.

##### Parameters

- `$location` (string): The URL or path to redirect to.
```php
$router = new Router();

$router->get('/home', function() {
    echo 'Welcome to the home page!';
}, null);


$router = new Router();

$router->post('/login', function() {
    // Handle login logic
});


$router = new Router();

$router->put('/users/{id}', function($id) {
    // Update user with the given ID
});

$router = new Router();

$router->delete('/users/{id}', function($id) {
    // Delete user with the given ID
});

$router = new Router();

$router->route($_SERVER['REQUEST_URI']);


$router = new Router();

// Assume the payload is set for the current route
$payload = $router->getPayload();

// Access the payload data
var_dump($payload);


$router = new Router();

$router->redirect('/dashboard');
```
