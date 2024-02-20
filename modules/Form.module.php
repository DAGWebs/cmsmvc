<?php

class Form
{
    // Class properties definition with brief descriptions.
    private $_action, // The form's action attribute value.
    $_method, // The form's method attribute (e.g., 'POST', 'GET').
    $_inputs = [], // Array holding all form inputs.
    $_validators = [], // Validators for form inputs.
    $_errors = [], // Collection of validation errors.
    $_formAttributes = [], // Additional HTML attributes for the form tag.
    $_dynamicFields = false, // Flag or structure for dynamic fields addition.
    $_hasFileUploads = false, // Indicates if the form includes file uploads.
    $_captchaEnabled = false, // Flag to enable CAPTCHA integration.
    $_customComponents = [], // Custom components added to specific inputs.
    $_additionalComponents = [], // Additional components for inputs.
    $_generalComponents = [], // Components that are general to the form, not tied to specific inputs.
    $_wrapInFormGroup = []; // Specifies inputs wrapped in a form group.

    /**
     * Constructor to initialize form with action, method, and additional attributes.
     */

    public function __construct($action = '', $method = 'POST', $_formAttributes = [])
    {
        $this->_action = $action;
        $this->_method = $method;
        $this->_formAttributes = $_formAttributes;
    }

    /**
     * Adds an input field to the form.
     */

    public function addInput($name, $type, $options, $renderingType = 'input')
    {
        $this->_inputs[$name] = ['type' => $type, 'options' => $options, 'renderingType' => $renderingType];

        if ($type === 'file') {
            $this->_hasFileUploads = true;
        }
    }

    /**
     * Sets or updates form attributes.
     */

    public function setFormAttributes($formAttributes)
    {
        $this->_formAttributes = $formAttributes;
    }

    /**
     * Enables or disables dynamic field addition to the form.
     */

    public function setDynamicFields($dynamicFields)
    {
        $this->_dynamicFields = $dynamicFields;
    }

    /**
     * Enables or disables CAPTCHA for the form.
     */

    public function setCaptchaEnabled(bool $captchaEnabled)
    {
        $this->_captchaEnabled = $captchaEnabled;
    }

    /**
     * Adds a custom validator to an input field.
     */

    public function addValidator($name, callable $validator, $errorMessage = [])
    {
        $this->_validators[$name][] = ['validator' => $validator, 'message' => $errorMessage];

    }

    /**
     * Validates the form inputs against added validators.
     */

    public function validate()
    {
        foreach ($this->_validators as $name => $validators) {
            foreach ($validators as $validator) {
                if (!call_user_func($validator['validator'])) {
                    $this->_errors[$name][] = $validator['message'];
                }
            }
        }

        return empty($this->_errors);
    }

    /**
     * Specifies whether an input should be wrapped in a form group with optional class name.
     */
    public function setFormGroupWrapping($inputName, $wrap = true, $className = 'form-group')
    {
        $this->_wrapInFormGroup[$inputName] = $wrap ? $className : false;
    }

    /**
     * Adds a component (like a custom HTML structure) to an input.
     */

    public function addComponent($inputName, Component $component, $position = 'before')
    {
        $this->_additionalComponents[$inputName][$position][] = $component;
    }

    /**
     * Adds a custom component to an input.
     */

    public function addCustomComponent($inputName, Component $component, $position = 'before')
    {
        $this->_customComponents[$inputName][$position][] = $component;
    }

    /**
     * Adds a general component to the form, not specifically tied to an input.
     */

    public function addGeneralComponent(Component $component, $position = 'end')
    {
        if ($position === 'start') {
            array_unshift($this->_generalComponents, $component);
        } else {
            // 'end' or any other value will append the component at the end
            $this->_generalComponents[] = $component;
        }
    }

    /**
     * Renders the form with all inputs, components, and attributes.
     */

