<?php


namespace App\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class DoctrineUserRepository implements UserRepository
{
    /**
     * @var doctrine
     */
    private $entityManager;
    private $logger;

    public function __construct(ContainerInterface $container,LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->entityManager = $container->get("doctrine");
    }
    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        return $this->entityManager->getRepository("App\Domain\User\User")->findAll();
    }

    /**
     * @inheritDoc
     */
    public function findUserOfId(int $id): User
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id);
        if($user===null){
            throw new UserNotFoundException();
        }
        return $user;
    }

    public function getPassword(string $username): string
    {
        $user =  $this->entityManager->getRepository("App\Domain\User\User")->findOneBy(array('username'=> $username));
        if($user===null){
            $this->logger->info("user (getPassword)". $user->getUsername() );
            throw new UserNotFoundException();
        }
        return $user->getHashPassword();
    }

    public function createUser(string $username, string $first_name, string $last_name, string $password, string $email): int
    {
        $user = new User(null,$username,$first_name,$last_name,$email);
        $user->setHashPassword($password);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return 1;
    }

    public function existUserByUsername(string $username): bool
    {
        $user =  $this->entityManager->getRepository("App\Domain\User\User")->findOneBy(array('username'=> $username));
        return $user===null;
    }

    public function findUserOfUsername(string $username): User
    {
       $user = $this->entityManager->getRepository("App\Domain\User\User")->findOneBy(array('username'=> $username));
       //$user = $this->entityManager->getRepository("App\Domain\User\User")->find(1);
       if($user->getUsername()===null){
           $this->logger->info("user (findUserOfUsername)". $user->getUsername() );
           throw new UserNotFoundException();
       }
       return $user;
    }

    public function getUserParams(): array
    {
        return [
            "username",
            "password",
            "first_name",
            "last_name",
            "email"
        ];
    }

    public function updateUser(string $id, array $params): User
    {
        $user = $this->entityManager->find("App\Domain\User\User",(int)$id);
        if($user===null){
            throw new UserNotFoundException();
        }

        if(isset($params["pass_word"])){
            $user->setHashPassword($params["pass_word"]);
        }

        if(isset($params["username"])){
            $user->setUsername($params["username"]);
        }
        if(isset($params["first_name"])){
            $user->setFirstName($params["first_name"]);
        }
        if(isset($params["last_name"])){
            $user->setLastName($params("last_name"));
        }
        if(isset($params["email"])){
            $user->setEmail($params["email"]);
        }
        $this->entityManager->flush();
        return $user;
    }

    public function deleteUser($id_user): bool
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id_user);
        if($user===null){
            throw new UserNotFoundException();
        }
        $this->entityManager->remove($user);
        $this->entityManager->flush();
        return true;
    }
}