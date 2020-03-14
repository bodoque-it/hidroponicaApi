<?php
declare(strict_types=1);

namespace App\Domain\User;

use phpDocumentor\Reflection\Types\Boolean;

interface UserRepository
{
    /**
     * @return User[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserOfId(int $id): User;

    public function getPassword(string $username):string;

    public function createUser(string $username,
                               string $first_name,
                               string $last_name,
                               string $password,
                               string $email):int;
    public function existUserByUsername(string $username):bool;

    public function findUserOfUsername(string $username):User;

    public function getUserParams():array;

    public function updateUser(string $id,array $params):User;

    public function deleteUser($id_user):bool;
}
