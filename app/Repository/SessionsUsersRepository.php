<?php
namespace Nurdin\Mind\Repository;

use Nurdin\Mind\Domain\SessionsUsers;

class SessionsUsersRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insert(Sessionsusers $sessionsUsers) : Sessionsusers
    {
        $statement = $this->connection->prepare("INSERT INTO sessions_user (id, user_email) VALUES(?, ?)");
        $statement->execute([$sessionsUsers->id, $sessionsUsers->userEmail]);

        return $sessionsUsers;
    }

    public function findById(string $id) : ?Sessionsusers
    {
        $statement = $this->connection->prepare("SELECT id, user_email FROM sessions_user WHERE id = ?");
        $statement->execute([$id]);

        if($row = $statement->fetch()){
            $sessionsUsers = new SessionsUsers();
            $sessionsUsers->id = $row['id'];
            $sessionsUsers->userEmail = $row['user_email'];

            return $sessionsUsers;
        } else {
            return null;
        }
    }

    public function deleteById(string $id)
    {
        $statement = $this->connection->prepare("DELETE FROM sessions_user WHERE id = ?");
        $statement->execute([$id]);
    }
}