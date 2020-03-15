<?php


namespace App\Infrastructure\Persistence\User;


use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    private $users;
    /**
     * InMemoryUserRepository constructor.
     */
    public function __construct(array  $user= null)
    {
        $this->users = $users ?? [
                1 => new User(1, 'bill.gates', 'Bill', 'Gates','example@h.cl'),
                2 => new User(2, 'steve.jobs', 'Steve', 'Jobs','example@h.cl'),
                3 => new User(3, 'mark.zuckerberg', 'Mark', 'Zuckerberg','example@h.cl'),
                4 => new User(4, 'evan.spiegel', 'Evan', 'Spiegel','example@h.cl'),
                5 => new User(5, 'jack.dorsey', 'Jack', 'Dorsey','example@h.cl'),
            ];
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        return array_values($this->users);
    }

    /**
     * @inheritDoc
     */
    public function findUserOfId(int $id): User
    {
        if (!isset($this->users[$id])) {
            throw new UserNotFoundException();
        }

        return $this->users[$id];
    }

    public function getPassword(string $username): string
    {
        // TODO: Implement getPassword() method.
    }

    public function createUser(string $username, string $first_name, string $last_name, string $password, string $email): int
    {
        // TODO: Implement createUser() method.
    }

    public function existUserByUsername(string $username): bool
    {
        // TODO: Implement existUserByUsername() method.
    }

    public function findUserOfUsername(string $username): User
    {
        // TODO: Implement findUserOfUsername() method.
    }

    public function getUserParams(): array
    {
        // TODO: Implement getUserParams() method.
    }

    public function updateUser(string $id, array $params): User
    {
        // TODO: Implement updateUser() method.
    }

    public function deleteUser($id_user): bool
    {
        // TODO: Implement deleteUser() method.
    }
}