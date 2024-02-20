## Class: View

The `View` class provides methods for rendering views and managing layout files.

### Properties

- `protected $_head`
- `protected $_body`
- `protected $_foot`
- `protected $_siteTitle`
- `protected $_outputBuffer`
- `protected $_layout`
- `protected $_pageName`
- `protected $_payload`

### Methods

#### `public function render($viewName, $view, $payload = '', $useLayout = true)`

Render the view.

##### Parameters

- `$viewName` (string): The name of the view folder.
- `$view` (string): The name of the view file.
- `$payload` (string): The payload data to pass to the view. Default: `''`.
- `$useLayout` (bool): Whether to use a layout file. Default: `true`.

#### `public function content($type)`

Get the content of a specific section.

##### Parameters

- `$type` (string): The section type ('head', 'body', 'foot').

##### Returns

- (string|false): The content of the section if found, false otherwise.

#### `public function end()`

End the output buffer for the current section and capture the content.

##### Returns

- (string|false): The captured content if successful, false otherwise.

#### `public function start($type)`

Start an output buffer for a specific section.

##### Parameters

- `$type` (string): The section type ('head', 'body', 'foot').

#### `public function siteTitle()`

Get the site title.

##### Returns

- (string): The site title.

#### `public function setSiteTitle($title)`

Set the site title.

##### Parameters

- `$title` (string): The site title.

#### `public function setLayout($layout = '')`

Set the layout file to use.

##### Parameters

- `$layout` (string): The name of the layout file. Default: `''`.

#### `public function setPageName($name)`

Set the page name.

##### Parameters

- `$name` (string): The page name.

#### `public function pageName()`

Get the page name.

##### Returns

- (string): The page name.

#### `public function getPayload()`

Get the payload data.

##### Returns

- (mixed): The payload data.

##### Examples
## render a view with a layou
```php
  $view = new View();
$view->setSiteTitle('My Website');
$view->setLayout('main');

$view->render('folder', 'view', ['data' => 'payload'], true);
```
## render a view without a layout
```php
$this->$view->setSiteTitle('My Website');

$this->$view->render('folder', 'view', ['data' => 'payload'], false);

```
## Set A Head section
```php

$this->$view->start('head');

// Output HTML or add content to the "head" section
echo '<title>My Page</title>';
echo '<link rel="stylesheet" href="styles.css">';

$this->$view->end(); // End the "head" section and capture the content

// Render the view and use the captured "head" section content
$this->$view->render('folder', 'view');

// Access the captured "head" section content
$headContent = $view->content('head');
echo $headContent;
```
## set the body section
```php

$this->view->start('body');

// Output HTML or add content to the "body" section
echo '<h1>Welcome to my page</h1>';
echo '<p>This is the main content.</p>';

$this->$view->end(); // End the "body" section and capture the content

// Render the view and use the captured "body" section content
$view->render('folder', 'view');

// Access the captured "body" section content
$bodyContent = $this->$view->content('body');
echo $bodyContent;
```
## setting the fooder section
```php
$view = new View();
$view->start('foot');

// Output HTML or add content to the "foot" section
echo '<script src="script.js"></script>';
echo '<footer>&copy; 2023 My Website</footer>';

$this->$view->end(); // End the "foot" section and capture the content

// Render the view and use the captured "foot" section content
$view->render('folder', 'view');

// Access the captured "foot" section content
$footContent = $view->content('foot');
echo $footContent;
```

### A FULL TEMPLATE
```php
$this->setSiteTitle('Login')
$this->view->start('head');
header contetent here
$this->view->end();
$this->view->start('body');
body content here
$this->view->end();
$this->view->start('foot');
footer content here
$this->view->end();
```
