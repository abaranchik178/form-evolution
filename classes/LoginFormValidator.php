<?php


namespace classes;


use abaranchik178\validation\rules\Email;
use abaranchik178\validation\rules\NotEmpty;
use abaranchik178\validation\validators\ArrayValidator;

class LoginFormValidator extends ArrayValidator
{

    public function validate($data)
    {
        $this->addRules($data);
        return parent::validate($data);
    }

    private function addRules($data)
    {
        $this->addRule('email', new Email());
        $this->addRule('password', new NotEmpty());
    }
}