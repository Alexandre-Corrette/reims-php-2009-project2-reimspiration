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

class ActivitiesCategoriesManager extends AbstractManager
{
    private const TABLE = 'activities_categories';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insert($activityid, $categoryid)
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "INSERT INTO " .
            self::TABLE .
            " (activity_id, category_id) VALUES (:activity_id, :category_id)"
        );
        $statement->bindValue('activity_id', $activityid, \PDO::PARAM_INT);
        $statement->bindValue('category_id', $categoryid, \PDO::PARAM_INT);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }
}
