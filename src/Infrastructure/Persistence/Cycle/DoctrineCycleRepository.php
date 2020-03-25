<?php


namespace App\Infrastructure\Persistence\Cycle;


use App\Domain\Container\ContainerNotFoundException;
use App\Domain\Cycle\Cycle;
use App\Domain\Cycle\CycleNotFoundException;
use App\Domain\Cycle\CycleRepository;
use App\Domain\Microclimate\MicroclimateNotFoundException;
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
        return $user->getCyclesOrdered()->getValues();
    }

    public function findById(int $id_cycle): Cycle
    {
        $cycle = $this->entityManager->find("App\Domain\Cycle\Cycle",$id_cycle);
        if($cycle===null){
            throw new CycleNotFoundException();
        }
        return $cycle;
    }

    public function createCycle(int $id_user, array $params): Cycle
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id_user);
        if($user===null){
            throw new UserNotFoundException();
        }
        $start_date = new \DateTime('NOW');
        $estimated_date = new \DateTime($params["estimated_date"]);
        $id_container =(int)$params["id_container"];
        $container = $user = $this->entityManager->find("App\Domain\Container\Container",$id_container);
        if($container===null){
            throw new ContainerNotFoundException();
        }
        $id_microclimate =(int)$params["id_microclimate"];
        $microclimate = new $this->entityManager->find("App\Domain\Microclimate\Microclimate",$id_microclimate);
        if($microclimate===null){
            throw new MicroclimateNotFoundException();
        }
        $cycle = new Cycle(null,$start_date,$estimated_date);
        $cycle->setContainer($container);
        $cycle->setMicroclimate($microclimate);
        $container->setActive(true);
        $cycle->setOwner($user);
        $this->entityManager->persist($cycle);
        $this->entityManager->flush();
        return $cycle;
    }

    public function deleteCycle(int $id): bool
    {
        $cycle = $this->entityManager->find("App\Domain\Cycle\Cycle",$id);
        if($cycle===null){
            throw new CycleNotFoundException();
        }
        $this->entityManager->remove($cycle);
        $this->entityManager->flush();
        return true;
    }

    public function updateCycle(int $id, array $params): Cycle
    {
        $cycle = $this->entityManager->find("App\Domain\Cycle\Cycle",$id);
        if($cycle===null){
            throw new CycleNotFoundException();
        }
        if(isset($params["estimated_date"])){
            $estimated_date = new \DateTime($params["estimated_date"]);
            $cycle->setEstimatedDate($estimated_date);
        }
        if(isset($params["id_container"])){
            $container_id =(int) $params["id_container"];
            $container = $this->entityManager->find("App\Domain\Container\Container",$container_id);
            if($container===null){
                throw new ContainerNotFoundException();
            }
            $cycle->setContainer($container);
        }
        if(isset($params["id_microclimate"])){
            $microclimate_id =(int) $params["id_microclimate"];
            $microclimate = $this->entityManager->find("App\Domain\Microclimate\Microclimate",$microclimate_id);
            if($microclimate===null){
                throw new MicroclimateNotFoundException();
            }
            $cycle->setMicroclimate($microclimate);
        }
        if(isset($params["isFinish"]) and $params["isFinish"]==true){
            $nowDateTime = new DateTime('NOW');
            $cycle->setFinishDate($nowDateTime);
            $container_id =(int) $params["container_id"];
            $container = $this->entityManager->find("App\Domain\Container\Container",$container_id);
            if($container===null){
                throw new ContainerNotFoundException();
            }
            if(!$container->isActive()){
                throw new \Exception("What brother??");
            }
            $container->setActive(false);
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
        if($user===null){
            throw new UserNotFoundException();
        }
        $container = $this->entityManager->find("App\Domain\Container\Container",$id_container);
        if($container===null){
            throw new ContainerNotFoundException();
        }
        $microclimate = $this->entityManager->find("App\Domain\Microclimate\Microclimate",$id_microclimate);
        if($microclimate===null){
            throw new MicroclimateNotFoundException();
        }
        $start_date = new \DateTime('NOW');
        $estimated_date = new \DateTime($params["estimated_date"]);
        $cycle = new Cycle(null,$start_date,$estimated_date);
        $cycle->setOwner($user);
        $cycle->setContainer($container);
        $cycle->setMicroclimate($microclimate);
        $this->entityManager->persist($cycle);
        $this->entityManager->flush();
        return $cycle;
    }
}