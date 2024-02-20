# Components Class Documentation

The `Components` class is responsible for generating HTML components such as buttons, alerts, input fields, textareas, selects, navbars, side navigations, dashboard widgets, cards, modals, badges, progress bars, accordions, dropdowns, tabs, and tables. It provides methods to generate these components with customizable options.

## Class: Components

### Properties

- `cssFramework`: The CSS framework being used for generating components.

### Constructor

```php
public function __construct($cssFramework)
```

The constructor function initializes the `Components` object with the specified CSS framework.

- `cssFramework`: The CSS framework to be used for generating components.

### Methods

#### generateButton

```php
public function generateButton($text, $options = [])
```

This method generates a button component.

- `text`: The text to display on the button.
- `options`: Additional options for the button.
- Returns: The generated HTML for the button component.

**Example:**

```php
$components = new Components('Bootstrap');
$button = $components->generateButton('Click me');
echo $button;
```

#### generateAlert

```php
public function generateAlert($message, $type = 'info', $options = [])
```

This method generates an alert component.

- `message`: The message to display in the alert.
- `type`: The type of the alert (e.g., success, warning, danger).
- `options`: Additional options for the alert.
- Returns: The generated HTML for the alert component.

**Example:**

```php
$components = new Components('TailwindCSS');
$alert = $components->generateAlert('Warning: Something went wrong!', 'warning');
echo $alert;
```

#### generateInput

```php
public function generateInput($type = 'text', $name, $options = [])
```

This method generates an input field component.

- `type`: The type of the input field (e.g., text, email, password).
- `name`: The name attribute for the input field.
- `options`: Additional options for the input field.
- Returns: The generated HTML for the input field component.

**Example:**

```php
$components = new Components('Bulma');
$input = $components->generateInput('email', 'email', ['placeholder' => 'Enter your email']);
echo $input;
```

#### generateTextarea

```php
public function generateTextarea($name, $options = [])
```

This method generates a textarea component.

- `name`: The name attribute for the textarea.
- `options`: Additional options for the textarea.
- Returns: The generated HTML for the textarea component.

**Example:**

```php
$components = new Components('MaterializeCSS');
$textarea = $components->generateTextarea('message', ['rows' => 4]);
echo $textarea;
```

#### generateSelect

```php
public function generateSelect($name, $options = [], $selectedValue = null, $attributes = [])
```

This method generates a select component.

- `name`: The name attribute for the select field.
- `options`: The options for the select field.
- `selectedValue`: The selected value of the select field.
- `attributes`: Additional attributes for the select field.
- Returns: The generated HTML for the select component.

**Example:**

```php
$components = new Components('Semantic UI');
$options = [
    '1' => 'Option 1',
    '2' => 'Option 2',
    '3' => 'Option 3'
];
$select = $components->generateSelect('mySelect', $options, '2', ['class' => 'custom-select']);
echo $select;
```

#### generateNavbar

```php
public function generateNavbar($items = [], $options = [])
```

This method generates a navbar component.

- `items`: The items to display in the navbar.
- `options`: Additional options for the navbar.
- Returns: The generated HTML for the navbar component.

**Example:**

```php
$components = new Components('Foundation');
$navbarItems = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'About', 'url' => '/about'],
    ['label' => 'Contact', 'url' => '/contact']
];
$navbar = $components->generateNavbar($navbarItems);
echo $navbar;
```

#### generateSideNav

```php
public function generateSideNav($items = [], $options = [])
```

This method generates a side navigation component.

- `items`: The items to display in the side navigation.
- `options`: Additional options for the side navigation.
- Returns: The generated HTML for the side navigation component.

**Example:**

```php
$components = new Components('UIKit');
$sidenavItems = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Products', 'url' => '/products'],
    ['label' => 'Services', 'url' => '/services']
];
$sidenav = $components->generateSideNav($sidenavItems);
echo $sidenav;
```

#### generateDashboardWidget

```php
public function generateDashboardWidget($title, $content, $options = [])
```

This method generates a dashboard widget component.

- `title`: The title of the widget.
- `content`: The content of the widget.
- `options`: Additional options for the widget.
- Returns: The generated HTML for the dashboard widget component.

**Example:**

```php
$components = new Components('UIKit');
$title = 'Latest Updates';
$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel cursus tortor.';
$widget = $components->generateDashboardWidget($title, $content, ['class' => 'dashboard-widget']);
echo $widget;
```

#### generateCard

```php
public function generateCard($title, $content, $image = '', $options = [])
```

This method generates a card component.

