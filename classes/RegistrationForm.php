<?php


namespace classes;


class RegistrationForm
{
    use ExternalDataSource;

    private $email;
    private $firstName;
    private $lastName;
    private $gender;
    private $password1;
    private $password2;

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
}