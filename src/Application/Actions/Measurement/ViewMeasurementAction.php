<?php


namespace App\Application\Actions\Measurement;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class ViewMeasurementAction extends MeasurementAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_cycle = $this->getUrlParam('id_cycle');
        $cycle = $this->measurementRepository->findById($id_cycle);
        return $this->respondWithData($cycle);
    }
}