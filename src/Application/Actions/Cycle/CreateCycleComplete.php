<?php


namespace App\Application\Actions\Cycle;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class CreateCycleComplete extends CycleAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_user = $this->getUrlParam('id_user');
        $id_container = $this->getUrlParam('id_container');
        $id_microclimate = $this->getUrlParam('id_microclimate');
        $params = $this->getFormData();
        $cycle = $this->cycleRepository->createCycleContainerMicroclimate($id_user,$id_container,$id_microclimate,$params);
        return $this->respondWithData($cycle);
    }
}