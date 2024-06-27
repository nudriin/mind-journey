<?php
namespace Nurdin\Mind\Repository;

use Nurdin\Mind\Domain\User;

class UserRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection) {
        $this->connection = $connection;
    }

    public function insert(User $user) : User
    {
        $statement = $this->connection->prepare("INSERT INTO user(email, name, password) VALUES(?,?,?)");
        $statement->execute([$user->email, $user->name, $user->password]);

        return $user;
    }

    public function findById(string $email) : ?User
    {
        $statement = $this->connection->prepare("SELECT email, name, password, picture FROM user WHERE email = ?");
        $statement->execute([$email]);
        try{
            if($row = $statement->fetch()){
                $user = new User();
                $user->email = $row['email'];
                $user->name = $row['name'];
                $user->password = $row['password'];
                $user->picture = $row['picture'];
    
                return $user;
            } else {
                return null;
            }
        } finally{
            $statement->closeCursor();
        }
    }

    public function findAll() : ?array
    {
        $statement = $this->connection->prepare("SELECT email, name, password, picture FROM user");
        $statement->execute();
        try{
            if($statement->rowCount() > 0){
                return $statement->fetchAll();
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $email)
    {
        $statement = $this->connection->prepare("DELETE FROM user WHERE email = ?");
        $statement->execute([$email]);
    }

    public function update(User $user)
    {
        $statement = $this->connection->prepare("UPDATE user SET name = ?, password = ?, picture = ? WHERE email = ?");
        $statement->execute([$user->name, $user->password,$user->picture, $user->email]);

        return $user;
    }
}