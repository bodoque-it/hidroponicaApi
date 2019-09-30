<?php

namespace App\Infrastructure\Persistence\User;


use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use Psr\Container\ContainerInterface;
use function DI\get;

class MySqlUserRepository implements UserRepository
{

    private $db;
    public function __construct(ContainerInterface $container)
    {
        $this->db = $container->get("db");

    }

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        $query = "SELECT * FROM Usuario";
        $res = array();
        foreach ($this->db->query($query) as $row){
            array_push($res,$row['Username']);
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
        $query = "SELECT * FROM Usuario WHERE id_user = ?";
        $sth = $this->db->prepare($query);
        $sth->bindParam(1,$id);
        $sth->execute();
        $row = $sth->fetch();
        return  new User($id,$row["Username"],$row["first_name"],$row["last_name"],$row["Email"]);

    }

    public function getPassword(string $id): string
    {
        $query = "SELECT Contraseña FROM  Usuario WHERE id_user= ?";
        $sth = $this->db->prepare($query);
        $sth->bindParam(1,$id);
        $sth->execute();
        $row = $sth->fetch();
        return $row["Contraseña"];
    }
    public function createUser(string $username, string $first_name, string $last_name, string $password, string $email): int
    {
        $response =-1;
        if(!$this->existUserByUsername($username)){
            $query = "INSERT INTO Usuario(Username,first_name,last_name,Contraseña,Email) VALUES (?,?,?,?,?)";
            $sth = $this->db->prepare($query);
            $sth->execute([$username,$first_name,$last_name,$password,$email]);
            $response = $this->findUserOfUsername($username);
        }
        return $response;



    }
    public function existUserByUsername(string $username):bool{
        $query = "SELECT * FROM Usuario WHERE Username = ?";
        $sth = $this->db->prepare($query);
        $sth->bindParam(1,$username);
        $sth->execute();
        $result = $sth->fetch();
        if(isset($result["Username"])){
            return true;
        }
        return false;
    }
    public function findUserOfUsername(string $username): int
    {
        $query = "SELECT * FROM Usuario WHERE Username = ?";
        $sth = $this->db->prepare($query);
        $sth->bindParam(1,$username);
        $sth->execute();
        $row = $sth->fetch();
        if(isset($row)){
            return  $row["id_user"];
        }else{
            return -1;
        }

    }
}