    public function render()
    {
        $formAttributes = array_merge(['action' => $this->_action, 'method' => $this->_method], $this->_formAttributes);

        if ($this->_hasFileUploads) {
            $formAttributes['enctype'] = 'multipart/form-data';
        }

        $form = new Component('form', $formAttributes);

        foreach ($this->_generalComponents as $component) {
            $form->append($component);
        }

        foreach ($this->_inputs as $name => $input) {
            $wrapClass = $this->_wrapInFormGroup[$name] ?? false;

            $formGroup = $wrapClass ? new Component('div', ['class' => $wrapClass]) : null;

            if (isset($this->_customComponents[$name]['before'])) {
                foreach ($this->_customComponents[$name]['before'] as $component) {
                    $formGroup ? $formGroup->append($component) : $form->append($component);
                }
            }

            $inputComponent = $this->renderInput($name, $input, $input['renderingType']);
            $formGroup ? $formGroup->append($inputComponent) : $form->append($inputComponent);

            if ($formGroup) {
                $form->append($formGroup);
            }
        }

        if ($this->_dynamicFields) {
            $form->append($this->_dynamicFields);
        }

        if ($this->_captchaEnabled) {
            $form->append($this->renderCaptcha());
        }

        return $form->render();
    }

    /**
     * The following functions rinder various input fields
     */

    private function renderInput($name, $input, $type = 'input')
    {
        $attributes = $input['options'];
        $attributes['type'] = $input['type'];
        $attributes['name'] = $name;

        switch ($type) {
            case 'checkbox':
                return $this->renderCheckbox($name, $input);
            case 'file':
                return $this->renderFileInput($name, $input);
            case 'hidden':
                return $this->renderHiddenInput($name, $input);
            case 'radio':
                return $this->renderRadio($name, $input);
            case 'select':
                return $this->renderSelect($name, $input);
            case 'textarea':
                return $this->renderTextarea($name, $input);
            case 'submit':
                return $this->renderSubmit($name, $input);
            case 'link':
                return $this->renderLink($name, $input);
            default:
                return $this->renderTextInput($name, $input);
        }
    }

    private function renderTextInput($name, $input)
    {
        $attributes = $input['options'];
        $attributes['type'] = $input['type'];
        $attributes['name'] = $name;

        return new Component('input', $attributes);
    }

    private function renderLink($text, $input)
    {
        $attributes = $input['options'];
        return new Component('a', $attributes, $text);
    }

    private function renderHiddenInput($name, $input)
    {
        $attributes = $input['options'];
        $attributes['type'] = 'hidden';
        $attributes['name'] = $name;

        return new Component('input', $attributes);
    }

    private function renderSelect($name, $input)
    {
        $select = new Component('select', ['name' => $name]);

        foreach ($input['options']['choices'] as $value => $display) {
            $option = new Component('option', ['value' => $value], $display);
            $select->append($option);
        }

        return $select;
    }


    private function renderCheckbox($name, $input)
    {
        $attributes = $input['options'];
        $attributes['type'] = 'checkbox';
        $attributes['name'] = $name;

        return new Component('input', $attributes);
    }

    private function renderTextarea($name, $input)
    {
        $attributes = $input['options'];
        $attributes['name'] = $name;

        return new Component('textarea', $attributes);
    }


    private function renderRadio($name, $input)
    {

        $radioHtml = '';

        foreach ($input['options']['choices'] as $value => $display) {
            $attributes = ['type' => 'radio', 'name' => $name, 'value' => $value];
            $radio = new Component('input', $attributes);
            $label = new Component('label', [], $radio->render() . " " . $display);
            $radioHtml .= $label->render();
        }

        return $radioHtml;
    }

    private function renderFileInput($name, $input)
    {
        $attributes = $input['options'];
        $attributes['type'] = 'file';
        $attributes['name'] = $name;

        return new Component('input', $attributes);
    }

    private function renderSubmit($name, $input)
    {
        $attributes = $input['options'];
        $attributes['type'] = 'submit';
        $attributes['name'] = $name;

        return new Component('input', $attributes);
    }

    private function renderAttributes($attributes)
    {
        $attString = '';

        foreach ($attributes as $key => $value) {
            $attString .= htmlspecialchars($key) . '="' . htmlspecialchars($value) . '" ';
        }

        return $attString;
    }

    private function renderCaptcha()
    {
        $captchaUrl = Config::get('captcha.url');
        return "<script src='{$captchaUrl}'></script>";
    }

    /**
     * Returns the collection of validation errors.
     */

    public function getErrors()
    {
        return $this->_errors;
    }

}