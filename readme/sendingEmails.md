## Class: Sendemail

The `Sendemail` class provides methods for sending and saving emails using the PHPMailer library.

### Methods

#### `public static function send($config, $addresses, $info, $attachments = [], $folder = "Sent")`

Send an email using the provided configuration.

##### Parameters

- `$config` (array): The email configuration.
- `$addresses` (array): The email addresses [from, to, reply, cc, bcc].
- `$info` (array): The email information [subject, body, altBody].
- `$attachments` (array, optional): The email attachments.
- `$folder` (string, optional): The folder to copy the email to (e.g., "Sent", "Drafts").

##### Returns

- (bool): True if the email was sent successfully, false otherwise.

#### `public static function draft($config, $addresses, $info, $attachments = [], $folder = "Drafts")`

Save an email as a draft using the provided configuration.

##### Parameters

- `$config` (array): The email configuration.
- `$addresses` (array): The email addresses [from, to, reply, cc, bcc].
- `$info` (array): The email information [subject, body, altBody].
- `$attachments` (array, optional): The email attachments.
- `$folder` (string, optional): The folder to copy the email to (e.g., "Sent", "Drafts").

##### Returns

- (bool): True if the email was saved as a draft successfully, false otherwise.

### Private Methods

#### `private static function sendEmail($config, $addresses, $info, $attachments, $folder)`

Send or save an email using the provided configuration.

##### Parameters

- `$config` (array): The email configuration.
- `$addresses` (array): The email addresses [from, to, reply, cc, bcc].
- `$info` (array): The email information [subject, body, altBody].
- `$attachments` (array): The email attachments.
- `$folder` (string): The folder to copy the email to (e.g., "Sent", "Drafts").

##### Returns

- (bool): True if the email was sent or saved successfully, false otherwise.

## Sending an Email
```php
$config = [
    'SMTPDebug' => SMTP::DEBUG_OFF,
    'Host' => 'smtp.example.com',
    'Username' => 'your_email@example.com',
    'Password' => 'your_password',
    'SMTPSecure' => PHPMailer::ENCRYPTION_SMTPS,
    'Port' => 465
];

$addresses = [
    'from' => ['sender@example.com', 'Sender Name'],
    'to' => ['recipient@example.com'],
    'reply' => ['replyto@example.com', 'Reply-to Name'],
    'cc' => ['cc1@example.com', 'cc2@example.com'],
    'bcc' => ['bcc1@example.com', 'bcc2@example.com']
];

$info = [
    'Email Subject',
    '<h1>Email Body</h1>',
    'Alternative plain text body'
];

$attachments = ['path/to/file1.pdf', 'path/to/file2.jpg'];

$result = Sendemail::send($config, $addresses, $info, $attachments);
if ($result) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email.";
}
```

## Saving an email as a draft:
```php
$config = [
    'SMTPDebug' => SMTP::DEBUG_OFF,
    'Host' => 'smtp.example.com',
    'Username' => 'your_email@example.com',
    'Password' => 'your_password',
    'SMTPSecure' => PHPMailer::ENCRYPTION_SMTPS,
    'Port' => 465
];

$addresses = [
    'from' => ['sender@example.com', 'Sender Name'],
    'to' => ['recipient@example.com'],
    'reply' => ['replyto@example.com', 'Reply-to Name'],
    'cc' => ['cc1@example.com', 'cc2@example.com'],
    'bcc' => ['bcc1@example.com', 'bcc2@example.com']
];

$info = [
    'Email Subject',
    '<h1>Email Body</h1>',
    'Alternative plain text body'
];

$attachments = ['path/to/file1.pdf', 'path/to/file2.jpg'];

$result = Sendemail::draft($config, $addresses, $info, $attachments);
if ($result) {
    echo "Email saved as draft!";
} else {
    echo "Failed to save email as draft.";
}
```

