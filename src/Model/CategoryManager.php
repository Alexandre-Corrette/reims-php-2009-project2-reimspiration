<?php

/**
 * This file dispatch routes.
 *
 * PHP version 7
 *
 * @author  Christophe Chapleau <ch.chapleau@gmail.com>
 *
 * @author  Alexandre Corrette <alexandrecorrette@gmail.com>
 *
 * @author  Denis Cîrlan <dkirlan02@gmail.com>
 *
 * @author  Massinta Ait Braham <massinta.aitbraham@gmail.com>
 *
 * @link    https://github.com/WildCodeSchool/reims-php-2009-project2-reimspiration
 *
 */

namespace App\Model;

class CategoryManager extends AbstractManager
{
    /**
     *
     */
    private const TABLE = 'categories';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     *  Search function
     */
    public function findOrInsert($name)
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "SELECT id FROM " .
                self::TABLE .
                " WHERE name = :name"
        );
        $statement->bindValue(
            'name',
            $name,
            \PDO::PARAM_STR
        );
        $statement->execute();
        $category = $statement->fetch();
        $exists = ($category !== false);
        if ($exists) {
            return $category['id'];
        } else {
            return $this->insert($name);
        }
    }

    /**
     * @param string $category
     */
    public function insert(string $category)
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "INSERT INTO " .
                self::TABLE .
                " (name)" .
                "VALUES (:name)"
        );
        $statement->bindValue(
            'name',
            $category,
            \PDO::PARAM_STR
        );
        $statement->execute();
        $id = $this->pdo->lastInsertId();
        return $id;
    }

    /**
     *
     *
     */
    public function idRecover()
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * @param array $category
     */
    public function update(array $category)
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "UPDATE " .
                self::TABLE .
                " SET name = :name" .
                " WHERE id=:id"
        );
        $statement->bindValue(
            'id',
            $category['id'],
            \PDO::PARAM_INT
        );
        $statement->bindValue(
            'name',
            $category['name'],
            \PDO::PARAM_STR
        );

        $statement->execute();
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function selectAllWithSort(): array
    {
        return $this->pdo->query(
            "SELECT * FROM " .
                self::TABLE .
                " ORDER BY name ASC"
        )->fetchAll();
    }

    public function selectAllByActivityId($activityId)
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM ' . self::TABLE .
                ' JOIN activities_categories ON activities_categories.category_id = categories.id' .
                ' WHERE activities_categories.activity_id=:activity_id'
        );
        $statement->bindValue('activity_id', $activityId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
