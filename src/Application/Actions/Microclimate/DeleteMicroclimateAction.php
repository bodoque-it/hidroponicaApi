<?php


namespace App\Application\Actions\Microclimate;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class DeleteMicroclimateAction extends MicroclimateAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_microclimate = $this->resolveArg('id_microclimate');
        $res = $this->microclimateRepository->deleteMicroclimate($id_microclimate);
        return $this->respondWithData($res);
    }
}