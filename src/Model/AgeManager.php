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

class AgeManager extends AbstractManager
{
    /**
     *
     */
    private const TABLE = 'ages';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectAllWithSort(): array
    {
        return $this->pdo->query(
            "SELECT * FROM " .
                self::TABLE
        )->fetchAll();
    }

    public function selectAllByActivityId($activityId)
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM ' . self::TABLE .
                ' JOIN activities_ages ON activities_ages.age_id = ages.id' .
                ' WHERE activities_ages.activity_id=:activity_id'
        );
        $statement->bindValue('activity_id', $activityId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
