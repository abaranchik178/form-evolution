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
        if ( ! isset($data['csrfSecret']) || ! $this->isValidCsrfSecret($data['csrfSecret']) ) {
            throw new \Exception('Invalid CSRF secret');
        }
        unset($data['csrfSecret']);

        $sanitizedData = $this->sanitizeData($data);

        $this->email = $sanitizedData['email'];
        $this->password = $sanitizedData['password'];
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
    public function getPassword()
    {
        return $this->password;
    }



    public function getUserState()
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}