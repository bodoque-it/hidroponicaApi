<?php


namespace App\Application\Actions\Measurement;



use Psr\Http\Message\ResponseInterface as Response;

class ListMeasurementAction extends MeasurementAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_cycle = $this->getUrlParam('id_cycle');
        $measurements = $this->measurementRepository->findAll($id_cycle);
        return $this->respondWithData($measurements);
    }
}