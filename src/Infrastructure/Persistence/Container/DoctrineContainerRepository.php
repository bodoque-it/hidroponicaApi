<?php


namespace App\Infrastructure\Persistence\Container;


use App\Domain\Container\Container;
use App\Domain\Container\ContainerNotFoundException;
use App\Domain\Container\ContainerRepository;
use App\Domain\Rail\RailNotFoundException;
use App\Domain\User\UserNotFoundException;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class DoctrineContainerRepository implements ContainerRepository
{

    /**
     * DoctrineContainerRepository constructor.
     */
    private $logger;
    private $entityManager;
    public function __construct(ContainerInterface $container,LoggerInterface $logger)
    {
        $this->entityManager = $container->get("doctrine");
        $this->logger = $logger;
    }

    public function findAll(int $user_id): array
    {
        $user = $this->entityManager->find("App\Domain\User\User",$user_id);
        if($user===null){
            throw new UserNotFoundException();
        }
        $this->logger->info("antes de pedir el valor");
        return $user->getContainers()->getValues();
    }

    public function findById(int $id_user, int $id): Container
    {
        $container =  $this->entityManager->find("App\Domain\Container\Container",$id);
        if($container===null){
            throw new ContainerNotFoundException();
        }
        return $container;
    }

    public function createContainer(int $id, array $params): Container
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id);
        if($user===null){
            throw new UserNotFoundException();
        }
        $container = new Container(null,$params["volume"],$params["name"]);
        $container->setOwner($user);
        $this->entityManager->persist($container);
        $this->entityManager->flush();
        return $container;
    }

    public function deleteContainer(int $id): bool
    {
        $container = $this->entityManager->find("App\Domain\Container\Container",$id);
        if($container===null){
            throw new ContainerNotFoundException();
        }
        $this->entityManager->remove($container);
        $this->entityManager->flush();
        return true;
    }

    public function updateContainer(int $id, array $params): Container
    {
        $container = $this->entityManager->find("App\Domain\Container\Container",$id);
        if($container===null){
            throw new ContainerNotFoundException();
        }
        if(isset($params["name"])){
            $container->setName($params["name"]);
        }
        if(isset($params["volume"])){
            $container->setVolume((float)$params["volume"]);
        }
        if(isset($params["active"])){
            $container->setActive($params["active"]);
        }
        $this->entityManager->flush();
        return $container;
    }

    public function getParams(): array
    {
        return [
            "volume",
            "name",
            "active"
        ];
    }

    public function getUpdateParams(): array
    {
        return [
            "volume",
            "name",
            "active"
        ];
    }

    public function createContainerInRail(int $id_user, int $id_rail, array $params):Container
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id_user);
        if($user===null){
            throw new UserNotFoundException();
        }
        $rail = $this->entityManager->find("App\Domain\Rail\Rail",$id_rail);
        if($rail===null){
            throw new RailNotFoundException();
        }
        $container = new Container(null,$params["volume"],$params["name"]);
        $container->setOwner($user);
        $container->setRail($rail);
        $this->entityManager->persist($container);
        $this->entityManager->flush();
        return $container;
    }
}