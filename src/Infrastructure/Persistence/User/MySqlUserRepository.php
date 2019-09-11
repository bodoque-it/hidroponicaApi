<?php

namespace App\Infrastructure\Persistence\User;


use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;

class MySqlUserRepository implements UserRepository
{

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserOfId(int $id): User
    {
        // TODO: Implement findUserOfId() method.
    }

    public function getPassword(int $id): string
    {
        // TODO: Implement getPassword() method.
    }
}