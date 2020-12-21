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

namespace App\Controller;

use App\Model\ActivityManager;
use App\Model\CategoryManager;
use App\Model\AgeManager;

class HomeController extends AbstractController
{
    /**
     * Display homepage
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $activityManager = new activityManager();
        $categoryManager = new CategoryManager();
        $ageManager = new AgeManager();
        if (isset($_GET['category'])) {
            $ids = explode(',', $_GET['category']);
            $activities = $activityManager->selectAllByCategoryIds($ids);
        } else {
            $ids = [];
            $activities = $activityManager->selectAllWithSort();
        }
        $categories = $categoryManager->selectAllWithSort();
        $categories = array_map(
            function ($category) use ($ids) {
                $category['checked'] = in_array($category['id'], $ids);
                return $category;
            },
            $categories
        );
        $ages = $ageManager->selectAllWithSort();
        $prices = $activityManager->selectDistinctPrices();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $activityManager = new ActivityManager();
            $activities = $activityManager->selectAllByDate($_POST['date_start'], $_POST['date_end']);
        }
        return $this->twig->render(
            'Home/index.html.twig',
            [
                'activities' => $activities,
                'prices' => $prices,
                'categories' => $categories,
                'ages' => $ages
            ]
        );
    }

    public function aboutUs()
    {
        return $this->twig->render('about-us.html.twig');
    }

    public function covidInfo()
    {
        return $this->twig->render('info-covid.html.twig');

    }
}
