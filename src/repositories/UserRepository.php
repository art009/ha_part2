<?php

namespace app\repositories;

use app\entities\User;
use app\mappers\UserHydrator;
use PDO;

class UserRepository
{
    private UserHydrator $hydrator;
    public function __construct(
        private readonly PDO $db
    ) {
        $this->hydrator = new UserHydrator();
    }

    /**
     * Массив пользователей
     * @param int $limit
     * @param int $offset
     * @return array|null
     */
    public function getAll( int $limit = 10, int $offset = 0): ?array
    {
        $sql = 'SELECT * FROM users LIMIT :limit, :offset';
        $stmt = $this->db->query($sql);
        $stmt->execute(['limit' => $limit, 'offset' => $offset]);
        $themesData = $stmt->fetchAll();

        if ($themesData) {
            $hydrator = $this->hydrator;
            return array_map(function($theme) use ($hydrator) {
                return $hydrator->hydrate($theme);
            },$themesData);
        }
        return null;
    }

    public function getById( int $id ): ?User
    {
        $sql = 'SELECT * FROM users WHERE user_id = :user_id';
        $stmt = $this->db->query($sql);
        $stmt->execute(['user_id' => $id]);
        $userData = $stmt->fetch();

        if ($userData) {
            return $this->hydrator->hydrate($userData);
        }

        return null;
    }

    public function save(User $user): void
    {
        $userData = $this->hydrator->extract($user);
        $sql = 'INSERT INTO users (user_id, user_hash) VALUES (:user_id, :user_hash)';
        $this->db
            ->query($sql)
            ->execute($userData);
    }
}