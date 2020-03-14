<?php


namespace App\Application\Actions\Microclimate;


use App\Application\Actions\Action;
use App\Domain\Microclimate\MicroclimateRepository;
use Psr\Log\LoggerInterface;

abstract class MicroclimateAction extends Action
{

    protected $microclimateRepository;

    /**
     * MicroclimateAction constructor.
     * @param LoggerInterface $logger
     * @param MicroclimateRepository $microclimateRepository
     */
    public function __construct(LoggerInterface $logger,MicroclimateRepository $microclimateRepository)
    {
        parent::__construct($logger);
        $this->microclimateRepository = $microclimateRepository;
    }
}