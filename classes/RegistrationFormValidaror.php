<?php


namespace classes;


use abaranchik178\validation\rules\{
    Email,
    Callback,
    Equal,
    NotEmpty,
    StringLength
};
use abaranchik178\validation\validators\ArrayValidator;

class RegistrationFormValidaror extends ArrayValidator
{
    public function validate($data)
    {
        $this->addRules($data);
        return parent::validate($data);
    }

    private function addRules($data)
    {
        $this->addRule('email', new Email());
        $this->addRule('email', new StringLength(255));

        $emailExistsRule = new Callback(function($email) {
            $userMapper = new UserMapper();
            if ( $userMapper->findUserByEmail( $email ) ) {
                return false;
            }
            return true;
        });
        $emailExistsRule->setErrorMessage('This email address is already use');
        $this->addRule('email', $emailExistsRule);

        $this->addRule('firstName', new NotEmpty());
        $this->addRule('firstName', new StringLength(70));

        $this->addRule('lastName', new StringLength(70));

        $this->addRule('password1', new NotEmpty());
        $this->addRule('password1', new StringLength(100, 8));
        $this->addRule('password1', new Equal($data['password2'] ?? null));
    }
}