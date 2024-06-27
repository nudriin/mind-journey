<?php
namespace Nurdin\Mind\Repository;

use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Domain\Article;
use PDO;

class ArticleRepository{
    private PDO $connection;
    public function __construct(PDO $connection){
        $this->connection = $connection;
    }

    public function insert(Article $article) : Article{
        $statement = $this->connection->prepare("INSERT INTO article (id, admin_email, title, paragraph, category, images, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $statement->execute([$article->id, $article->admin_email, $article->title, $article->paragraph, $article->category, $article->images, $article->status]);

        return $article;
    }

    public function findById(string $id) : ?Article
    {
        $statement = $this->connection->prepare("SELECT a.id, a.admin_email, a.title, a.paragraph, a.category, a.date, a.images, a.status, ad.name as name FROM article AS a JOIN admin AS ad ON (ad.email = a.admin_email) WHERE a.id = ?");
        $statement->execute([$id]);
        try{
            if($row = $statement->fetch()){
                $article = new Article();
                $article->id = $row['id'];
                $article->admin_email = $row['admin_email'];
                $article->title = $row['title'];
                $article->paragraph = $row['paragraph'];
                $article->category = $row['category'];
                $article->date = $row['date'];
                $article->images = $row['images'];
                $article->status = $row['status'];
                $article->author = $row['name'];
    
                return $article;
            } else {
                return null;
            }
        } finally{
            $statement->closeCursor();
        }
        
    }

    public function deleteById(string $id){
        $statement = $this->connection->prepare("DELETE FROM article WHERE id = ?");
        $statement->execute([$id]);
    }

    public function update(Article $article) : Article
    {
        $sql = <<< SQL
            UPDATE article
            SET title = ?,
                paragraph = ?,
                category = ?,
                date = ?,
                images = ?,
                status = ?
            WHERE id = ?
        SQL;
        $statement = $this->connection->prepare($sql);
        $statement->execute([$article->title, $article->paragraph, $article->category, $article->date, $article->images, $article->status, $article->id]);

        return $article;
    }

    public function findByCategory(string $category, string $status) : ?array
    {
        $statement = $this->connection->prepare("SELECT id, admin_email, title, paragraph, category, MAX(date) as date, images, status FROM article GROUP BY id HAVING category = ? AND status = ? ORDER BY date DESC");
        $statement->execute([$category, $status]);
        try{
            if($statement->rowCount() > 0){
                return $statement->fetchAll();
            } else{
                return null;
            }
        } finally{
            $statement->closeCursor();
        }
        
    }

    public function findAll() : ?array
    {
        $statement = $this->connection->prepare("SELECT id, admin_email, title, paragraph, category, MAX(date) as date, images, status FROM article GROUP BY id ORDER BY date DESC");
        $statement->execute();
        try{
            if($statement->rowCount() > 0){
                return $statement->fetchAll();
            } else {
                return null;
            }
        } finally{
            $statement->closeCursor();
        }
    }

    public function findByStatus(string $status) : ?array
    {
        $statement = $this->connection->prepare("SELECT id, admin_email, title, paragraph, category, MAX(date) as date, images, status FROM article GROUP BY id HAVING status = ? ORDER BY date DESC");
        $statement->execute([$status]);
        if($statement->rowCount() > 0){
            return $statement->fetchAll();
        } else {
            return null;
        }
    }

}

// $articleRepo = new ArticleRepository(DatabaseConfig::getConnect());
// $article = $articleRepo->findById("12");

// var_dump($article);