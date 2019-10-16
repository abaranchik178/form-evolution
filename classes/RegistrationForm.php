<?php


namespace classes;


use abaranchik178\validation\rules\Email;
use abaranchik178\validation\rules\Equal;
use abaranchik178\validation\rules\NotEmpty;
use abaranchik178\validation\rules\StringLength;
use abaranchik178\validation\validators\ArrayValidator;

class RegistrationForm
{
    use ExternalDataSource;

    private $validator;

    //form fields with default values
    private $email = '';
    private $firstName = '';
    private $lastName = '';
    private $gender = '';
    private $password1 = '';
    private $password2 = '';

    public function getFields(): array
    {
        return [
            'firstName' => ['sanitizeText'],
            'lastName' => ['sanitizeText'],
            'email' => ['sanitizeText'],
            'birthDate' => ['sanitizeText'],
            'password1' => [],
            'password2' => [],
            'gender' => ['sanitizeText'],
        ];
    }

    public function loadData(array $data)
    {
        $sanitizedData = $this->sanitizeData($data);

        $this->email = $sanitizedData['email'];
        $this->firstName = $sanitizedData['firstName'];
        $this->lastName = $sanitizedData['lastName'];
        $this->gender = $sanitizedData['gender'];
        $this->password1 = $sanitizedData['password1'];
        $this->password2 = $sanitizedData['password2'];
    }

    public function validate($data)
    {
        if ( ! isset($data['csrfSecret']) || ! $this->isValidCsrfSecret($data['csrfSecret']) ) {
            throw new \Exception('Invalid CSRF secret');
        }
        unset($data['csrfSecret']);

        $this->initValidator($data);
        $this->validator->validate($data);

        if ( $this->validator->isHasErrors() ) {
            return false;
        }
        return true;
    }

    public function getUserState()
    {
        return [
            'email' => $this->email,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'gender' => $this->gender,
            'password' => $this->password1,
        ];
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return mixed
     */
    public function getPassword1()
    {
        return $this->password1;
    }

    /**
     * @return mixed
     */
    public function getPassword2()
    {
        return $this->password2;
    }
}