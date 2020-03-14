<?php


namespace App\Infrastructure\Persistence\Microclimate;


use App\Domain\Microclimate\Microclimate;
use App\Domain\Microclimate\MicroclimateRepository;
use Psr\Container\ContainerInterface;

class MicroclimateDoctrineRepository implements MicroclimateRepository
{


    /**
     * MicroclimateDoctrineRepository constructor.
     */
    private $entityManager;
    public function __construct(ContainerInterface $container)
    {
        $this->entityManager = $container->get("doctrine");
    }

    public function findAll(int $id_user): array
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id_user);
        return $user->getMicroclimates()->getValues();
    }

    public function findById(int $id_microclimate): Microclimate
    {
        return $this->entityManager->find("App\Domain\Microclimate\Microclimate",$id_microclimate);
    }

    public function createMicroclimate(int $id_user, array $params): Microclimate
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id_user);
        $microclimate = new Microclimate(null,
            $params["name"],
            $params["intensity"],
            $params["waterPH"],
            $params["dailyHours"],
            $params["lightStartTime"]
        );
        $microclimate->setOwner($user);
        $this->entityManager->persist($microclimate);
        $this->entityManager->flush();
        return $microclimate;
    }

    public function deleteMicroclimate(int $id_microclimate): bool
    {
        $microclimate = $this->entityManager->find("App\Domain\Microclimate\Microclimate",$id_microclimate);
        $this->entityManager->delete($microclimate);
        $this->entityManager->flush();
        return true;
    }

    public function getParams(): array
    {
        return [
            'name',
            'intensity',
            'waterPH',
            'dailyHours',
            'lightStartTime'
        ];
    }
}