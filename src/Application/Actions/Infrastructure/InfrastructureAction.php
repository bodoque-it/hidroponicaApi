<?php


namespace App\Application\Actions\Infrastructure;


use App\Application\Actions\Action;
use App\Domain\Infrastructure\InfrastructureRepository;

abstract class InfrastructureAction extends Action
{

    protected $infrastructureRepository;

    /**
     * InfrastructureAction constructor.
     * @param InfrastructureRepository $infrastructureRepository
     */
    public function __construct(InfrastructureRepository $infrastructureRepository)
    {
        $this->infrastructureRepository = $infrastructureRepository;
    }
}