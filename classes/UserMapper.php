<?php


namespace classes;

class UserMapper
{
    private $pdo;
    private $ormDifferentFields = [
        'first_name' => 'firstName',
        'last_name' => 'lastName',
        'password_hash' => 'passwordHash',
        'secret_string' => 'secretString',
    ];

    public function __construct()
    {
        $this->pdo = PDOConnection::getPDO();
    }

    public function addUser(User $user)
    {
        $query = <<<SQL
            INSERT INTO users
                (email, first_name, last_name, gender, password_hash, secret_string)
            VALUES
                (:email, :firstName, :lastName, :gender, :passwordHash, :secretString)
SQL;
        $sth = $this->pdo->prepare($query);
        $result = $sth->execute([
            ':email' => $user->getEmail(),
            ':firstName' => $user->getFirstName(),
            ':lastName' => $user->getLastName(),
            ':gender' => $user->getGender(),
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
        $fetchResult = $sth->fetch();
        if ( false === $fetchResult || null === $fetchResult) {
            return null;
        }
        return $this->getUserFromState( $fetchResult );
    }

    public function findUserBySecretString(string $secretString)
    {
        $query = <<<SQL
            SELECT * FROM users WHERE secret_string=:secretString
SQL;
        $sth = $this->pdo->prepare($query);
        $result = $sth->execute([
            ':secret_string' => $secretString,
        ]);

        if (!$result) {
            return null;
        }
        $fetchResult = $sth->fetch();
        if ( false === $fetchResult || null === $fetchResult) {
            return null;
        }
        return $this->getUserFromState( $fetchResult );
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
        if ( !$result ) {
            return null;
        }
        $fetchResult = $sth->fetch();
        if ( false === $fetchResult || null === $fetchResult) {
            return null;
        }
        return $this->getUserFromState( $fetchResult );
    }

    public function getUserFromState($state)
    {
        foreach ($this->ormDifferentFields as $dbFieldName => $objectFieldName) {
            if ( isset($state[$dbFieldName]) ) {
                $state[$objectFieldName] = $state[$dbFieldName];
                unset( $state[$dbFieldName] );
            }
        }
        return new User($state);
    }
}