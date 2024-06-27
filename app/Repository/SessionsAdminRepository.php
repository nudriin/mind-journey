<?php
namespace Nurdin\Mind\Repository;

use Nurdin\Mind\Domain\SessionsAdmin;

class SessionsAdminRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insertSessions(SessionsAdmin $sessionsAdmin) : SessionsAdmin
    {
        $statement = $this->connection->prepare("INSERT INTO sessions_admin (id, admin_email) VALUES(?,?)");
        $statement->execute([$sessionsAdmin->id, $sessionsAdmin->admin_email]);

        return $sessionsAdmin;
    }

    public function findById(string $id) : ?SessionsAdmin
    {
        $statement = $this->connection->prepare("SELECT id, admin_email FROM sessions_admin WHERE id = ?");
        $statement->execute([$id]);

        try {
            if($row = $statement->fetch()){
                $session = new SessionsAdmin();
                $session->id = $row['id'];
                $session->admin_email = $row['admin_email'];
                return $session;
            } else{
                return null;
            }
        } finally{
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id) : void
    {
        $statement = $this->connection->prepare("DELETE FROM sessions_admin WHERE id = ?");
        $statement->execute([$id]);
    }
}