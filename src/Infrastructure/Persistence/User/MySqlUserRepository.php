<?php

namespace App\Infrastructure\Persistence\User;


use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use PDO;
use phpDocumentor\Reflection\Types\Boolean;
use function DI\get;

class MySqlUserRepository implements UserRepository
{
    private $user;
    private $password;
    private $host;
    private  $dbname;
    private $conn;
    public function __construct()
    {
        $sl = "mysql:host=".getenv('DB_HOST').";dbname=".getenv('DB_DATABASE');
        $this->conn = new PDO($sl,getenv('DB_USERNAME'),getenv('DB_PASSWORD'));
    }

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        $query = "SELECT * FROM pet";
        $res = array();
        foreach ($this->conn->query($query) as $row){
            array_push($res,$row['name']);
        }
        return $res;
    }

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserOfId(int $id): User
    {
        // TODO: Implement findUserOfId() method.
    }

    public function getPassword(int $id): string
    {
        // TODO: Implement getPassword() method.
    }
}