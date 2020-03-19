<?php


namespace App\Application\Actions\Cycle;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class DeleteCycleAction extends CycleAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_cycle = $this->resolveArg('id_cycle');
        $result = $this->cycleRepository->deleteCycle($id_cycle);
        return $this->respondWithData($result);

    }
}