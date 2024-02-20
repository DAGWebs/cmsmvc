# PHP API Class Documentation

This is a PHP class named `API` that encapsulates methods for sending HTTP requests, encoding/decoding JSON, handling routing, and sending responses.

## Class Properties

- `$_code`: This property is an array which stores the HTTP status codes and their corresponding messages.
- `$_payload`: This property is used to store the URL components after the '/api' segment.

## Class Methods

### __construct()

This is the constructor function of the class. It sets the response content type to JSON and extracts the URL components after the '/api' segment.

### decode($json)

This function takes a JSON encoded string as an argument and decodes it into a PHP value.

**Example:**
```php
$api = new API();
$data = $api->decode('{"name":"John","age":30}');
```
### encode($data)

This function encodes a PHP array or object into a JSON string.

**Example:**
```php
$api = new API();
$json = $api->encode(array('name' => 'John', 'age' => 30));
```
### response($type, $message, $data)

This function sends a response back to the client. It throws an ErrorException if the status code is not found.

**Example:**
```php
$api = new API();
$api->response('success', 'Data fetched successfully', $data);
```

### successResponse($message, $data)
This function sends a success response with a message and data.

**Example**
```php
$api = new API();
$api->unauthorizedResponse('Unauthorized access');
```

### badRequestResponse($message)
This function generates a bad request error response with a given message.

**Example:**
```php
$api = new API();
$api->badRequestResponse('Invalid data provided');
```

### unauthorizedResponse($message)
This function generates an unauthorized response with a given message.

**Example:**
```php
$api = new API();
$api->unauthorizedResponse('Unauthorized access');
```

### get($url, $callback, $response = 'success', $headers = ["Content-Type: application/json"])
This function executes a GET request to the specified URL and handles the response based on the given response type.

**Example:**
```php
$api = new API();
$api->post('http://example.com/api/data', function($data) {
    // Process the data...
}, 'success');

$api = new API();
$api->post('users', function($data) {
    // Process the data...
}, 'success');
```

delete($url, $callback, $response = 'success', $headers = ["Content-Type: application/json"])
This function deletes a resource from the specified URL.

**Example:**
```php
$api = new API();
$api->delete('http://example.com/api/data', function($data) {
    // Process the data...
}, 'success');

$api = new API();
$api->delete('users/{id}', function($data) {
    // Process the data...
}, 'success');
```

### update($url, $callback, $response = 'success', $headers = ["Content-Type: application/json"])
This function updates a resource from a given URL and returns a success or error response.

**Example:**
```php
$api = new API();
$api->update('http://example.com/api/data', function($data) {
    // Process the data...
}, 'success');

$api = new API();
$api->update('users/{id}', function($data) {
    // Process the data...
}, 'success');
```

### get($url, $callback, $response = 'success', $headers = ["Content-Type: application/json"])
This function executes a GET request to the specified URL and handles the response based on the given response type.

**Example:**
```php
$api = new API();
$api->get('http://example.com/api/data', function($data) {
    // Process the data...
}, 'success');

$api = new API();
$api->get('users', function($data) {
    // Process the data...
}, 'success');
```


# Creating your own API

First you need to modify your windows host if on windows and add api.localhost to the available hosts or create a wildcard subdomain *.domain.com this will point you to your api ie domain.com api would be api.domain.com 

Once done then create a new file in app/API/endpoints/yourendpointname.php then you can use the router by calling $api = new Router() and calling the corasponding methed here is an expample.

the first peramater will be the second part of the endpoint so if your file is api.domain.com/users then the argument would be / but if you were on api.domain.com/users/list the the argument would be /list then the next argument would be a function this is where all your code goes so if you wanted to go to the database and return a list of users you could json_decode($result)

**Example**
```php
<?php
$api = new Router();

$api->get('/list', function () {
   echo "hello users";
});

$api->get("/", function () {
   echo " from /";
});

$api->delete("/", function () {
   echo " / is set to delete";
});

$api->put("/", function () {
    echo " / is set to put";
 });

 $api->get("/user", function() {
    


 });
```
