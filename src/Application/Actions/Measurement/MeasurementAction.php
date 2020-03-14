<?php


namespace App\Application\Actions\Measurement;


use App\Application\Actions\Action;
use App\Domain\Measurement\MeasurementRepository;
use Psr\Log\LoggerInterface;

abstract class MeasurementAction extends Action
{
    /**
     * @var MeasurementRepository
     */
    protected $measurementRepository;


    /**
     * MeasurementAction constructor.
     * @param LoggerInterface $logger
     * @param MeasurementRepository $measurementRepository
     */
    public function __construct(LoggerInterface $logger,MeasurementRepository $measurementRepository)
    {
        parent::__construct($logger);
        $this->measurementRepository = $measurementRepository;
    }
}