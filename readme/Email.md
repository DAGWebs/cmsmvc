# Email Class Documentation

The `Email` class provides methods to interact with email messages using the IMAP protocol.

## Class: Email

The `Email` class is responsible for connecting to the mail server, retrieving email messages, and performing various operations on them.

### Properties

- `_con`: The connection resource to the mail server.
- `_host`: The IMAP host.
- `_username`: The IMAP username.
- `_password`: The IMAP password.

### Constructor

```php
public function __construct($folder = "")
```

The constructor initializes a new instance of the `Email` class.

- `$folder`: The folder/mailbox to select (optional).

### Method: getFolders

```php
public function getFolders()
```

This method gets the list of available folders/mailboxes.

- Returns: An array of folder names or `false` if an error occurs.

### Method: parseHeaders

```php
public function parseHeaders($headers)
```

This method parses the headers of an email message and returns an associative array.

- `$headers`: The headers of the email message.
- Returns: An associative array representing the parsed headers.

### Method: headers

```php
public function headers($msg)
```

This method gets the raw headers of an email message.

- `$msg`: The message number.
- Returns: The raw headers of the email message as a string.

### Method: parsedHeader

```php
public function parsedHeader($msg)
```

This method parses the headers of an email message and returns an associative array.

- `$msg`: The message number.
- Returns: An associative array representing the parsed headers.

### Method: getAttachments

```php
public function getAttachments($message_number, $part, $prefix)
```

This method gets the attachments of an email message.

- `$message_number`: The message number.
- `$part`: The part object representing the attachment.
- `$prefix`: The prefix for the attachment (e.g., "1.2").
- Returns: An array containing information about the attachments.

### Method: delete

```php
public function delete($msg)
```

This method deletes an email message.

- `$msg`: The message number.
- Returns: `true` if the deletion was successful, `false` otherwise.

### Method: getAllFolders

```php
public function getAllFolders()
```

This method gets a list of all folders/mailboxes.

- Returns: An array of all folder/mailbox names.

### Method: search

```php
public function search($criteria = 'ALL', $flags = 0, $charset = "UTF-8")
```

This method searches for email messages based on given criteria.

- `$criteria`: The search criteria (default is "ALL").
- `$flags`: The search flags (default is 0).
- `$charset`: The character set to use (default is "UTF-8").
- Returns: An array of message numbers matching the search criteria or `false` if no messages are found.

### Method: getMessages

```php
public function getMessages($num)
```

This method gets the header information of an email message.

- `$num`: The message number.
- Returns: An object representing the header information of the email message or `false` if an error occurs.

### Method: bodyPreview

```php
public function bodyPreview($id)
```

This method gets a preview of the message body.

- `$id`: The message number.
- Returns: A string representing a preview of the message body.

### Method: body

```php
public function body($id)
```

This method gets the full message body.

- `$id`: The message number.
- Returns: A string representing the full message body.

### Method: createFolder

```php
public function createFolder($folder)
```

This method creates a new folder/mailbox.

- `$folder`: The name of the folder/mailbox to create.
- Returns: `true` if the folder/mailbox creation was successful, `false` otherwise.

### Method: renameFolder

```php
public function renameFolder($old, $new)
```

This method renames a folder/mailbox.

- `$old`: The name of the folder/mailbox to rename.
- `$new`: The new name for the folder/mailbox.
- Returns: `true` if the folder/mailbox renaming was successful, `false` otherwise.

### Method: removeFolder

```php
public function removeFolder($folder)
```

This method removes/deletes a folder/mailbox.

- `$folder`: The name of the folder/mailbox to remove.
- Returns: `true` if the folder/mailbox removal was successful, `false` otherwise.

## Example Usage

Here's an example of how to use the `Email` class:

```php
<?php

// Create a new instance of the Email class
$email = new Email();

// Get the list of available folders/mailboxes
$folders = $email->getFolders();

// Parse the headers of an email message
$headers = $email->parseHeaders($email->headers(1));

// Get the attachments of an email message
$attachments = $email->getAttachments(1, $part, $prefix);

// Delete an email message
$email->delete(1);

// Get a list of all folders/mailboxes
$allFolders = $email->getAllFolders();

// Search for email messages
$messages = $email->search('FROM "example@example.com"');

// Get the header information of an email message
$message = $email->getMessages(1);

// Get a preview of the message body
$bodyPreview = $email->bodyPreview(1);

// Get the full message body
$body = $email->body(1);

// Create a new folder/mailbox
$email->createFolder('NewFolder');

// Rename a folder/mailbox
$email->renameFolder('OldFolder', 'NewFolder');

// Remove/delete a folder/mailbox
$email->removeFolder('FolderToDelete');
```
