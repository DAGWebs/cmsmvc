# CPanelAPI Class Documentation

The `CPanelAPI` class provides methods to interact with the cPanel API.

## Class: CPanelAPI

The `CPanelAPI` class is responsible for handling interactions with the cPanel API.

### Properties

- `baseUrl`: The base URL for the cPanel API.
- `username`: The username for authentication with the cPanel API.
- `apiKey`: The API key for authentication with the cPanel API.

### Constructor

```php
public function __construct()
```

The constructor initializes the `CPanelAPI` object with the base URL, username, and API key.

### Methods

#### makeRequest

```php
private function makeRequest($endpoint, $params = [], $method = 'GET')
```

This method makes a request to the cPanel API.

- `$endpoint`: The API endpoint to call.
- `$params`: The parameters to include in the request (optional).
- `$method`: The HTTP method to use (GET or POST).
- Returns: The API response in the following format: `['status' => bool, 'errors' => array, 'data' => mixed]`.

#### listAccounts

```php
public function listAccounts()
```

This method gets a list of accounts.

- Returns: The API response containing a list of accounts.

#### createAccount

```php
public function createAccount($username, $domain, $password)
```

This method creates a new cPanel account.

- `$username`: The username for the new account.
- `$domain`: The domain for the new account.
- `$password`: The password for the new account.
- Returns: The API response indicating the status of the account creation.

#### terminateAccount

```php
public function terminateAccount($username)
```

This method terminates a cPanel account.

- `$username`: The username of the account to terminate.
- Returns: The API response indicating the status of the account termination.

#### changeAccountPassword

```php
public function changeAccountPassword($username, $password)
```

This method changes the password of a cPanel account.

- `$username`: The username of the account to change the password for.
- `$password`: The new password for the account.
- Returns: The API response indicating the status of the password change.

#### listAddonDomains

```php
public function listAddonDomains($username)
```

This method gets a list of addon domains for a cPanel account.

- `$username`: The username of the account.
- Returns: The API response containing a list of addon domains.

#### createAddonDomain

```php
public function createAddonDomain($username, $domain, $subdomain, $dir)
```

This method creates a new addon domain for a cPanel account.

- `$username`: The username of the account.
- `$domain`: The domain name of the addon domain.
- `$subdomain`: The subdomain for the addon domain.
- `$dir`: The directory for the addon domain.
- Returns: The API response indicating the status of the addon domain creation.

#### removeAddonDomain

```php
public function removeAddonDomain($username, $domain)
```

This method removes an addon domain from a cPanel account.

- `$username`: The username of the account.
- `$domain`: The domain name of the addon domain to remove.
- Returns: The API response indicating the status of the addon domain removal.

#### listEmailAccounts

```php
public function listEmailAccounts($domain)
```

This method gets a list of email accounts for a domain.

- `$domain`: The domain name.
- Returns: The API response containing a list of email accounts.

#### createEmailAccount

```php
public function createEmailAccount($email, $password, $quota = 0, $domain)
```

This method creates a new email account for a domain.

- `$email`: The email address.
- `$password`: The password for the email account.
- `$quota`: The quota for the email account (optional).
- `$domain`: The domain name.
- Returns: The API response indicating the status of the email account creation.

#### removeEmailAccount

```php
public function removeEmailAccount($email, $domain)
```

This method removes an email account from a domain.

- `$email`: The email address.
- `$domain`: The domain name.
- Returns: The API response indicating the status of the email account removal.

## Example Usage

Here are some examples of how to use the `CPanelAPI` class:

```php
<?php

// Create a new CPanelAPI instance
$cpanel = new CPanelAPI();

// Get a list of accounts
$accounts = $cpanel->listAccounts();

// Create a new cPanel account
$response = $cpanel->createAccount('newuser', 'example.com', 'password123');

// Terminate a cPanel account
$response = $cpanel->terminateAccount('existinguser');

// Change the password of a cPanel account
$response = $cpanel->changeAccountPassword('existinguser', 'newpassword');

// Get a list of addon domains for a cPanel account
$addonDomains = $cpanel->listAddonDomains('existinguser');

// Create a new addon domain for a cPanel account
$response = $cpanel->createAddonDomain('existinguser', 'newdomain.com', 'subdomain', 'directory');

// Remove an addon domain from a cPanel account
$response = $cpanel->removeAddonDomain('existinguser', 'existingdomain.com');

// Get a list of email accounts for a domain
$emailAccounts = $cpanel->listEmailAccounts('example.com');

// Create a new email account for a domain
$response = $cpanel->createEmailAccount('user@example.com', 'emailpassword', 100, 'example.com');

// Remove an email account from a domain
$response = $cpanel->removeEmailAccount('user@example.com', 'example.com');
```

