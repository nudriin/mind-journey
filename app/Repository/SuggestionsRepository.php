<?php
namespace Nurdin\Mind\Repository;

use Nurdin\Mind\Domain\Suggestions;
use PDO;

class SuggestionsRepository{
    private PDO $connection;
    public function __construct(PDO $connection){
        $this->connection = $connection;
    }

    public function insert(Suggestions $suggestions) : Suggestions
    {
        $statement = $this->connection->prepare("INSERT INTO suggestions(id, email, name, message) VALUES (?, ?, ?, ?)");
        $statement->execute([$suggestions->id, $suggestions->email, $suggestions->name, $suggestions->message]);

        return $suggestions;
    }

    public function findAll() :?array
    {
        try{
            $statement = $this->connection->prepare("SELECT id, email, name, message FROM suggestions");
            $statement->execute();
            if($statement->rowCount() > 0){
                return $statement->fetchAll();
            } else {
                return null;
            } 
        } finally{
            $statement->closeCursor();
        }
    }

    public function findById(string $id) : ?Suggestions
    {
        try{
            $statement = $this->connection->prepare("SELECT id, email, name, message FROM suggestions WHERE id = ?");
            $statement->execute([$id]);
            if($row = $statement->fetch()){
                $suggestions = new Suggestions();
                $suggestions->id = $row["id"];
                $suggestions->email = $row["email"];
                $suggestions->name = $row["name"];
                $suggestions->message = $row["message"];

                return $suggestions;
            } else {
                return null;
            }
        } finally{
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id){
        $statement = $this->connection->prepare("DELETE FROM suggestions WHERE id = ?");
        $statement->execute([$id]);
    }
}