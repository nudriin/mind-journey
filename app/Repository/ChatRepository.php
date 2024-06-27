<?php
namespace Nurdin\Mind\Repository;

use Nurdin\Mind\Domain\Chat;
use PDO;

class ChatRepository
{
    private PDO $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function insert(Chat $chat) : Chat
    {
        $stmt = $this->connection->prepare("INSERT INTO chat (id, admin_email, user_email, message, sender) VALUES(?, ?, ?, ?, ?)");
        $stmt->execute([$chat->id, $chat->admin_email, $chat->user_email, $chat->message, $chat->sender]);

        return $chat;
    }

    public function findByEmail(string $admin_email, string $user_email) : ?array
    {
        $stmt = $this->connection->prepare("SELECT * FROM chat WHERE admin_email = ? AND user_email = ?");
        $stmt->execute([$admin_email, $user_email]);

        if($stmt->rowCount() > 0){
            return $stmt->fetchAll();
        } else{
            return null;
        }
    }
}