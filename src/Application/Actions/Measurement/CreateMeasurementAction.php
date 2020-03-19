<?php


namespace App\Application\Actions\Measurement;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class CreateMeasurementAction extends MeasurementAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_cycle = $this->getUrlParam('id_cycle');
        $params = $this->getFormData();
        $measurement = $this->measurementRepository->createMeasurement($id_cycle,$params);
        $this->logger->info($measurement->getId());
        return $this->respondWithData($measurement);
    }
}