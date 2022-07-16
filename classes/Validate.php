<?php
class Validate
{
    private $_passed = false,
        $_errors = array(),
        $_db = null,
        $_success = array();

    public function __construct()
    {
        $this->_db = Db::getInstance();
    }

    public function check($source, $items = array())
    {

        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {

                $value = $source[$item];
                $item = escape($item);

                if ($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is required");
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError("{$item} must be a maximum of {$rule_value} characters.");
                            }
                            break;
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $this->addError("{$rule_value} must match {$item}");
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if ($check->count()) {
                                $this->addError("{$item} already exist.");
                            }
                            break;
                        case 'email':
                            $sanitize = filter_var($value, FILTER_SANITIZE_EMAIL);
                            if (!filter_var($sanitize, FILTER_VALIDATE_EMAIL)) {
                                $this->addError("Email is not a valid!");
                            }
                    }
                }
            }
        }

        if (empty($this->_errors)) {
            $this->_passed = true;
        }
    }

    public function checkUpload($source, $items = array())
    {
        foreach ($items as $item) {
            $value = $source[$item];
            if ($value['error'] == 4) {
                $this->_errors[] = "post_image is required";
            } elseif ($value["size"] > 5000000) {
                $this->addError("Sorry, your file is too large.");
            } elseif ($value['type'] != "image/jpg" && $value['type'] != "image/png" && $value['type'] != "image/jpeg" && $value['type'] != "image/gif") {
                    $this->addError("Sorry, only JPG, JPEG, PNG & GIF files are allowed");
            }
        }
        if (empty($this->_errors)) {
            $this->_passed = true;
        }
    }

    public function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function addSuccess($success)
    {
        $this->_success[] = $success;
    }

    public function success()
    {
        return $this->_success;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function passed()
    {
        return $this->_passed;
    }
}
