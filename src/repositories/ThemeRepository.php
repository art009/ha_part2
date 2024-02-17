<?php

namespace app\repositories;

use app\entities\Theme;
use app\mappers\ThemeHydrator;
use PDO;

class ThemeRepository
{
    private ThemeHydrator $hydrator;
    public function __construct(
        private readonly PDO $db
    ) {
        $this->hydrator = new ThemeHydrator();
    }

    /**
     * Венем список тем для сообщения с ограничением
     * @param int $limit
     * @param int $offset
     * @return array|null
     */
    public function getAll( int $limit = 10, int $offset = 0): ?array
    {
        $sql = 'SELECT * FROM theme LIMIT :limit, :offset';
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

    public function getById( int $id ): ?Theme
    {
        $sql = 'SELECT * FROM theme WHERE theme_id = :theme_id';
        $stmt = $this->db->query($sql);
        $stmt->execute(['theme_id' => $id]);
        $themeData = $stmt->fetch();

        if ($themeData) {
            return $this->hydrator->hydrate($themeData);
        }

        return null;
    }

    public function save(Theme $theme): void
    {
        $themeData = $this->hydrator->extract($theme);
        $sql = 'INSERT INTO theme (theme_id, theme_name) VALUES (:id, :name)';
        $this->db
            ->query($sql)
            ->execute($themeData);
    }

    public function update(Theme $theme): void
    {
        $themeData = $this->hydrator->extract($theme);
        $sql = "UPDATE theme SET theme_name = :name WHERE theme_id = :id";
        $this->db
            ->query($sql)
            ->execute($themeData);
    }
}