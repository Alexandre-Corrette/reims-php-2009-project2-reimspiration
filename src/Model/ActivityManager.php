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

class ActivityManager extends AbstractManager
{
    /**
     *
     */
    private const TABLE = 'activities';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $activity
     */
    public function insert(array $activity)
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE .
            " (markdown, description, date_start, date_end, price, img, link) VALUES" .
            " (:markdown, :description, :date_start, :date_end, :price, :img, :link)"
        );
        $statement->bindValue(
            'markdown',
            $activity['markdown'],
            \PDO::PARAM_STR
        );
        $statement->bindValue(
            'description',
            $activity['description'],
            \PDO::PARAM_STR
        );
        $statement->bindValue(
            'date_start',
            $activity['date_start'],
            \PDO::PARAM_STR
        );
        $statement->bindValue(
            'date_end',
            $activity['date_end'],
            \PDO::PARAM_STR
        );
        $statement->bindValue(
            'price',
            $activity['price'],
            \PDO::PARAM_STR
        );
        $statement->bindValue(
            'img',
            $activity['img'],
            \PDO::PARAM_STR
        );
        $statement->bindValue(
            'link',
            $activity['link'],
            \PDO::PARAM_STR
        );
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    /**
     * @param array $activity
     */
    public function update(array $activity)
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "UPDATE " .
            self::TABLE .
            " SET markdown = :markdown,
            description = :description,
            date_start = :date_start,
            date_end = :date_end,
            price = :price,
            img = :img,
            link = :link" .
            " WHERE id=:id"
        );
        $statement->bindValue(
            'id',
            $activity['id'],
            \PDO::PARAM_INT
        );
        $statement->bindValue(
            'markdown',
            $activity['markdown'],
            \PDO::PARAM_STR
        );
        $statement->bindValue(
            'description',
            $activity['description'],
            \PDO::PARAM_STR
        );
        $statement->bindValue(
            'date_start',
            $activity['date_start'],
            \PDO::PARAM_STR
        );
        $statement->bindValue(
            'date_end',
            $activity['date_end'],
            \PDO::PARAM_STR
        );
        $statement->bindValue(
            'price',
            $activity['price'],
            \PDO::PARAM_STR
        );
        $statement->bindValue(
            'img',
            $activity['img'],
            \PDO::PARAM_STR
        );
        $statement->bindValue(
            'link',
            $activity['link'],
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
            'SELECT * FROM ' .
                self::TABLE .
                ' ORDER BY id DESC'
        )->fetchAll();
    }

    public function selectDistinctPrices(): array
    {
        return $this->pdo->query(
            "SELECT DISTINCT price AS value FROM " .
            self::TABLE .
            " ORDER BY price ASC"
        )->fetchAll();
    }

    public function selectAllByCategoryIds(array $categoryIds)
    {
        $inQuery = implode(',', array_fill(0, count($categoryIds), '?'));
        $statement = $this->pdo->prepare(
            "SELECT *
            FROM $this->table
            JOIN activities_categories
            ON activities.id = activities_categories.activity_id
            WHERE activities_categories.category_id IN ($inQuery)"
        );
        $statement->execute($categoryIds);
        return $statement->fetchAll();
    }

    public function selectAllByDate(string $dateStart, string $dateEnd)
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM $this->table WHERE date_start <= :date_end AND date_end >= :date_start"
        );
        $statement->bindValue(':date_start', $dateStart, \PDO::PARAM_STR);
        $statement->bindValue(':date_end', $dateEnd, \PDO::PARAM_STR);
        $statement->execute();
        return $statement-> fetchAll();
    }
}
