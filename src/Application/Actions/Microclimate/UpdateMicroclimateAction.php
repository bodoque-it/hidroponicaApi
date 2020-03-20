<?php


namespace App\Application\Actions\Microclimate;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class UpdateMicroclimateAction extends MicroclimateAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_microclimate = $this->resolveArg('id_microclimate');
        $params = $this->getFormData();
        $microclimate = $this->microclimateRepository->updateMicroclimate($id_microclimate,$params);
        return $this->respondWithData($microclimate);
    }
}