<?php
declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Container\Container;
use App\Domain\Cycle\Cycle;
use App\Domain\Infrastructure\Infrastructure;
use App\Domain\Microclimate\Microclimate;
use App\Domain\Rail\Rail;
use Doctrine\Common\Collections\Criteria;
use JsonSerializable;
use Doctrine\Common\Collections\ArrayCollection;

class User implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * @return string
     */

    private $containers;

    private $rails;

    private $hashPassword;

    private $cycles;

    private $microclimates;

    private $infrastructures;
    /**
     * @return mixed
     */
    public function getHashPassword()
    {
        return $this->hashPassword;
    }

    /**
     * @param mixed $hashPassword
     */
    public function setHashPassword($hashPassword): void
    {
        $this->hashPassword = $hashPassword;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    /**
     * @param int|null  $id
     * @param string    $username
     * @param string    $firstName
     * @param string    $lastName
     * @param string    $email
     */
    public function __construct(?int $id, string $username, string $firstName, string $lastName,string $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->containers = new ArrayCollection();
        $this->rails = new ArrayCollection();
        $this->cycles = new ArrayCollection();
        $this->microclimates = new ArrayCollection();
        $this->infrastructures = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getInfrastructures()
    {
        return $this->infrastructures;
    }

    /**
     * @param Infrastructure $infrastructure
     */
    public function addInfrastructures(Infrastructure $infrastructure): void
    {
        $this->infrastructures[] = $infrastructure;
    }

    public function getContainers()
    {
        return $this->containers;
    }

    /**
     * @return ArrayCollection
     */
    public function getRails()
    {
        return $this->rails;
    }

    public function addContainer(Container $container){
        $this->containers[] = $container;
    }

    public function addRail(Rail $rail){
        $this->rails[] = $rail;
    }

    public function addCycle(Cycle $cycle){
        $this->cycles[] = $cycle;
    }

    public function getCycles(){
        return $this->cycles;
    }

    public function getCyclesOrdered(){
        $criteria = new Criteria();
        $criteria->orderBy(['startDate' => Criteria::ASC]);
        return  $this->getCycles()->matching($criteria);

    }
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return strtolower($this->username);
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function setFirstName($fistname){
        $this->firstName = $fistname;
    }
    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return ucfirst($this->firstName);
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return ucfirst($this->lastName);
    }

    public function setLastName($lastname){
        $this->lastName = $lastname;
    }

    /**
     * @return mixed
     */
    public function getMicroclimates()
    {
        return $this->microclimates;
    }

    /**
     * @param Microclimate $microclimate
     */
    public function addMicroclimates(Microclimate $microclimate): void
    {
        $this->microclimates[]= $microclimate;
    }


    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'rails' => $this->getRails()->getValues(),
            'infrastructures'=>$this->getInfrastructures()->getValues()
        ];
    }

    public function getCountActiveContainers():int
    {
        $activeCountersQuantity = 0;
        foreach ($this->getContainers()->getValues() as $container){
            if($container->isActivate()){
                $activeCountersQuantity++;
            }
        }
        return $activeCountersQuantity;
    }

    public function getCountInactiveContainers()
    {
        $inactiveCountersQuantity = 0;
        foreach ($this->getContainers()->getValues() as $container){
            if(!$container->isActivate()){
                $inactiveCountersQuantity++;
            }
        }
        return $inactiveCountersQuantity;
    }

    public function getCountRails():int
    {
        return count($this->getRails()->getValues());
    }

    public function getCountMicroclimates()
    {
        return count($this->getMicroclimates()->getValues());
    }

    public function getCountCycleNotFinish()
    {
        $counter= 0;
        foreach ($this->getCycles()->getValues() as $cycle){
            if($cycle->getFinishDate()=== null){
                $counter++;
            }
        }
        return $counter;
    }


}
