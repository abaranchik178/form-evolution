<?php


namespace classes;


class LoginForm
{
    use ExternalDataSource;

    private $email;
    private $password;

    public function getFields(): array
    {
        return [
            'email' => ['sanitizeText'],
            'password' => [],
        ];
    }

    public function loadData(array $data)
    {
        $sanitizedData = $this->sanitizeData($data);

        $this->email = $sanitizedData['email'];
        $this->password = $sanitizedData['password'];
    }



    public function getUserState()
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}