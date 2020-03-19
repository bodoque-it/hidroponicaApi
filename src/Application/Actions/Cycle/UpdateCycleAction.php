<?php


namespace App\Application\Actions\Cycle;


use Psr\Http\Message\ResponseInterface as Response;


class UpdateCycleAction extends CycleAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_cycle = $this->getUrlParam('id_cycle');
        $params = $this->getFormData();
        $cycle = $this->cycleRepository->updateCycle($id_cycle,$params);
        return $this->respondWithData($cycle);
    }
}