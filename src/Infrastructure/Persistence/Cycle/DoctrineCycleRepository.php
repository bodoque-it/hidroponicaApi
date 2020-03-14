<?php


namespace App\Infrastructure\Persistence\Cycle;


use App\Domain\Cycle\Cycle;
use App\Domain\Cycle\CycleRepository;
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
        return $user->getCycles();
    }

    public function findById(int $id_cycle): Cycle
    {
        return $this->entityManager->find("App\Domain\Cycle\Cycle",$id_cycle);
    }

    public function createCycle(int $id_user, array $params): Cycle
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id_user);
        $cycle = new Cycle(null,params["start_date"],$params["estimated_date"],$params["finish_date"]);
        $cycle->setOwner($user);
        $this->entityManager->persist($cycle);
        $this->flush();
        return $cycle;
    }

    public function deleteCycle(int $id): bool
    {
        $cycle = $this->entityManager->find("App\Domain\Cycle\Cycle",$id);
        $this->entityManager->remove($cycle);
        $this->entityManager->flush();
    }

    public function updateCycle(int $id, array $params): Cycle
    {
        $cycle = $this->entityManager->find("App\Domain\Cycle\Cycle",$id);
        if(isset($params["estimated_date"])){
            $cycle->setEstimatedDate($params["estimated_date"]);
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
        $cycle = new Cycle(null,params["start_date"],$params["estimated_date"],$params["finish_date"]);
        $cycle->setOwner($user);
        $cycle->setContainer($container);
        $cycle->setMicroclimate($microclimate);
        $this->entityManager->persist($cycle);
        $this->entityManager->flush();
        return $cycle;
    }
}