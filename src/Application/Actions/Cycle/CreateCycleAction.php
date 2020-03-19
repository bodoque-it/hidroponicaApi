<?php


namespace App\Application\Actions\Cycle;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class CreateCycleAction extends CycleAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_user = $this->resolveArg('id_user');
        $params = $this->getFormData();
        $cycle = $this->cycleRepository->createCycle($id_user,$params);
        $this->logger->info($cycle->getId());
        return $this->respondWithData($cycle);
    }
}