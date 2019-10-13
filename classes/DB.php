<?php


namespace classes;

use \PDO;

class DB
{
    private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    private $pdo;
    public function __construct()
    {
        $this->pdo = new PDO($_ENV['MYSQL_DSN'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $this->options);
    }

    public function addUser(User $user)
    {
        $query = <<<SQL
            INSERT INTO users
                (email, first_name, last_name, gender, birth_date, password_hash, secret_string)
            VALUES
                (:email, :firstName, :lastName, :gender, :birthDate, :passwordHash, :secretString)
SQL;
        $sth = $this->pdo->prepare($query);
        $result = $sth->execute([
            ':email' => $user->getEmail(),
            ':firstName' => $user->getFirstName(),
            ':lastName' => $user->getLastName(),
            ':gender' => $user->getGender(),
            ':birthDate' => $user->getBirthDate(),
            ':passwordHash' => $user->getPasswordHash(),
            ':secretString' => $user->getSecretString(),
        ]);
        if ($result) {
            return $this->pdo->lastInsertId();
        }
    }

    public function findUserById(int $id)
    {
        $query = <<<SQL
            SELECT * FROM users WHERE id=:id
SQL;
        $sth = $this->pdo->prepare($query);
        $result = $sth->execute([
            ':id' => $id,
        ]);

        if (!$result) {
            return null;
        }
        return $sth->fetch();
    }

    public function findUserByEmail(string $email)
    {
        $query = <<<SQL
            SELECT * FROM users WHERE email=:email
SQL;
        $sth = $this->pdo->prepare($query);
        $result = $sth->execute([
            ':email' => $email,
        ]);
        if (!$result) {
            return null;
        }
        return $sth->fetch();
    }
}