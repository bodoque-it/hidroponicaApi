<?php

namespace App\Infrastructure\Persistence\User;


use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use PDO;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
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
        $query = "SELECT * FROM users";
        $res = array();
        foreach ($this->db->query($query) as $row){
            array_push($res,$row['username']);
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
        $query = "SELECT * FROM users WHERE id_user = ?";
        $sth = $this->db->prepare($query);
        $sth->bindParam(1,$id);
        $sth->execute();
        $row = $sth->fetch();
        return  new User($id,$row["username"],$row["first_name"],$row["last_name"],$row["email"]);

    }

    public function getPassword(string $id): string
    {
        $query = "SELECT pass_word FROM  users WHERE id_user= ?";
        $sth = $this->db->prepare($query);
        $sth->bindParam(1,$id);
        $sth->execute();
        $row = $sth->fetch();
        return $row["pass_word"];
    }
    public function createUser(string $username, string $first_name, string $last_name, string $password, string $email): int
    {
        $response =-1;
        if(!$this->existUserByUsername($username)){
            $query = "INSERT INTO users(username,first_name,last_name,pass_word,email) VALUES (?,?,?,?,?)";
            $sth = $this->db->prepare($query);
            $sth->execute([$username,$first_name,$last_name,$password,$email]);
            $response = $this->findUserOfUsername($username);
        }
        return $response;



    }
    public function existUserByUsername(string $username):bool{
        $query = "SELECT * FROM users WHERE username = ?";
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
        $query = "SELECT * FROM users WHERE username = ?";
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

    public function getUserParams(): array
    {
        $sql = "SHOW columns FROM users";
        try {
            $res = array();
            foreach ($this->db->query($sql) as $row) {
                array_push($res, $row["Field"]);
            }
            unset($res[0]);
            error_log(print_r($res, true));
            return $res;
        }catch (\PDOException $e){
            return array("Error"=>"Datos no disponible");
        }
    }

    public function updateUser(string $id,array $params): bool
    {
        if(isset($params["pass_word"])){;
            $sql = "UPDATE users SET pass_word=:pass_word WHERE id_user=:id_user";
            $result = $this->db->prepare($sql);
            $result->bindParam( ":pass_word", $params["pass_word"] );
            $result->bindParam( ":id_user", $id);
            $result->execute();
        }
        if(isset($params["username"])){
            $sql = "UPDATE users SET username=:username WHERE id_user=:id_user";
            $result = $this->db->prepare($sql);
            $result->bindParam( ":username", $params["username"]);
            $result->bindParam( ":id_user", $id);
            $result->execute();
        }
        if(isset($params["first_name"])){
            $sql = "UPDATE users SET first_name=:first_name WHERE id_user=:id_user";
            $result = $this->db->prepare($sql);
            $result->bindParam( ":first_name", $params["first_name"], PDO::PARAM_STR );
            $result->bindParam( ":id_user", $id);
            $result->execute();
        }
        if(isset($params["last_name"])){
            $sql = "UPDATE users SET last_name=:last_name WHERE id_user=:id_user";
            $result = $this->db->prepare($sql);
            $result->bindParam( ":last_name", $params["last_name"], PDO::PARAM_STR );
            $result->bindParam( ":id_user", $id);
            $result->execute();
        }
        if(isset($params["email"])){
            $sql = "UPDATE users SET email=:email WHERE id_user=:id_user";
            $result = $this->db->prepare($sql);
            $result->bindParam( ":email", $params["email"], PDO::PARAM_STR );
            $result->bindParam( ":id_user", $id);
            $result->execute();

        }
        return true;

    }

    public function deleteUser($id_user): bool
    {
        $sql = "DELETE FROM users WHERE id_user=:id_user";
        $result = $this->db->prepare($sql);
        $result->bindParam(":id_user",$id_user);
        $result->execute();
        return true;
    }
}
