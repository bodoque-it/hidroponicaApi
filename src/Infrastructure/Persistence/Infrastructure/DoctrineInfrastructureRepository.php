<?php


namespace App\Infrastructure\Persistence\Infrastructure;


use App\Domain\Infrastructure\Infrastructure;
use App\Domain\Infrastructure\InfrastructureNotFoundException;
use App\Domain\Infrastructure\InfrastructureRepository;
use App\Domain\User\UserNotFoundException;
use Psr\Container\ContainerInterface;

class DoctrineInfrastructureRepository implements InfrastructureRepository
{

    private $entityManager;
    /**
     * DoctrineInfrastructureRepository constructor.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->entityManager = $container->get("doctrine");
    }

    public function findAll(int $id_user): array
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id_user);
        if($user===null){
            throw new UserNotFoundException();
        }
        return $user->getInfrastructures()->getValues();
    }

    public function findById(int $id_infrastructure): Infrastructure
    {
        $infrastructure = $this->entityManager->find("App\Domain\Infrastructure\Infrastructure",$id_infrastructure);
        if($infrastructure===null){
            throw new InfrastructureNotFoundException();
        }
        return $infrastructure;
    }

    public function deleteInfrastructure(string $id_infrastructure): bool
    {
        $infrastructure = $this->entityManager->find("App\Domain\Infrastructure\Infrastructure",$id_infrastructure);
        if($infrastructure===null){
            throw new InfrastructureNotFoundException();
        }
        $this->entityManager->remove($infrastructure);
        $this->entityManager->flush();
        return true;
    }

    public function updateInfrastructure(int $in_infrastructure, array $params): Infrastructure
    {
        //pending...
    }

    public function createInfrastructure(int $id_user, array $params): Infrastructure
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id_user);
        if($user===null){
            throw new UserNotFoundException();
        }
        $infrastructure = new Infrastructure($params["address"]);
        $infrastructure->setOwner($user);
        $this->entityManager->persist($infrastructure);
        $this->entityManager->flush();
        return $infrastructure;
    }
}