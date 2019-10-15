<?php


namespace classes;


class RegistrationForm
{
    private $email;
    private $firstName;
    private $lastName;
    private $gender;
    private $password1;
    private $password2;

    const FIELDS = [
        'firstName' => ['sanitizeText'],
        'lastName' => ['sanitizeText'],
        'email' => ['sanitizeText'],
        'birthDate' => ['sanitizeText'],
        'password1' => [],
        'password2' => [],
        'gender' => ['sanitizeText'],
    ];

    public function __construct()
    {

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

    public function sanitizeData(array $data): array
    {
        $sanitizedData = [];
        foreach ($data as $fieldName => $fieldValue) {
            if ( ! isset(self::FIELDS[$fieldName]) ) {
                error_log("Remove not allowed field: $fieldName");
                continue;
            }
            $sanitizedValue = $fieldValue;
            foreach (self::FIELDS[$fieldName] as $sanitizeMethodName) {
                if ( !method_exists($this, $sanitizeMethodName)) {
                    throw new \Exception("Unknown method $sanitizeMethodName");
                }
                $sanitizedValue = $this->{$sanitizeMethodName}($sanitizedValue);
            }
            $sanitizedData[$fieldName] = $sanitizedValue;
        }
        return $sanitizedData;
    }

    private function sanitizeText(string $text)
    {
        return htmlspecialchars( trim($text) );
    }
}