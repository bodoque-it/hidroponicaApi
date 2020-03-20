<?php


namespace App\Application\Actions\Microclimate;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class ViewMicroclimateAction extends MicroclimateAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_microclimate = $this->resolveArg('id_microclimate');
        $microclimate = $this->microclimateRepository->findById($id_microclimate);
        return $this->respondWithData($microclimate);
    }
}