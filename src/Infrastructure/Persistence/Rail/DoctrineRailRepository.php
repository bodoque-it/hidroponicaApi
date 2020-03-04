<?php


namespace App\Infrastructure\Persistence\Rail;


use App\Domain\Rail\Rail;
use App\Domain\Rail\RailRepository;
use App\Domain\User\UserNotFoundException;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class DoctrineRailRepository implements RailRepository
{

    /**
     * DoctrineRailRepository constructor.
     */
    private $entityManager;
    private $logger;
    public function __construct(ContainerInterface $container,LoggerInterface $logger)
    {
        $this->entityManager = $container->get("doctrine");
        $this->logger = $logger;
    }

    public function getAllContainer($id): array
    {
        $res = array();
        $user = $this->entityManager->find("App\Domain\User\User",$id);
        $rails = $user->getRails()->getValues();
        foreach ($rails as $rail){
            array_push($res,$rails->getContainers()->getValues());
        }
        return $res;
    }

    public function getAllRails($id): array
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id);
        if($user=== null){
            throw  new UserNotFoundException();
        }
        return $user->getRails()->getValues();
    }

    public function getColumns(): array
    {
        return [
            'name',
            'location'
        ];
    }

    public function createRail(?string $id, array $params): Rail
    {
        $user = $this->entityManager->find("App\Domain\User\User",(int)$id);
        $rail = new Rail(null,$params["name"],$params["location"]);
        $rail->setOwner($user);
        $this->entityManager->persist($rail);
        $this->entityManager->flush();
        return $rail;
    }

    public function getRailById(?string $id_user, ?string $id_rail): Rail
    {
        return $this->entityManager->find("App\Domain\Rail\Rail",(int)$id_rail);
        //return $rail->getContainers()->getValues();
        //$rail->setContainers($rail->getContainers()->getValues());
        //return $rail;

    }

    public function updateRail(?string $id_user, ?string $id_rail, array $params): Rail
    {
        $rail = $this->entityManager->find("App\Domain\Rail\Rail",(int)$id_rail);
        if(isset($params["name"])){
            $rail->setName($params["name"]);
        }
        if(isset($params["location"])){
            $rail->setLocation($params["location"]);
        }
        $this->entityManager->flush();
        return $rail;
    }

    public function deleteRail(?string $id_user, ?string $id_rail): bool
    {
        $rail = $this->entityManager->find("App\Domain\Rail\Rail",(int)$id_rail);
        $this->entityManager->remove($rail);
        $this->entityManager->flush();
        return true;
    }

    public function getRailParams(): array
    {
        return [
            'name',
            'location'
        ];
    }
}