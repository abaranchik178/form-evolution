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
    private $passwordHash;
    private $secretString;
    private $settings;

    public function __construct($props)
    {
        if ( isset($props['id']) ) {
            $this->setId($props['id']);
        }
        if ( isset($props['firstName']) ) {
            $this->setFirstName($props['firstName']);
        }
        if ( isset($props['lastName']) ) {
            $this->setLastName($props['lastName']);
        }
        if ( isset($props['email']) ) {
            $this->setEmail($props['email']);
        }
        if ( isset($props['birthDate']) ) {
            $this->setBirthDate($props['birthDate']);
        }
        if ( isset($props['gender']) ) {
            $this->setGender($props['gender']);
        }
        if ( isset($props['password1']) ) {
            $this->setPasswordHash($props['password1']);
        }
        if ( isset($props['settings']) ) {
            $this->setSettings($props['settings']);
        }

        $this->setSecretString();
    }

    public function verifyPassword(string $password)
    {

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
        $this->id = (int)$id;
    }

    /**
     * @param mixed $email
     */
    public function setEmail(string $email)
    {
        $this->email = $this->sanitizeText($email);
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $this->sanitizeText($firstName);
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $this->sanitizeText($lastName);
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate(string $birthDate)
    {
        $this->birthDate = $this->sanitizeText($birthDate);
    }

    /**
     * @param mixed $gender
     */
    public function setGender(string $gender)
    {
        $this->gender = $this->sanitizeText($gender);
    }

    /**
     * @param mixed $passwordHash
     */
    public function setPasswordHash(string $password)
    {
        $this->passwordHash = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @param mixed $secretString
     */
    public function setSecretString()
    {
        $this->secretString = 'dfgdg';
    }


    private function sanitizeText(string $text)
    {
        return htmlspecialchars( trim($text) );
    }
}