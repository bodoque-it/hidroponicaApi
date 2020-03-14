<?php


namespace App\Application\Actions\Cycle;


use Psr\Http\Message\ResponseInterface as Response;

class ListCycleAction extends CycleAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_user = $this->getUrlParam("id_user");
        $cycles = $this->cycleRepository->findAll($id_user);
        return $this->respondWithData($cycles);
    }
}