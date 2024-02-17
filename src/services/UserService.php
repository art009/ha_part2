<?php

namespace app\services;

use app\entities\User;
use app\dto\User as UserDTO;
use app\helpers\Gererator;
use app\repositories\UserRepository;
use PDO;

class UserService
{
    private ?User $user = null;
    private string $cookie_name = 'user_hash';

    public function __construct(
        private readonly PDO $db
    ) {}

    /**
     * Время действия куков
     * @return int
     */
    private function getSessionTimeOut(): int
    {
        return time()+20*24*60*60;
    }
    public function getUser(): User
    {
        if ($this->user === null) {
            $this->user = $this->findOrCreateUser();
        }
        return $this->user;
    }

    private function findOrCreateUser()
    {
        $user = $this->findUser();
        if (!$user)
            $user = $this->createUser();
        return $user;
    }

    public function findUser(): ?User
    {
        if (isset($_COOKIE[$this->cookie_name])) {
            return (new UserRepository($this->db))->getByHash($_COOKIE[$this->cookie_name]);
        }
        return null;
    }

    private function generateHash()
    {
        return md5(Gererator::string_v1(10));
    }

    private function createUser(): User
    {
        $user_hash = $this->generateHash();
        $user = new UserDTO($user_hash);
        setcookie('user_hash', $user_hash, $this->getSessionTimeOut() );
        return (new UserRepository($this->db))
            ->save($user);
    }
}