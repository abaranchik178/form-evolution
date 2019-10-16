<?php


namespace classes;


class User
{
    private $id;
    private $email;
    private $firstName;
    private $lastName;
    private $birthDate;
    private $gender;
    private $password;
    private $passwordHash;
    private $secretString;
    private $settings;

    public function __construct($state)
    {
        if ( isset($state['id']) ) {
            $this->setId($state['id']);
        }
        if ( isset($state['firstName']) ) {
            $this->setFirstName($state['firstName']);
        }
        if ( isset($state['lastName']) ) {
            $this->setLastName($state['lastName']);
        }
        if ( isset($state['email']) ) {
            $this->setEmail($state['email']);
        }
        if ( isset($state['birthDate']) ) {
            $this->setBirthDate($state['birthDate']);
        }
        if ( isset($state['gender']) ) {
            $this->setGender($state['gender']);
        }

        if ( isset($state['settings']) ) {
            $this->setSettings($state['settings']);
        }

        if ( isset($state['passwordHash']) ) {
            $this->setPasswordHash($state['passwordHash']);
        } elseif (isset($state['password'])) {
            $this->setPassword($state['password']);
        } else {
            throw new \Exception('User state required password or password hash');
        }

        if ( isset($state['secretString']) ) {
            $this->setSecretString($state['secretString']);
        }
    }

    public static function hashPassword($password)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        if (false === $passwordHash) {
            throw new \LogicException('Can not create password hash');
        }
        return $passwordHash;
    }

    /**
     * @param string $password
     * @return bool
     * @throws \Exception\
     */
    public function verifyPassword(string $password)
    {
        if ( !isset($this->passwordHash) ) {
            throw new \Exception('User not have a password hash. User id: ' . $this->id);
        }
        return \password_verify($password, $this->passwordHash);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getBirthDate()
    {
        return $this->birthDate;
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
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    /**
     * @return mixed
     */
    public function getSecretString()
    {
        return $this->secretString;
    }

    /**
     * @param mixed $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate(string $birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @param mixed $gender
     */
    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }

    /**
     * @param mixed $passwordHash
     */
    public function setPasswordHash(string $passwordHash)
    {
        $this->passwordHash = $passwordHash;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
        $this->setPasswordHash( self::hashPassword($password) );
    }

    /**
     * @param mixed $secretString
     */
    public function setSecretString(string $secretString)
    {
        $this->secretString = $secretString;
    }
}