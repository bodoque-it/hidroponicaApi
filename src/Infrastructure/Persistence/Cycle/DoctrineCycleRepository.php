<?php


namespace App\Infrastructure\Persistence\Cycle;


use App\Domain\Cycle\Cycle;
use App\Domain\Cycle\CycleRepository;
use App\Domain\User\UserNotFoundException;
use Cassandra\Date;
use Psr\Container\ContainerInterface;

class DoctrineCycleRepository implements CycleRepository
{

    /**
     * DoctrineCycleRepository constructor.
     */
    private $entityManager;
    public function __construct(ContainerInterface $container)
    {
        $this->entityManager = $container->get("doctrine");
    }

    public function findAll(int $id_user): array
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id_user);
        if($user=== null){
            throw  new UserNotFoundException();
        }
        return $user->getCycles()->getValues();
    }

    public function findById(int $id_cycle): Cycle
    {
        return $this->entityManager->find("App\Domain\Cycle\Cycle",$id_cycle);
    }

    public function createCycle(int $id_user, array $params): Cycle
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id_user);
        $start_date = new \DateTime($params["start_date"]);
        $estimated_date = new \DateTime($params["estimated_date"]);
        $finish_date = new \DateTime($params["finish_date"]);
        $cycle = new Cycle(null,$start_date,$estimated_date,$finish_date);
        $cycle->setOwner($user);
        $this->entityManager->persist($cycle);
        $this->entityManager->flush();
        return $cycle;
    }

    public function deleteCycle(int $id): bool
    {
        $cycle = $this->entityManager->find("App\Domain\Cycle\Cycle",$id);
        $this->entityManager->remove($cycle);
        $this->entityManager->flush();
        return true;
    }

    public function updateCycle(int $id, array $params): Cycle
    {
        $cycle = $this->entityManager->find("App\Domain\Cycle\Cycle",$id);
        if(isset($params["estimated_date"])){
            $estimated_date = new \DateTime($params["estimated_date"]);
            $cycle->setEstimatedDate($estimated_date);
        }
        if(isset($params["container_id"])){
            $container_id =(int) $params["container_id"];
            $container = $this->entityManager->find("App\Domain\Container\Container",$container_id);
            $cycle->setContainer($container);
        }
        if(isset($params["microclimate_id"])){
            $microclimate_id =(int) $params["microclimate_id"];
            $microclimate = $this->entityManager->find("App\Domain\Microclimate\Microclimate",$microclimate_id);
            $cycle->setMicroclimate($microclimate);
        }
        $this->entityManager->flush();
        return $cycle;
    }

    public function getParams(): array
    {
        return [
            'estimated_date',
        ];
    }

    public function createCycleContainerMicroclimate(int $id_user, int $id_container, int $id_microclimate, array $params): Cycle
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id_user);
        $container = $this->entityManager->find("App\Domain\Container\Container",$id_container);
        $microclimate = $this->entityManager->find("App\Domain\Microclimate\Microclimate",$id_microclimate);
        $start_date = new \DateTime($params["start_date"]);
        $estimated_date = new \DateTime($params["estimated_date"]);
        $finish_date = new \DateTime($params["finish_date"]);
        $cycle = new Cycle(null,$start_date,$estimated_date,$finish_date);
        $cycle->setOwner($user);
        $cycle->setContainer($container);
        $cycle->setMicroclimate($microclimate);
        $this->entityManager->persist($cycle);
        $this->entityManager->flush();
        return $cycle;
    }
}