<?php
namespace Nurdin\Mind\Repository;

use Nurdin\Mind\Domain\Admin;

class AdminRepository{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insert(Admin $admin) : Admin
    {
        
        $statement = $this->connection->prepare("INSERT INTO admin(email, name, password) VALUES(?,?,?)");
        $statement->execute([$admin->email, $admin->name, $admin->password]);
    
        return $admin;
    }

    public function update(Admin $admin) : Admin
    {
        $statement = $this->connection->prepare("UPDATE admin SET name = ?, password = ? WHERE email = ?");
        $statement->execute([$admin->name, $admin->password, $admin->email]);

        return $admin;
    }

    public function findAll() : ?array
    {
        $statement = $this->connection->prepare("SELECT email, name, password FROM admin");
        $statement->execute();
        try {
            if($statement->rowCount() > 0){
                return $statement->fetchAll();
            } else{
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findById(string $email) : ?Admin
    {
        $statement = $this->connection->prepare("SELECT email, name, password FROM admin WHERE email = ?");
        $statement->execute([$email]);
        try {
            if($row = $statement->fetch()){
                $admin = new Admin();
                $admin->email = $row['email'];
                $admin->name = $row['name'];
                $admin->password = $row['password'];
    
                return $admin;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }

    }
}
