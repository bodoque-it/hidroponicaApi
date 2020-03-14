<?php


namespace App\Infrastructure\Persistence\Measurement;


use App\Domain\Measurement\Measurement;
use App\Domain\Measurement\MeasurementRepository;
use Psr\Container\ContainerInterface;

class DoctrineMeasurementRepository implements MeasurementRepository
{


    /**
     * DoctrineMeasurementRepository constructor.
     */
    private $entityManager;
    public function __construct(ContainerInterface $container)
    {
        $this->entityManager = $container->get("doctrine");
    }

    public function findAll(int $id_cycle): array
    {
        $cycle = $this->entityManager->find("App\Domain\Cycle\Cycle",$id_cycle);
        return $cycle->getMeasurements()->getValues();
    }

    public function findById(int $id_measurement): Measurement
    {
        return $this->entityManager->find("App\Domain\Measurement\Measurement",$id_measurement);
    }

    public function createMeasurement(int $id_cycle, array $params): Measurement
    {
        $measurement = new Measurement(null,$params["temperature"],$params["humidity"],$params["date"]);
        $cycle = $this->entityManager->find("App\Domain\Cycle\Cycle",$id_cycle);
        $measurement->setCycle($cycle);
        $this->entityManager->persist($measurement);
        $this->entityManager->flush();
        return $measurement;
    }

    public function deleteMeasurement(int $id_measurement): bool
    {
        $measurement = $this->entityManager->find("App\Domain\Measurement\Measurement",$id_measurement);
        $this->entityManager->remove($measurement);
        $this->entityManager->flush();
        return true;
    }

    public function getParams(): array
    {
        return [
          'humidity',
          'temperature',
          'date'
        ];
    }
}