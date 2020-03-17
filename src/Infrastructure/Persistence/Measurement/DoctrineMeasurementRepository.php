<?php


namespace App\Infrastructure\Persistence\Measurement;


use App\Domain\Cycle\CycleNotFoundException;
use App\Domain\Measurement\Measurement;
use App\Domain\Measurement\MeasurementNotFoundException;
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
        if($cycle===null){
            throw new CycleNotFoundException();
        }
        return $cycle->getMeasurements()->getValues();
    }

    public function findById(int $id_measurement): Measurement
    {
        $measurement = $this->entityManager->find("App\Domain\Measurement\Measurement",$id_measurement);
        if($measurement===null){
            throw new MeasurementNotFoundException();
        }
        return $measurement;
    }

    public function createMeasurement(int $id_cycle, array $params): Measurement
    {
        $date = new \DateTime($params["date"]);
        $measurement = new Measurement(null,$params["temperature"],$params["humidity"],$date);
        $cycle = $this->entityManager->find("App\Domain\Cycle\Cycle",$id_cycle);
        if($cycle===null){
            throw new CycleNotFoundException();
        }
        $measurement->setCycle($cycle);
        $this->entityManager->persist($measurement);
        $this->entityManager->flush();
        return $measurement;
    }

    public function deleteMeasurement(int $id_measurement): bool
    {
        $measurement = $this->entityManager->find("App\Domain\Measurement\Measurement",$id_measurement);
        if($measurement===null){
            throw new MeasurementNotFoundException();
        }
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