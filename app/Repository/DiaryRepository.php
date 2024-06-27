<?php
namespace Nurdin\Mind\Repository;

use Nurdin\Mind\Domain\Diary;

class DiaryRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insert(Diary $diary) : Diary
    {
        $statement = $this->connection->prepare("INSERT INTO diary (id, user_email, title, paragraph, mood) VALUES(? , ?, ?, ?, ?)");
        $statement->execute([$diary->id, $diary->user_email, $diary->title, $diary->paragraph, $diary->mood]);

        return $diary;
    }

    public function update(Diary $diary) : Diary
    {
        $statement = $this->connection->prepare("UPDATE diary SET title = ?, paragraph = ?, mood = ? WHERE id = ? AND user_email = ?");
        $statement->execute([$diary->title, $diary->paragraph, $diary->mood, $diary->id, $diary->user_email]);

        return $diary;
    }

    public function findById(string $id, string $user_email) : ?Diary
    {
        $statement = $this->connection->prepare("SELECT id, user_email, title, paragraph, mood, date FROM diary WHERE id = ? AND user_email = ?");
        $statement->execute([$id, $user_email]);
        if($row = $statement->fetch()){
            $diary = new Diary();
            $diary->id = $row['id'];
            $diary->user_email = $row['user_email'];
            $diary->title = $row['title'];
            $diary->paragraph = $row['paragraph'];
            $diary->mood = $row['mood'];
            $diary->date = $row['date'];

            return $diary;
        } else{
            return null;
        }
    }

    public function findAll(string $user_email) : ?array
    {
        $statement = $this->connection->prepare("SELECT id, user_email, title, paragraph, mood, date FROM diary WHERE user_email = ? ORDER BY date DESC");
        $statement->execute([$user_email]);
        if($statement->rowCount() > 0){
            return $statement->fetchAll();
        } else {
            return null;
        }
    }

    public function delete(string $id,  string $user_email)
    {
        $statement = $this->connection->prepare("DELETE FROM diary WHERE id = ? AND user_email = ?");
        $statement->execute([$id, $user_email]);
    }
}