- `title`: The title of the card.
- `content`: The content of the card.
- `image`: The URL of the image for the card.
- `options`: Additional options for the card.
- Returns: The generated HTML for the card component.

**Example:**

```php
$components = new Components('TailwindCSS');
$title = 'Product Title';
$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel cursus tortor.';
$imageUrl = 'https://example.com/product-image.jpg';
$card = $components->generateCard($title, $content, $imageUrl, ['class' => 'card']);
echo $card;
```

#### generateModal

```php
public function generateModal($id, $title, $content)
```

This method generates a modal component.

- `id`: The ID of the modal.
- `title`: The title of the modal.
- `content`: The content of the modal.
- Returns: The generated HTML for the modal component.

**Example:**

```php
$components = new Components('Bootstrap');
$modalId = 'myModal';
$modalTitle = 'Modal Title';
$modalContent = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
$modal = $components->generateModal($modalId, $modalTitle, $modalContent);
echo $modal;
```

#### generateBadge

```php
public function generateBadge($text, $options = [])
```

This method generates a badge component.

- `text`: The text content of the badge.
- `options`: Additional options for the badge.
- Returns: The generated HTML for the badge component.

**Example:**

```php
$components = new Components('MaterializeCSS');
$text = 'New';
$badge = $components->generateBadge($text, ['class' => 'badge']);
echo $badge;
```

#### generateProgressBar

```php
public function generateProgressBar($progress, $options = [])
```

This method generates a progress bar component.

- `progress`: The progress value (in percentage).
- `options`: Additional options for the progress bar.
- Returns: The generated HTML for the progress bar component.

**Example:**

```php
$components = new Components('Bulma');
$progress = 75;
$progressBar = $components->generateProgressBar($progress, ['class' => 'progress-bar']);
echo $progressBar;
```

#### generateAccordion

```php
public function generateAccordion($items = [], $options = [])
```

This method generates an accordion component.

- `items`: An array of items for the accordion.
- `options`: Additional options for the accordion.
- Returns: The generated HTML for the accordion component.

**Example:**

```php
$components = new Components('Semantic UI');
$accordionItems = [
    ['title' => 'Section 1', 'content' => 'Content of section 1'],
    ['title' => 'Section 2', 'content' => 'Content of section 2']
];
$accordion = $components->generateAccordion($accordionItems);
echo $accordion;
```

#### generateDropdown

```php
public function generateDropdown($options = [], $selectedValue = null, $attributes = [])
```

This method generates a dropdown component.

- `options`: An array of options for the dropdown.
- `selectedValue`: The value of the selected option.
- `attributes`: Additional attributes for the dropdown.
- Returns: The generated HTML for the dropdown component.

**Example:**

```php
$components = new Components('UIKit');
$options = [
    '1' => 'Option 1',
    '2' => 'Option 2',
    '3' => 'Option 3'
];
$selectedValue = '2';
$dropdown = $components->generateDropdown($options, $selectedValue);
echo $dropdown;
```

#### generateTabs

```php
public function generateTabs($items = [], $options = [])
```

This method generates tabs navigation.

- `items`: An array of tab items.
- `options`: Additional options for the tabs.
- Returns: The generated HTML for the tabs navigation.

**Example:**

```php
$components = new Components('Foundation');
$tabItems = [
    ['label' => 'Tab 1', 'content' => 'Content of tab 1'],
    ['label' => 'Tab 2', 'content' => 'Content of tab 2']
];
$tabs = $components->generateTabs($tabItems);
echo $tabs;
```

#### generateTabContent

```php
public function generateTabContent($items = [], $options = [])
```

This method generates tab content.

- `items`: An array of tab items.
- `options`: Additional options for the tab content.
- Returns: The generated HTML for the tab content.

**Example:**

```php
$components = new Components('TailwindCSS');
$tabItems = [
    ['label' => 'Tab 1', 'content' => 'Content of tab 1'],
    ['label' => 'Tab 2', 'content' => 'Content of tab 2']
];
$tabContent = $components->generateTabContent($tabItems);
echo $tabContent;
```

#### generateTable

```php
public function generateTable($data = [], $options = [])
```

This method generates a table component.

- `data`: An array of data for the table.
- `options`: Additional options for the table.
- Returns: The generated HTML for the table component.

**Example:**

```php
$components = new Components('Bootstrap');
$data = [
    ['Name', 'Age', 'Country'],
    ['John Doe', '25', 'USA'],
    ['Jane Smith', '30', 'Canada']
];
$table = $components->generateTable($data);
echo $table;
```
