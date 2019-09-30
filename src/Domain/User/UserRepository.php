<?php
declare(strict_types=1);

namespace App\Domain\User;

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

    public function getPassword(int $id):string;

    public function createUser(string $username,
                               string $first_name,
                               string $last_name,
                               string $password,
                               string $email):User;
}
