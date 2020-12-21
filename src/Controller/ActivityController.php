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

// use App\Model\AgeManager;
use App\Model\ActivitiesAgesManager;
use App\Model\ActivitiesCategoriesManager;
use App\Model\ActivityManager;
use App\Model\AgeManager;
use App\Model\CategoryManager;

class ActivityController extends AbstractController
{
    /**
     * Display activity informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function read(int $id)
    {
        $activityManager = new ActivityManager();
        $categoryManager = new CategoryManager();
        $ageManager = new AgeManager();
        $activity = $activityManager->selectOneById($id);
        $activityCategories = $categoryManager->selectAllByActivityId($id);
        $activityAges = $ageManager->selectAllByActivityId($id);
        $categoryName = array();
        $ageRange = array();
        $categoryNames = "";
        $ageRanges = "";

        foreach ($activityCategories as $activityResult) {
            $categories = $categoryManager->selectOneById($activityResult['category_id']);
            array_push($categoryName, $categories['name']);
            $categoryNames = implode(" / ", $categoryName);
        }

        foreach ($activityAges as $activityResult) {
            $ages = $ageManager->selectOneById($activityResult['age_id']);
            array_push($ageRange, $ages['ranges']);
            $ageRanges = implode(" / ", $ageRange);
        }
        // var_dump($ageRanges);
        return $this->twig->render(
            'Activity/show.html.twig',
            [
                'activity' => $activity,
                'category' => $categoryNames,
                'ages' => $ageRanges,
            ]
        );
    }

    /**
     * Display activity creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $file = $_FILES['img'];

            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'pdf');

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 150000000) {
                        $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
                        $uploadPath = '/assets/upload/' . $fileNameNew;
                        $fileDestination = __DIR__ . '/../../public' . $uploadPath;
                        if (move_uploaded_file($fileTmpName, $fileDestination)) {
                            $activityManager = new ActivityManager();
                            $categoryManager = new CategoryManager();
                            $actCatManager = new ActivitiesCategoriesManager();
                            $actAgeManager = new ActivitiesAgesManager();
                            $categories = explode(',', $_POST['name']);
                            $ages = $_POST['ranges'];
                            $activity = [
                                'markdown' => $_POST['markdown'],
                                'description' => $_POST['description'],
                                'date_start' => $_POST['date_start'],
                                'date_end' => $_POST['date_end'],
                                'price' => $_POST['price'],
                                'img' => $uploadPath,
                                'link' => $_POST['link'],
                            ];
                            $activityId = $activityManager->insert($activity);
                            foreach ($categories as $category) {
                                $name = $categoryManager->search($category);
                                if (empty($name) == true) {
                                    $categoryId = $categoryManager->insert($category);
                                    $actCatManager->insert($activityId, $categoryId);
                                } else {
                                    $actCatManager->insert($activityId, $name[0]['id']);
                                }
                            }
                            foreach ($ages as $ageId) {
                                $actAgeManager->insert($activityId, $ageId);
                            }
                            header('Location:/');
                        }
                    } else {
                        $error = "Votre fichier est trop gros";
                    }
                } else {
                    $error = "Il y a eu une erreur lors de l'upload de votre fichier.";
                }
            } else {
                $error = "L'extension de votre fichier n'est pas bonne.";
                // echo "<script>alert(\"la variable est nulle\")</script>";
            }
        }
        return $this->twig->render('Activity/add.html.twig', ['error' => $error]);
    }

    /**
     * Display activity edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit($id)
    {
        $activityManager = new ActivityManager();
        $categoryManager = new CategoryManager();
        $ageManager = new AgeManager();
        $activity = $activityManager->selectOneById($id);
        $activityCategories = $categoryManager->selectAllByActivityId($id);
        $activityAges = $ageManager->selectAllByActivityId($id);
        $categoryName = array();
        $ageRange = array();
        $categoryNames = "";
        $ageRanges = "";

        foreach ($activityCategories as $activityResult) {
            $categories = $categoryManager->selectOneById($activityResult['category_id']);
            array_push($categoryName, $categories['name']);
            $categoryNames = implode(",", $categoryName);
        }

        foreach ($activityAges as $activityResult) {
            $ages = $ageManager->selectOneById($activityResult['age_id']);
            array_push($ageRange, $ages['ranges']);
            $ageRanges = implode(" / ", $ageRange);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $file = $_FILES['img'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png', 'pdf');

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 150000000) {
                        $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
                        $uploadPath = '/assets/upload/' . $fileNameNew;
                        $fileDestination = __DIR__ . '/../../public' . $uploadPath;
                        if (move_uploaded_file($fileTmpName, $fileDestination)) {
                            $activityManager = new ActivityManager();
                            $categoryManager = new CategoryManager();
                            $actCatManager = new ActivitiesCategoriesManager();
                            $actAgeManager = new ActivitiesAgesManager();
                            $categories = explode(',', $_POST['name']);
                            $ages = $_POST['ranges'];
                            $activity = [
                                'markdown' => $_POST['markdown'],
                                'description' => $_POST['description'],
                                'date_start' => $_POST['date_start'],
                                'date_end' => $_POST['date_end'],
                                'price' => $_POST['price'],
                                'img' => $uploadPath,
                                'link' => $_POST['link'],
                            ];
                            $activityManager->delete($_GET['id']);
                            $activityId = $activityManager->insert($activity);
                            foreach ($categories as $categoryName) {
                                $categoryId = $categoryManager->findOrInsert($categoryName);
                                $actCatManager->insert($activityId, $categoryId);
                            }
                            foreach ($ages as $ageId) {
                                $actAgeManager->insert($activityId, $ageId);
                            }
                            header('Location:/');
                        }
                    } else {
                        echo "Votre fichier est trop gros";
                    }
                } else {
                    echo "Il y a eu une erreur lors de l'upload de votre fichier.";
                }
            } else {
                echo "L'extension de votre fichier n'est pas bonne.";
            }
        }
        // var_dump($ageRanges);
        // var_dump($activity);
        return $this->twig->render(
            'Activity/edit.html.twig',
            [
                'activity' => $activity,
                'category' => $categoryNames,
                'ages' => $ageRanges,
            ]
        );
    }

    /**
     * Handle activity deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $activityManager = new ActivityManager();
        $activityManager->delete($id);
        header('Location:/');
    }

    public function listActivities()
    {
        $activityManager = new ActivityManager();
        $activities = $activityManager->selectAllWithSort();
        $prices = $activityManager->selectDistinctPrices();
        return $this->twig->render('Home/index.html.twig', ['activities' => $activities, 'prices' => $prices]);
    }

    public function filteredCategory()
    {
        //prepared request
        $category = $_GET['id'];
        $activityManager = new ActivityManager();
        $filteredActivities = $activityManager->selectAllByCategoryIds($category);
        return $this->twig->render(
            'Activity/index.html.twig',
            ['activities' => $filteredActivities]
        );
    }
}
