<?php
class Validate {
    private $fields;

    public function __construct() {
        $this->fields = new Fields();
    }

    public function getFields() {
        return $this->fields;
    }

    // Validate a generic text field
    public function text($name, $value,
            $required = true, $min = 1, $max = 255) {

        // Get Field object
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Check field and set or clear error message
        if ($required && empty($value)) {
            $field->setErrorMessage('Required.');
        } else if (strlen($value) < $min) {
            $field->setErrorMessage('Too short.');
        } else if (strlen($value) > $max) {
            $field->setErrorMessage('Too long.');
        } else {
            $field->clearErrorMessage();
        }
    }

    // Validate a field with a generic pattern
    public function pattern($name, $value, $pattern, $message,
            $required = true) {

        // Get Field object
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Check field and set or clear error message
        $match = preg_match($pattern, $value);
        if ($match === false) {
            $field->setErrorMessage('Error testing field.');
        } else if ( $match != 1 ) {
            $field->setErrorMessage($message);
        } else {
            $field->clearErrorMessage();
        }
    }

    public function phone($name, $value, $required = true) {
        $field = $this->fields->getField($name);

        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) { return; }

        // Call the pattern method to validate a phone number
        $pattern = '/^\([[:digit:]]{3}\) [[:digit:]]{3}-[[:digit:]]{4}$/';
        $message = 'Use (999)999-9999 format';
        $this->pattern($name, $value, $pattern, $message, $required);
    }

    public function email($name, $value, $required = true) {
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) { return; }

        // Split email address on @ sign and check parts
        $parts = explode('@', $value);
        if (count($parts) < 2) {
            $field->setErrorMessage('At sign required.');
            return;
        }
        if (count($parts) > 2) {
            $field->setErrorMessage('Only one at sign allowed.');
            return;
        }
        $local = $parts[0];
        $domain = $parts[1];

        // Check length of email
        if (strlen($value) < 1 || strlen($value) > 50){
            $field->setErrorMessage('Email is too long.');
            return;
        }

        // Patterns for address formatted local part
        $atom = '[[:alnum:]_!#$%&\'*+\/=?^`{|}~-]+';
        $dotatom = '(\.' . $atom . ')*';
        $address = '(^' . $atom . $dotatom . '$)';

        // Patterns for quoted text formatted local part
        $char = '([^\\\\"])';
        $esc  = '(\\\\[\\\\"])';
        $text = '(' . $char . '|' . $esc . ')+';
        $quoted = '(^"' . $text . '"$)';

        // Combined pattern for testing local part
        $localPattern = '/' . $address . '|' . $quoted . '/';

        // Call the pattern method and exit if it yields an error
        $this->pattern($name, $local, $localPattern,
                'Invalid username part.');
        if ($field->hasError()) { return; }

        // Patterns for domain part
        $hostname = '([[:alnum:]]([-[:alnum:]]{0,62}[[:alnum:]])?)';
        $hostnames = '(' . $hostname . '(\.' . $hostname . ')*)';
        $top = '\.[[:alnum:]]{2,6}';
        $domainPattern = '/^' . $hostnames . $top . '$/';

        // Call the pattern method
        $this->pattern($name, $domain, $domainPattern,
                'Invalid domain name part.');
    }

    public function password($name, $password, $required = true) {
        $field = $this->fields->getField($name);

        if (!$required && empty($password)) {
            $field->clearErrorMessage();
            return;
        }

        $this->text($name, $password, $required, 6, 20);
        if ($field->hasError()) { return; }
    }

    public function postalCode($name, $value, $required = true) {
        $field = $this->fields->getField($name);
        $this->text($name, $value, $required);
        if ($field->hasError()) { return; }

        $pattern = '/^[[:digit:]]{5}(-[[:digit:]]{4})?$/';
        $message = 'Invalid zip code.';
        $this->pattern($name, $value, $pattern, $message, $required);
    }
    
    public function state($name, $value, $required = true) {
        $field = $this->fields->getField($name);

        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        $this->text($name, $value, $required, 1, 50);
        if ($field->hasError()) { return; }
    }
    
    public function firstName($name, $fName, $required = true) {
        $field = $this->fields->getField($name);

        if (!$required && empty($fName)) {
            $field->clearErrorMessage();
            return;
        }

        $this->text($name, $fName, $required, 1, 50);
        if ($field->hasError()) { return; }
    }
    
    public function lastName($name, $lName, $required = true) {
        $field = $this->fields->getField($name);

        if (!$required && empty($lName)) {
            $field->clearErrorMessage();
            return;
        }

        $this->text($name, $lName, $required, 1, 50);
        if ($field->hasError()) { return; }
    }
    
    public function address($name, $address, $required = true) {
        $field = $this->fields->getField($name);

        if (!$required && empty($address)) {
            $field->clearErrorMessage();
            return;
        }

        $this->text($name, $address, $required, 1, 50);
        if ($field->hasError()) { return; }
    }
    
    public function city($name, $city, $required = true) {
        $field = $this->fields->getField($name);

        if (!$required && empty($city)) {
            $field->clearErrorMessage();
            return;
        }

        $this->text($name, $city, $required, 1, 50);
        if ($field->hasError()) { return; }
    }

}
?>