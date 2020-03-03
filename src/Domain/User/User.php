<?php
declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Container\Container;
use App\Domain\Rail\Rail;
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
        ];
    }
}
