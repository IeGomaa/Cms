<?php

namespace Validation;

class Validation {

    /**
     * @var array $patterns
     */
    private $patterns = [
        'email'         => '/^[\w.-]+?@[a-z]+?\.[a-z]+$/',
        'alpha'         => '/^[a-z]+$/',
        'int'           => '/^[0-9]+$/',
        'float'         => '/^[0-9\.]+$/',
        'tel'           => '/^[0-9+\h()-]+$/'
    ];

    private $data;
    private $errors = '';

    public function value($value) {
        $this->data = $value;
        return $this;
    }

    public function string() {
        $this->data = filter_var($this->data,FILTER_SANITIZE_STRING);
        if (!(preg_match($this->patterns['alpha'],$this->data))) {
            $this->errors = 'error';
        }
        return $this;
    }

    public function integer() {
        $this->data = filter_var($this->data,FILTER_SANITIZE_NUMBER_INT);
        $this->data = filter_var($this->data,FILTER_VALIDATE_INT,FILTER_NULL_ON_FAILURE);

        if ($this->data === NULL) {
            $this->errors = 'error';
        }

        if (!(preg_match($this->patterns['int'],$this->data))) {
            $this->errors = 'error';
        }
        return $this;
    }

    public function float() {
        $this->data = filter_var($this->data,FILTER_SANITIZE_NUMBER_FLOAT,[
            'flags' => FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND
        ]);
        $this->data = filter_var($this->data,FILTER_VALIDATE_FLOAT,FILTER_NULL_ON_FAILURE);

        if ($this->data === NULL) {
            $this->errors = 'error';
        }

        if (!(preg_match($this->patterns['float'],$this->data))) {
            $this->errors = 'error';
        }

        return $this;
    }

    public function telephone() {
        if (!(preg_match($this->patterns['tel'],$this->data))) {
            $this->errors = 'error';
        }
        return $this;
    }

    public function email() {
        $this->data = filter_var($this->data,FILTER_SANITIZE_EMAIL);
        $this->data = filter_var($this->data,FILTER_VALIDATE_EMAIL,FILTER_NULL_ON_FAILURE);

        if ($this->data === NULL) {
            $this->errors = 'error';
        }

        if ((!preg_match($this->patterns['email'],$this->data))) {
            $this->errors = 'error';
        }
        return $this;
    }

    public function max($length) {
        if (strlen($this->data) > $length) {
            $this->errors = 'error';
        }
        return $this;
    }

    public function min($length) {
        if (strlen($this->data) < $length) {
            $this->errors = 'error';
        }
        return $this;
    }

    public function required() {

        if (is_null($this->data)) {
            $this->errors = 'error';
        }

        if (empty($this->data)) {
            $this->errors = 'error';
        }

        if (strlen(trim($this->data)) === 0) {
            $this->errors = 'error';
        }
        return $this;
    }

    public function successful()
    {
        if (strlen($this->errors) == 0) {
            return true;
        }
    }

}