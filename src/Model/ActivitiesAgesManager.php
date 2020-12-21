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

class ActivitiesAgesManager extends AbstractManager
{
    private const TABLE = 'activities_ages';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insert($activityid, $ageid)
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "INSERT INTO " .
            self::TABLE .
            " (activity_id, age_id) VALUES (:activity_id, :age_id)"
        );
        $statement->bindValue('activity_id', $activityid, \PDO::PARAM_INT);
        $statement->bindValue('age_id', $ageid, \PDO::PARAM_INT);

        $statement->execute();
        // if ($statement->execute()) {
        //     return (int)$this->pdo->lastInsertId();
        // }
    }
}
