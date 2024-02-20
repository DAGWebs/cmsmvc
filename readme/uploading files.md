## Class: Upload

The `Upload` class provides methods for handling file uploads.

### Methods

#### `public static function file($file)`

Handle file upload.

##### Parameters

- `$file` (array): The `$_FILES` array for the uploaded file.

##### Returns

- (string|false): The path of the uploaded file if successful, false otherwise.

### Private Methods

#### `private static function generateUniqueFilename($filename)`

Generate a unique filename.

##### Parameters

- `$filename` (string): The original filename.

##### Returns

- (string): The unique filename.

#### `private static function getFileExtension($filename)`

Get the file extension from a filename.

##### Parameters

- `$filename` (string): The filename.

##### Returns

- (string): The file extension.

#### `private static function isExtensionAllowed($extension)`

Check if a file extension is allowed.

##### Parameters

- `$extension` (string): The file extension.

##### Returns

- (bool): True if the extension is allowed, false otherwise.

```php
$file = $_FILES['file'];

$uploadedFilePath = Upload::file($file);
if ($uploadedFilePath) {
    echo "File uploaded successfully. Path: " . $uploadedFilePath;
} else {
    echo "Failed to upload file.";
}
```
