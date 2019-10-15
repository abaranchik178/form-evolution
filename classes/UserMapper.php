<?php


namespace classes;

class UserMapper
{
    private $pdo;
    private $ormFields = [
        'first_name' => 'firstName',
        'last_name' => 'lastName',
        'password_hash' => 'passwordHash',
    ];

    public function __construct()
    {
        $this->pdo = PDOConnection::getPDO();
    }

    public function addUser(User $user)
    {
        $query = <<<SQL
            INSERT INTO users
                (email, first_name, last_name, gender, password_hash)
            VALUES
                (:email, :firstName, :lastName, :gender, :passwordHash)
SQL;
        $sth = $this->pdo->prepare($query);
        $result = $sth->execute([
            ':email' => $user->getEmail(),
            ':firstName' => $user->getFirstName(),
            ':lastName' => $user->getLastName(),
            ':gender' => $user->getGender(),
            ':passwordHash' => $user->getPasswordHash(),
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
        foreach ($this->ormFields as $dbFieldName => $objectFieldName) {
            if ( isset($state[$dbFieldName]) ) {
                $state[$objectFieldName] = $state[$dbFieldName];
                unset( $state[$dbFieldName] );
            }
        }
        return new User($state);
    }
}